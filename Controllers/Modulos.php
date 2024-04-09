<?php

class Modulos extends Controllers
{
	public function __construct()
	{
		sessionStart();
		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . 'login');
		}
		parent::__construct();
		getPermisos(2);
	}

	public function modulos()
	{
		if (empty($_SESSION['permisosMod']['r'])) {
			header('Location: ' . base_url() . 'dashboard');
		}
		$data['page_id'] = 1;
		$data['page_tag'] = "Modulos";
		$data['page_title'] = "Modulos Petipa";
		$data['page_name'] = "Modulos";
		$data['page_functions_js'] = "functions_modulos";
		$this->views->getView($this, "modulos", $data);
	}

	public function setModulo()
	{
		if ($_POST) {

			if (empty($_POST['txtTitulo']) || empty($_POST['txtDescripcion']) || empty($_POST['listStatus'])) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {
				$idModulo = intval($_POST['idModulo']);
				$strTitulo = strClean($_POST['txtTitulo']);
				$strDescripcion = ucwords(strClean($_POST['txtDescripcion']));
				$intStatus = intval(strClean($_POST['listStatus']));
				$request_user = false;
				if ($idModulo == 0) {
					if ($_SESSION['permisosMod']['w']) {
					$request_user = $this->model->insertModulo($strTitulo,
						$strDescripcion,
						$intStatus);
					$option = 1;
					}
				} else {
					if ($_SESSION['permisosMod']['u']) {
					$request_user = $this->model->updateModulo($idModulo,
						$strTitulo,
						$strDescripcion,
						$intStatus);
					$option = 2;
					}
					
				}
				if ($option == 1) {
					$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
				} else if ($option == 2){
					$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
				}
				else if ($request_user == 'exist') {
					$arrResponse = array('status' => false, 'msg' => '¡Atención! El Rol ya existe.');
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function getModulos()
	{
		if ($_SESSION['permisosMod']['r']) {
	
			$arrData = $this->model->selectModulos();

			for ($i = 0; $i < count($arrData); $i++) {

				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';


				if ($arrData[$i]['status'] == 1) {
					$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
				} else {
					$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
				}

				if ($_SESSION['permisosMod']['r']) {
					$btnView = '<button class="btn btn-info btn-sm btnViewModulo" onClick="fntViewModulo(' . $arrData[$i]['idmodulo'] . ')" title="Ver modulo"><i class="far fa-eye"></i></button>';
				}
				if ($_SESSION['permisosMod']['u']) {
					if (
						($_SESSION['idUser'] == 22 and $_SESSION['userData']['idrol'] == 1)
						|| ($_SESSION['userData']['idrol'] == 1)
					) {
						$btnEdit = '<button class="btn btn-primary  btn-sm btnEditUsuario" onClick="fntEditModulo(' . $arrData[$i]['idmodulo'] . ')" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>';
					} else {
						$btnEdit = '<button class="btn btn-secondary  btn-sm btnEditUsuario" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>';
					}
				}
				if ($_SESSION['permisosMod']['d']) {
					
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntDelModulo(' . $arrData[$i]['idmodulo'] . ')" title="Eliminar usuario"><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center">
					' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '				
				</div>';
			}
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function getModulo(int $idmodulo)
	{
		if ($_SESSION['permisosMod']['r']) {
			$idModulo = intval($idmodulo);
			if ($idModulo > 0) {
				$arrData = $this->model->selectModulo($idModulo);
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

	public function delModulo($intID)
	{
			$intIdmodulo = intval($intID);
			$requestDelete = $this->model->deleteModulo($intIdmodulo);
			if ($requestDelete) {
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el usuario');
			} else {
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el usuario.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}

}
?>