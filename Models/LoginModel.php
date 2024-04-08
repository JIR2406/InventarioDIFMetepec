<?php

class LoginModel extends Mysql
{
	private $intIdUsuario;
	private $strUsuario;
	private $strPassword;
	private $strToken;

	private $strEmail;

	public function __construct()
	{
		parent::__construct();
	}

	public function loginUser(string $usuario, string $pass)
	{
		$this->strUsuario = $usuario;
		$this->strPassword = $pass;
		$sql = "SELECT idpersona, status FROM persona WHERE email_user = '$this->strUsuario' and password = '$this->strPassword' and status != 0 ";
		$request = $this->select($sql);
		return $request;
	}

	public function sessionLogin(int $iduser){
		$this->intIdUsuario = $iduser;
		$sql = "SELECT p.idpersona, p.indentificacion,p.nombres,p.apellidos,p.telefono,p.email_user,p.rfc,p.nombrefical,p.direccionfiscal,p.cfdi,r.idrol,r.nombrerol,p.status FROM persona p INNER JOIN rol r ON p.rolid=r.idrol WHERE p.idpersona=$this->intIdUsuario";
		$request = $this->select($sql);
		$_SESSION['userData'] = $request[0];
		return $request;
	}

	public function getUserEmail(string $email){
		$this->strUsuario = $email;	
		$sql = "SELECT idpersona,nombres,apellidos,status FROM persona WHERE email_user = '$this->strUsuario' AND status = 1";
		$request = $this->select($sql);
		return $request;
	}

	public function setTokenUser(int $idpersona, string $token){
		$this->intIdUsuario = $idpersona;
		$this->strToken = $token;
		$sql = "UPDATE persona SET toke = ? WHERE idpersona = ?";
		// Ejecutar la consulta preparada directamente
		$request = $this->update($sql, [$this->strToken, $this->intIdUsuario]);
		return $request;
	}

	public function getUsuario(string $email,string $token){
		$this->strEmail = $email;
		$this->strToken = $token;
		$sql = "SELECT idpersona FROM persona WHERE email_user = '$this->strEmail' AND toke = '$this->strToken'AND status = 1";
		$request = $this->select($sql);
		return $request;
	}

	public function insertPassword(int $id,string $pass){
		$this->intIdUsuario = $id;
		$this->strPassword = $pass;
		$sql = "UPDATE persona SET password = ?, toke = ? WHERE idpersona = $this->intIdUsuario";
		$arrData = array($this->strPassword,"");
		$request = $this->update($sql,$arrData);
		return $request;
	}
}
?>