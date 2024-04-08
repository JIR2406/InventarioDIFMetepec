<?php 

	class Permisos extends Controllers{
		public function __construct()
		{
			sessionStart();
			if(empty($_SESSION['login'])){
				header('Location: '.base_url().'login');
			}
			parent::__construct();
		}

		public function getPermisosRol(int $idrol)
		{
			$rolid = intval($idrol);
			if($rolid > 0)
			{
				$arrModulos = $this->model->selectModulos();
				$arrPermisosRol = $this->model->selectPermisosRol($rolid);
				$arrPermisos = array('r' => 0, 'w' => 0, 'u' => 0, 'd' => 0);
				$arrPermisoRol = array('idrol' => $rolid );

				if(empty($arrPermisosRol)) {
					// Si $arrPermisosRol está vacío, asigna los mismos permisos a todos los módulos
					for ($i = 0; $i < count($arrModulos); $i++) {
						$arrModulos[$i]['permisos'] = $arrPermisos;
					}
				} else {
					// Si $arrPermisosRol no está vacío, asigna permisos específicos a cada módulo
					for ($i = 0; $i < count($arrModulos); $i++) {
						// Verifica si existe una entrada correspondiente en $arrPermisosRol
						if (isset($arrPermisosRol[$i])) {
							$arrPermisos = array(
								'r' => $arrPermisosRol[$i]['r'],
								'w' => $arrPermisosRol[$i]['w'],
								'u' => $arrPermisosRol[$i]['u'],
								'd' => $arrPermisosRol[$i]['d']
							);
				
							$arrModulos[$i]['permisos'] = $arrPermisos;
						} else {
							// No hay entrada correspondiente en $arrPermisosRol, asigna permisos predeterminados o maneja el caso según tus necesidades
							$arrModulos[$i]['permisos'] = array('r' => 0, 'w' => 0, 'u' => 0, 'd' => 0);
						}
					}
								
				}
				$arrPermisoRol['modulos'] = $arrModulos;
				$html = getModal("modalPermisos",$arrPermisoRol);
				//dep($arrPermisoRol);

			}
			die();
		}

		public function setPermisos()
		{
			if($_POST)
			{
				$intIdrol = intval($_POST['idrol']);
				$modulos = $_POST['modulos'];

				$this->model->deletePermisos($intIdrol);
				foreach ($modulos as $modulo) {
					$idModulo = $modulo['idmodulo'];
					$r = empty($modulo['r']) ? 0 : 1;
					$w = empty($modulo['w']) ? 0 : 1;
					$u = empty($modulo['u']) ? 0 : 1;
					$d = empty($modulo['d']) ? 0 : 1;
					$requestPermiso = $this->model->insertPermisos($intIdrol, $idModulo, $r, $w, $u, $d);
				}
				if(!($requestPermiso > 0))
				{
					$arrResponse = array('status' => true, 'msg' => 'Permisos asignados correctamente.');
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible asignar los permisos.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

	}
 ?>