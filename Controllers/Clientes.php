<?php

class Clientes extends Controllers
{
    public function __construct()
    {
        sessionStart();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . 'login');
        }
        parent::__construct();
        getPermisos(3);
    }

    public function clientes()
    {
        if (empty($_SESSION['permisosMod']['r'])) {
            header('Location: ' . base_url() . 'dashboard');
        }
        $data['page_tag'] = "Clientes";
        $data['page_title'] = "Clientes Petipa";
        $data['page_name'] = "clientes";
        $data['page_functions_js'] = "functions_clientes.js";
        $this->views->getView($this, "clientes", $data);
    }

    public function getClientes()
    {
        if ($_SESSION['permisosMod']['r']) {

            $arrData = $this->model->selectClientes();
            for ($i = 0; $i < count($arrData); $i++) {

                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                if ($_SESSION['permisosMod']['r']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idpersona'] . ')" title="Ver cliente"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['u']) {
                    $btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idpersona'] . ')" title="Editar cliente"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['d']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idpersona'] . ')" title="Eliminar cliente"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function setCliente()
    {
        if ($_POST) {

            if (empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['txtNit']) || empty($_POST['txtNombreFiscal']) || empty($_POST['txtDirFiscal']) || empty($_POST['txtCfdi'])) {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idUsuario = intval($_POST['idUsuario']);
                $strIdentificacion = strClean($_POST['txtIdentificacion']);
                $strNombre = ucwords(strClean($_POST['txtNombre']));
                $strApellido = ucwords(strClean($_POST['txtApellido']));
                $intTelefono = intval(strClean($_POST['txtTelefono']));
                $strEmail = strtolower(strClean($_POST['txtEmail']));
                $strNit = strClean($_POST['txtNit']);
                $strNombreFiscal = strClean($_POST['txtNombreFiscal']);
                $strDirFiscal = strClean($_POST['txtDirFiscal']);
                $strCfdi = strClean($_POST['txtCfdi']);
                $request_user = false;
                if ($idUsuario == 0) {
                    if ($_SESSION['permisosMod']['w']) {
                        $option = 1;
                        $strPassword = empty($_POST['txtPassword']) ? hash("SHA256", passGenerator()) : hash("SHA256", $_POST['txtPassword']);
                        $strPasswordEncript = hash("SHA256", $strPassword);
                        $request_user = $this->model->insertCliente(
                            $strIdentificacion,
                            $strNombre,
                            $strApellido,
                            $intTelefono,
                            $strEmail,
                            $strPassword,
                            $strNit,
                            $strNombreFiscal,
                            $strDirFiscal,
                            $strCfdi
                        );
                    }
                } else {
                    if ($_SESSION['permisosMod']['u']) {
                        $option = 2;
                        $strPassword = empty($_POST['txtPassword']) ? "" : hash("SHA256", $_POST['txtPassword']);
                        $request_user = $this->model->updateCliente(
                            $idUsuario,
                            $strIdentificacion,
                            $strNombre,
                            $strApellido,
                            $intTelefono,
                            $strEmail,
                            $strPassword,
                            $strNit,
                            $strNombreFiscal,
                            $strDirFiscal,
                            $strCfdi
                        );
                    }
                }
                if ($request_user >= 0) {
                    if ($option == 1) {
                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                        $nombreUsuario = $strNombre . ' ' . $strApellido;
                        $dataUsuario = array(
                            'nombreUsuario' => $nombreUsuario,
                            'email' => $strEmail,
                            'password' => $strPasswordEncript,
                            'asunto' => "Bienvenido a tu tienda en linea"
                        );
                        //sendEmail($dataUsuario,'email_cambioPassword');
                    } else {
                        $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
                    }
                } else if ($request_user == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => '¡Atención! El el id ya existe.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function getCliente($idpersona)
    {
        if ($_SESSION['permisosMod']['r']) {
            $idusuario = intval($idpersona);
            if ($idusuario > 0) {
                $arrData = $this->model->selectCliente($idusuario);
                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function delCliente()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['d']) {
                $intIdpersona = intval($_POST['idUsuario']);
                $requestDelete = $this->model->deleteCliente($intIdpersona);
                if ($requestDelete) {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el cliente');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar al cliente.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }
}
