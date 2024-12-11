<?php

class Almacenes extends Controllers
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

	public function almacenes()
	{
		if (empty($_SESSION['permisosMod']['r'])) {
			header('Location: ' . base_url() . 'dashboard');
		}
		$data['page_id'] = 1;
		$data['page_tag'] = "Almacenes";
		$data['page_title'] = "Almacenes";
		$data['page_name'] = "Almacenes";
		$data['page_functions_js'] = "functions_almacenes";
		$this->views->getView($this, "Almacenes", $data);
	}

	public function setAlmacen()
	{
		if ($_POST) {

			if (empty($_POST['txtTitulo']) || empty($_POST['txtDescripciona']) || empty($_POST['txtTipo']) || empty($_POST['txtDirecciones'])) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {
				
				$strTitulo = ucwords(strClean($_POST['txtTitulo']));
				$strDescripcion = ucwords(strClean($_POST['txtDescripciona']));
				$strTipo = ucwords(strClean($_POST['txtTipo']));
				$strDirecciones = ucwords(strClean($_POST['txtDirecciones']));
				$request_user = $this->model->insertAlmacen($strTitulo, $strDescripcion,$strTipo,$strDirecciones);
					
				if($request_user == 0){
					$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
				}	else{
					$arrResponse = array('status' => true, 'msg' => 'No es posible almacenar información.');

				}
				
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			
		}
		die();
	}

	public function getAlmacenes()
	{
		if ($_SESSION['permisosMod']['r']) {
	
			$arrData = $this->model->selectAlmacenes();

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
					$btnView = '<button class="btn btn-info btn-sm btnViewModulo" onClick="fntViewModulo(' . $arrData[$i]['idalmacen'] . ')" title="Ver modulo"><i class="far fa-eye"></i></button>';
				}
				if ($_SESSION['permisosMod']['u']) {
					if (
						($_SESSION['idUser'] == 22 and $_SESSION['userData']['idrol'] == 1)
						|| ($_SESSION['userData']['idrol'] == 1)
					) {
						$btnEdit = '<button class="btn btn-primary  btn-sm btnEditUsuario" onClick="fntEditModulo(' . $arrData[$i]['idalmacen'] . ')" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>';
					} else {
						$btnEdit = '<button class="btn btn-secondary  btn-sm btnEditUsuario" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>';
					}
				}
				if ($_SESSION['permisosMod']['d']) {
					
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntDelModulo(' . $arrData[$i]['idalmacen'] . ')" title="Eliminar usuario"><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center">
					' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '				
				</div>';
			}
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function getModulo(int $idalmacen)
	{
		if ($_SESSION['permisosMod']['r']) {
			$idalmacen = intval($idalmacen);
			if ($idalmacen > 0) {
				$arrData = $this->model->selectModulo($idalmacen);
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

	public function delProducto(int $idmodulo)
	{
		if ($_POST) {
			$intIdmodulo = intval($idmodulo);
			$observacion = ucwords(strClean($_POST['txtObservacion']));
			$requestDelete = $this->model->deleteProducto($intIdmodulo, $observacion);
			if ($requestDelete) {
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el almacen');
			} else {
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el almacen.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}


		die();
	}

}
?>