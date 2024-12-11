<?php


class Productos extends Controllers
{
	private $observacion;
	public function __construct()
	{
		sessionStart();
		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . 'login');
		}
		parent::__construct();
		getPermisos(4);
	}

	public function productos()
	{
		if (empty($_SESSION['permisosMod']['r'])) {
			header('Location: ' . base_url() . 'dashboard');
		}
		$data['page_tag'] = "Productos";
		$data['page_title'] = "Productos";
		$data['page_name'] = "productos";
		$data['page_functions_js'] = "functions_productos.js";
		$this->views->getView($this, "productos", $data);
	}
	public function getProductos()
	{

		if ($_SESSION['permisosMod']['r']) {

			$arrData = $this->model->selectProductos($_SESSION['userData']['idalmacen']);

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
					if (
						($_SESSION['idUser'] == 22 and $_SESSION['userData']['idrol'] == 1)
						|| ($_SESSION['userData']['idrol'] == 1)
					) {
						//$btnEdit = '<button class="btn btn-primary  btn-sm btnEditUsuario" onClick="fntUpdProducto(' . $arrData[$i]['idproducto'] . ')" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>';
					} else {
						$btnEdit = '<button class="btn btn-secondary  btn-sm btnEditUsuario" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>';
					}
				}
				if ($_SESSION['permisosMod']['d']) {

					$btnDelete = '<button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntDelProducto(' . $arrData[$i]['idproducto'] . ')" title="Eliminar usuario"><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center">
					' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '				
				</div>';
			}
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function setProducto()
	{
		if ($_POST) {

			if (
				empty($_POST['txtTitulo']) || empty($_POST['txtDescripcion']) || empty($_POST['listStatus'])
				|| empty($_POST['txtCategoria']) || empty($_POST['txtUnidades']) || empty($_POST['txtAlmacen'])
			) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {
				$idModulo = intval($_POST['idModulo']);
				$strTitulo = strClean($_POST['txtTitulo']);
				$strDescripcion = ucwords(strClean($_POST['txtDescripcion']));
				$strCategoria = intval($_POST['txtCategoria']);
				$strUnidades = strClean($_POST['txtUnidades']);
				$strAlmacen = intval($_POST['txtAlmacen']);
				$intStatus = intval(strClean($_POST['listStatus']));


				$request_user = false;
				if ($idModulo == 0) {
					if ($_SESSION['permisosMod']['w']) {
						$request_user = $this->model->insertProducto(
							$strTitulo,
							$strDescripcion,
							$strCategoria,
							$strUnidades,
							$strAlmacen,
							$intStatus
						);
						$option = 1;
					}
				} else {
					if ($_SESSION['permisosMod']['u']) {
						$request_user = $this->model->updateModulo(
							$idModulo,
							$strTitulo,
							$strDescripcion,
							$intStatus
						);
						$option = 2;
					}
				}
				if ($option == 1) {
					$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
				} else if ($option == 2) {
					$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
				} else if ($request_user == 'exist') {
					$arrResponse = array('status' => false, 'msg' => '¡Atención! El Rol ya existe.');
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
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
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el producto');
			} else {
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el producto.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}


		die();
	}
	public function updateProducto($idmodulo){
		dep($_POST);
	}
}
