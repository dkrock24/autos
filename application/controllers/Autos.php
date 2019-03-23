<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autos extends CI_Controller {

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

		// Cargamos la base de datos prefijada client y definida en conf del framework

		$this->load->library('parser');
		$this->load->helper('url');	
		$this->load->model('admin/Acceso_model');
		$this->load->model('admin/Autos_model');
		$this->load->model('admin/Functiones_model');
	}

	public function index()
	{
		// Este metodo carga la vista del login del sistema
		$data['brands'] = $this->Acceso_model->brands();
		$data['autos'] = $this->Autos_model->catalogo();
		$data['alquiler'] = $this->Autos_model->catalogo_alquiler();
		$data['home'] = 'index';

		$this->parser->parse('template', $data);
	}

	public function get_detalle_auto($id){
		$data['detalle'] = $this->Autos_model->get_detalle_auto($id);
		$data['funciones'] = $this->Autos_model->getFunciones($id);
		$data['accesorios'] = $this->Autos_model->getAccesorios($id);
		
		echo json_encode($data);
	}

	public function login(){
		// Se autentica el usuario luego de ingresar sus credenciales
		$this->load->model('Login_model');

		if(isset($_POST['usuario']) and isset($_POST['passwd'])){	

			$usuario = $_POST['usuario'];
			$passwd  = $_POST['passwd'];

			// Autenticamos al usuario respecto a su negocio
			$user['usuario'] = $this->Login_model->login( $usuario , $passwd );	


			if($user['usuario'] != 0){	
				$_SESSION['db'] = $user;
				
				$_SESSION['usuario'] = $user;
				header("location:../admin/home/index");

			}else{
				//$this->session->set_flashdata('warning', "Usuario / Password Incorrectos");
				$this->load->view('login');
			}
		}		
		else{			
			$this->load->view('login');
		}
	}

	public function validar(){

		$this->load->model('Login_model');

		$a = @$_SESSION['db']['usuario'][0]->nombre_usu;
		$b = @$_SESSION['db']['usuario'][0]->password_usu;

		$user = array();
		$user = $this->Login_model->autenticacion( $a , $b );

		//$roles = $this->Usuario_model->get_usuario_roles( $user[0]->id_usuario );

			if($user != 0){	
				session_start();
				
				$_SESSION['usuario'] = $user;

				header("location:../admin/home/seleccionar_empresa");

			}else{
				$this->session->set_flashdata('warning', "Usuario / Password Incorrectos");
				$this->load->view('login');
			}
	}

	public function admin(){
		// Este metodo carga la vista del login del sistema
		$data['brands'] = $this->Acceso_model->brands();
		$data['home'] = 'login';

		$this->load->view('login');
	}


	public function logout(){
		//$this->session->sess_destroy();
		$this->load->view('login');
	}
}

