<?php 

	class Dashboard extends Controllers{
		public function __construct()
		{
			parent::__construct();
			sessionStart();
			if(empty($_SESSION['login'])){
				header('Location: '.base_url().'login');
			}
			getPermisos(1);
		}

		public function dashboard()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Inicio";
			$data['page_title'] = "Inicio";
			$data['page_name'] = "Inicio";
			$this->views->getView($this,"dashboard",$data);
		}

	}
 ?>