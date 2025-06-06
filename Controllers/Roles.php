<?php

class Roles extends Controllers
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

	public function roles()
	{
		if (empty($_SESSION['permisosMod']['r'])) {
			header('Location: ' . base_url() . 'dashboard');
		}
		$data['page_id'] = 3;
		$data['page_tag'] = "Roles usuario";
		$data['page_title'] = "Roles Usuario";
		$data['page_name'] = "rol_usuario";
		$data['page_functions_js'] = "function_roles.js";
		$this->views->getView($this, "roles", $data);
	}

	public function getRoles()
	{
		if ($_SESSION['permisosMod']['r']) {
			$arrData = $this->model->selectRoles();

			for ($i = 0; $i < count($arrData); $i++) {

				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';

				if ($arrData[$i]['status'] == 1) {
					$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
				} else {
					$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
				}

				if ($_SESSION['permisosMod']['u']) {
					$btnView = '<button class="btn btn-secondary btn-sm btnPermisosRol" rl="' . $arrData[$i]['idrol'] . '" title="Permisos" onclick="fntPermisos();"><i class="fas fa-key"></i></button> ';
				}
				if ($_SESSION['permisosMod']['u']) {
					$btnEdit = '<button class="btn btn-primary btn-sm btnEditRol" rl="' . $arrData[$i]['idrol'] . '" title="Editar" onclick="fntEditRol();"><i class="fas fa-pencil-alt"></i></button> ';
				}
				if ($_SESSION['permisosMod']['d']) {
					$btnDelete = ' <button class="btn btn-danger btn-sm btnDelRol" rl="' . $arrData[$i]['idrol'] . '" title="Eliminar" onclick="fntDelRol(' . $arrData[$i]['idrol'] . ');"><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center"> ' . $btnView . $btnEdit . $btnDelete . '</div>';
			}
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		}
		die();
	}


	public function getRol(int $idrol)
	{
		if ($_SESSION['permisosMod']['r']) {
			$intIdrol = intval(strClean($idrol));
			if ($intIdrol > 0) {
				$arrData = $this->model->selectRol($intIdrol);
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



	public function setRol()
	{
		if ($_SESSION['permisosMod']['w']) {
			$intIdrol = intval($_POST['idRol']);
			$strRol = strClean($_POST['txtNombre']);
			$strDescipcion = strClean($_POST['txtDescripcion']);
			$intStatus = intval($_POST['listStatus']);

			if ($intIdrol == 0) {
				//Crear
				$request_rol = $this->model->insertRol($strRol, $strDescipcion, $intStatus);
				$option = 1;
			} else {
				//Actualizar
				$request_rol = $this->model->updateRol($intIdrol, $strRol, $strDescipcion, $intStatus);
				$option = 2;
			}

			if ($request_rol != 0) {
				if ($option == 1) {
					$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
				} else {
					$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
				}
			} else if ($request_rol == 'exist') {
				$arrResponse = array('status' => false, 'msg' => '¡Atención! El Rol ya existe.');
			}

			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function delRol()
	{
		if ($_SESSION['permisosMod']['d']) {
			header('Content-Type: application/json');
			if ($_POST) {
				$intIdrol = intval($_POST['idrol']);
				$requestDelete = $this->model->deleteRol($intIdrol);
				if ($requestDelete == 'ok') {
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Rol');
				} else if ($requestDelete == 'exist') {
					$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Rol asociado a usuarios.');
				} else {
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Rol.');
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}
	public function getSelectRoles()
	{

		$htmlOptions = "";
		$arrData = $this->model->selectRoles();
		if (count($arrData) != 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]['status'] == 1) {
					$htmlOptions .= '<option value="' . $arrData[$i]['idrol'] . '">' . $arrData[$i]['nombrerol'] . '</option>';
				}
			}
		}
		echo $htmlOptions;

		die();
	}
}
?>