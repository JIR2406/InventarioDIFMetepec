<?php

class Login extends Controllers
{
	public function __construct()
	{
		session_start();
		if (isset($_SESSION['login'])) {
			header('Location: ' . base_url() . 'dashboard');
		}
		parent::__construct();
	}


	public function login()
	{
		$data['page_tag'] = "Login - Petipa";
		$data['page_title'] = "Login";
		$data['page_name'] = "login";
		$data['page_functions_js'] = "function_login.js";
		$this->views->getView($this, "login", $data);
	}

	public function loginUser()
	{
		//dep($_POST);
		if (!empty($_POST)) {
			if (empty($_POST["txtEmail"]) || empty($_POST["txtPassword"])) {
				$arrResponse = array('status ' => false, 'msg' => 'Error de datos');

			} else {
				$strUsuario = strtolower(strClean($_POST["txtEmail"]));
				$strPassword = hash("SHA256", $_POST["txtPassword"]);
				$requestUser = $this->model->loginUser($strUsuario, $strPassword);
				if (empty($requestUser)) {
					$arrResponse = array('status' => false, 'msg' => "El usuario o la contraseña son incorrectos");
				} else {
					$arrData = $requestUser[0];
					if ($arrData['status'] == 1) {
						$_SESSION['idUser'] = $arrData['idpersona'];
						$_SESSION['login'] = true;
						$_SESSION['timeout'] = true;
						$_SESSION['inicio'] = time();
						$aux = $this->model->sessionLogin($arrData['idpersona']);
						$arrResponse = array('status' => true, 'msg' => 'ok');
					} else {
						$arrResponse = array('status' => false, 'msg' => 'Usuario inactivo');
					}
				}
			}
			sleep(2);
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}


	public function resetPass()
	{
		if (!empty($_POST)) {
			if (empty($_POST['txtEmailReset'])) {
				$arrResponse = array('status' => false, 'msg' => "ERROR DE DATOS");
			} else {
				$token = token();
				$strEmail = strtolower(strClean($_POST['txtEmailReset']));
				$arrData = $this->model->getUserEmail($strEmail);
				if (empty($arrData)) {
					$arrResponse = array('status' => false, 'msg' => 'Usuario no encontrado');
				} else {
					$aux = $arrData[0];
					$idpersona = $aux['idpersona'];
					//$nombreUsuario = $arrData['nombres'] . ' ' . $arrData['apellidos'];

					//$url_recovery = base_url() . 'login/confirmUser' . $strEmail . '/' . $token;

					$requestUpdate = $this->model->setTokenUser($idpersona, $token);

					/*$dataUsuario = array('nombreUsuario' => $nombreUsuario,
						'email' => $strEmail,
						'asunto' => 'Recuperar cuenta -' . NOMBRE_REMITENTE,
						'url_recovery' => $url_recovery);
					*/if ($requestUpdate) {
						/*$sentEmail = sendEmail($dataUsuario, 'email_cambioPassword');
						if ($sentEmail) {
						}*/
						$arrResponse = array('status' => true, 'msg' => 'Se ha enviado un email a tu cuenta de correo para cambiar tu contraseña');
					} else {
						$arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso intentalo mas tarde');
					}
				}
			}
			sleep(2);
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function confirmUser(string $params)
	{

		if (empty($params)) {
			header('Location: ' . base_url());
		} else {
			$arrParams = explode(',', $params);
			$strEmail = strClean($arrParams[0]);
			$strToken = strClean($arrParams[1]);
			$arrResponse = $this->model->getUsuario($strEmail, $strToken);


			if (empty($arrResponse)) {
				header('Location: ' . base_url());
			} else {
				$aux = $arrResponse[0];
				$data['page_tag'] = "Cambiar contraseña";
				$data['page_title'] = "Cambiar Contraseña";
				$data['page_name'] = "cambiar_contrasena";
				$data['idpersona'] = $aux['idpersona'];
				$data['token'] = $strToken;
				$data['email'] = $strEmail;
				$data['page_functions_js'] = "function_login.js";
				$this->views->getView($this, "cambiar_password", $data);
			}
		}
		die();
	}

	public function setPassword()
	{

		if (empty($_POST['idUsuario']) || empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm']) || empty($_POST['txtEmail']) || empty($_POST['txtToken'])) {
			$arrResponse = array('status' => false, 'msg' => 'Error de datos');
		} else {
			$intIdpersona = intval($_POST['idUsuario']);
			$strPassword = $_POST['txtPassword'];
			$strPasswordConfirm = $_POST['txtPasswordConfirm'];
			$strEmail = strClean($_POST['txtEmail']);
			$strToken = strClean($_POST['txtToken']);


			if ($strPassword != $strPasswordConfirm) {
				$arrResponse = array('status' => false, 'msg' => 'Las contraseñas no son iguales.');
			} else {
				$arrResponseUser = $this->model->getUsuario($strEmail, $strToken);
				if (empty($arrResponseUser)) {
					$arrResponse = array('status' => false, 'msg' => 'Error de datos.');
				} else {
					$strPassword = hash("SHA256", $strPassword);
					$requestPass = $this->model->insertPassword($intIdpersona, $strPassword);
					if ($requestPass) {
						$arrResponse = array('status' => true, 'msg' => 'Contraseña actualizada con exitoso.');
					} else {
						$arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intente mas tarde.');
					}
				}
			}

		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}
}
?>