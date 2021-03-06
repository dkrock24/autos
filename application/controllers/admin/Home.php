<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();    
		$this->load->database();    

		$this->load->library('parser');
		@$this->load->library('session');
		$this->load->helper('url');

		$this->load->model('admin/Menu_model');
		$this->load->model('admin/Usuario_model');
		$this->load->model('admin/Empresa_model');
	}

	public function index()
	{		
		// Construir Menu		
		$this->load->model('Login_model');
		$usuario_id = $this->session->usuario['usuario'][0]->User_id;
		
		$roles = $this->Usuario_model->get_usuario_roles( $usuario_id );

		
		
		$roles_id = array();
		if(isset($roles)){
	        foreach ($roles as $rol) {
	            $roles_id = $rol->usuario_rol_role;
	        }

	        $_SESSION['roles'] = $roles_id;
			$_SESSION['menu'] =  $this->Menu_model->getMenu( $roles_id );
	    }else{
	    	$_SESSION['msj'] = "No Existen Menus Asignados";
			header("location: info");
	    }
		
		$data['home'] = 'welcome';
		$data['menu'] = $this->session->menu;		

		$this->parser->parse('template2', $data);
	}

	function seleccionar_empresa(){
		// Construir Menu		
		$this->load->model('Login_model');
		$usuario_id = $this->session->usuario[0]->id_usuario;
		$empleado_id = $this->session->usuario[0]->id_empleado;

		$roles = $this->Usuario_model->get_usuario_roles( $usuario_id );
		
		$roles_id = array();
		if(isset($roles)){
			foreach ($roles as $rol) {
	            $roles_id = $rol->usuario_rol_role;
	        }

	        $_SESSION['roles'] = $roles_id;
			$_SESSION['menu'] =  $this->Menu_model->getMenu( $roles_id );
		}

		$data['empresa'] = $this->get_empresa_informacion( $empleado_id );
		$permisoEmpresa = $data['empresa'];

		if(sizeof($permisoEmpresa) <= 1){
			header("location: index");
			$data['home'] = 'home';
		}else{
			$data['home'] = 'selecionar_empresa';
		}
		
		$data['menu'] = $this->session->menu;		

		$this->parser->parse('template', $data);
	}

	function set_empresa($empresa_id){
		$empresa = false;
		if(isset($empresa_id) and $empresa_id != 0){
			$_SESSION['empresa_id'] = $empresa_id;
			$empresa = true;
		}else{
			$empresa = false;
		}
		echo json_encode($empresa);
	}

	function get_empresa_informacion( $empleado_id ){
		// Validar Permiso en Empresa - Sucursales 
		$permisoEmpresa = $this->Usuario_model->permiso_empresa( $empleado_id );
		return $permisoEmpresa;
	}

	function info(){
		$data['msj'] = $this->session->msj;
		$data['home'] = 'admin/notificaciones/informacion';

		$this->parser->parse('template', $data);
	}

}