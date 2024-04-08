<?php
require_once("Libraries/Core/Mysql.php");
class ClientesModel extends Mysql
{
    private $intIdUsuario;
    private $strIdentificacion;
    private $strNombre;
    private $strApellido;
    private $intTelefono;
    private $strEmail;
    private $strPassword;
    private $strToken;
    private $intTipoId;
    private $intStatus;
    private $strNit;
    private $strNomFiscal;
    private $strDirFiscal;
    private $intRolid;
    private $strCfdi;

    public function __construct()
    {
        parent::__construct();
    }

    public function selectClientes()
    {
        $sql = "SELECT p.idpersona,p.indentificacion,p.nombres,p.apellidos,p.telefono,p.email_user,p.status
					FROM persona p 
					INNER JOIN rol r
					ON p.rolid = r.idrol
					WHERE p.status != 0 and p.rolid = 4";
        $request = $this->select_all($sql);
        return $request;
    }

    public function insertCliente(
        string $identificacion,
        string $nombre,
        string $apellido,
        string $telefono,
        string $email,
        string $password,
        string $nit,
        string $nombreFiscal,
        string $dirFiscal,
        string $cfdi
    ) {

        $this->strIdentificacion = $identificacion;
        $this->strNombre = $nombre;
        $this->strApellido = $apellido;
        $this->intTelefono = $telefono;
        $this->strEmail = $email;
        $this->strPassword = $password;
        $this->strNit = $nit;
        $this->strNomFiscal = $nombreFiscal;
        $this->strDirFiscal = $dirFiscal;
        $this->intRolid = 4;
        $this->intStatus = 1;
        $this->strCfdi = $cfdi;
        $return = 0;

        $sql = "SELECT * FROM persona WHERE 
					email_user = '{$this->strEmail}' or indentificacion = '{$this->strIdentificacion}' ";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $query_insert = "INSERT INTO persona (`indentificacion`, `nombres`, `apellidos`, `telefono`, `email_user`, `password`, `rfc`, `nombrefical`, `direccionfiscal`, `cfdi`, `rolid`, `status`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
            $arrData = array(
                $this->strIdentificacion,
                $this->strNombre,
                $this->strApellido,
                $this->intTelefono,
                $this->strEmail,
                $this->strPassword,
                $this->strNit,
                $this->strNomFiscal,
                $this->strDirFiscal,
                $this->strCfdi,
                $this->intRolid,
                $this->intStatus,
            );
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = "exist";
        }
        return $return;
    }



    public function selectCliente(int $idpersona)
    {
        $this->intIdUsuario = $idpersona;
        $sql = "SELECT idpersona,indentificacion,nombres,apellidos,telefono,email_user,rfc,nombrefical,direccionfiscal,cfdi,status, DATE_FORMAT(datecreated, '%d-%m-%Y') as fechaRegistro 
				FROM persona
				WHERE idpersona = $this->intIdUsuario and rolid = 4";
        $request = $this->select($sql);
        return $request;
    }

    public function updateCliente(int $idUsuario, string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $password, string $nit, string $nomFiscal, string $dirFiscal, string $cfdi)
    {

        $this->intIdUsuario = $idUsuario;
        $this->strIdentificacion = $identificacion;
        $this->strNombre = $nombre;
        $this->strApellido = $apellido;
        $this->intTelefono = $telefono;
        $this->strEmail = $email;
        $this->strPassword = $password;
        $this->strNit = $nit;
        $this->strNomFiscal = $nomFiscal;
        $this->strDirFiscal = $dirFiscal;
        $this->strCfdi = $cfdi;


        $sql = "SELECT * FROM persona WHERE (email_user = '{$this->strEmail}' AND idpersona != $this->intIdUsuario)
									  OR (indentificacion = '{$this->strIdentificacion}' AND idpersona != $this->intIdUsuario) ";
        $request = $this->select_all($sql);

        if ($this->strPassword  != "") {
            $sql = "UPDATE persona SET indentificacion=?, nombres=?, apellidos=?, telefono=?, email_user=?, password=?,rfc=?, nombrefical=?, direccionfiscal=?, cfdi = ?
						WHERE idpersona = $this->intIdUsuario ";
            $arrData = array(
                $this->strIdentificacion,
                $this->strNombre,
                $this->strApellido,
                $this->intTelefono,
                $this->strEmail,
                $this->strPassword,
                $this->strNit,
                $this->strNomFiscal,
                $this->strDirFiscal,
                $this->strCfdi
            );
        } else {
            $sql = "UPDATE persona SET indentificacion=?, nombres=?, apellidos=?, telefono=?, email_user=?, rfc=?, nombrefical=?, direccionfiscal=?, cfdi = ?
						WHERE idpersona = $this->intIdUsuario ";
            $arrData = array(
                $this->strIdentificacion,
                $this->strNombre,
                $this->strApellido,
                $this->intTelefono,
                $this->strEmail,
                $this->strNit,
                $this->strNomFiscal,
                $this->strDirFiscal,
                $this->strCfdi
            );
        }
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function deleteCliente(int $intIdpersona)
    {
        $this->intIdUsuario = $intIdpersona;
        $sql = "UPDATE persona SET status = ? WHERE idpersona = $this->intIdUsuario ";
        $arrData = array(0);
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
