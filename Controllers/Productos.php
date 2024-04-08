<?php


class Productos extends Controllers
{
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
		$data['page_title'] = "Productos Petipa";
		$data['page_name'] = "productos";
		$data['page_functions_js'] = "functions_productos.js";
		$this->views->getView($this, "productos", $data);
	}

	public function setImage()
	{
		if ($_POST) {

			$idProducto = 1;//intval($_POST['idproducto']);
			$foto      = $_FILES['foto'];
			$imgNombre = 'pro_' . md5(date('d-m-Y H:m:s')) . '.jpg';
			$request_image = $this->model->insertImage($idProducto, $imgNombre);
			if ($request_image == 0) {
				$uploadImage = uploadImage($foto, $imgNombre);
				$arrResponse = array('status' => true, 'imgname' => $imgNombre, 'msg' => 'Archivo cargado.');
			} else {
				$arrResponse = array('status' => false, 'msg' => 'Error de carga.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	public function delFile()
	{
		if ($_POST) {
			if (empty($_POST['idproducto']) || empty($_POST['file'])) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {
				//Eliminar de la DB
				$idProducto = intval($_POST['idproducto']);
				$imgNombre  = strClean($_POST['file']);
				$request_image = $this->model->deleteImage($idProducto, $imgNombre);

				if ($request_image) {
					$deleteFile =  deleteFile($imgNombre);
					$arrResponse = array('status' => true, 'msg' => 'Archivo eliminado');
				} else {
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar');
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
}
