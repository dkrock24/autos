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

		$this->load->library('parser');
		@$this->load->library('session');
		$this->load->library('pagination');   

		$this->load->helper('url');
		$this->load->helper('seguridad/url_helper');
		$this->load->helper('paginacion/paginacion_helper');

		$this->load->model('accion/Accion_model');	
		$this->load->model('admin/Menu_model');
		$this->load->model('admin/Terminal_model');
		
		$this->load->model('admin/Cliente_model');
		$this->load->model('admin/Usuario_model');
		$this->load->model('admin/Functiones_model');
		$this->load->model('admin/Correlativo_model');
		$this->load->model('admin/Accesorio_model');
		$this->load->model('admin/Autos_model');
	}

	public function index(){
		$_SESSION['per_page']='';
		//Paginacion
		$contador_tabla;
		if( isset( $_POST['total_pagina'] )){
			$per_page = $_POST['total_pagina'];
			$_SESSION['per_page'] = $per_page;
		}else{
			if($_SESSION['per_page'] == ''){
				$_SESSION['per_page'] = 10;
			}			
		}
		
		$total_row = $this->Autos_model->record_count();
		$config = paginacion($total_row, $_SESSION['per_page'] , "admin/autos/index");
		$this->pagination->initialize($config);
		if($this->uri->segment(4)){
			if($_SESSION['per_page']!=0){
				$page = ($this->uri->segment(4) - 1 ) * $_SESSION['per_page'];
				$contador_tabla = $page+1;
			}else{
				$page = 0;
				$contador_tabla =1;
			}
		}else{
			$page = 0;
			$contador_tabla =1;
		}

		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );

		// paginacion End

		// Seguridad :: Validar URL usuario	
		$menu_session = $this->session->menu;	
		parametros($menu_session);

		$id_rol = $this->session->roles[0];
		$vista_id = 8; // Vista Orden Lista

		$data['menu'] = $this->session->menu;
		$data['registros'] = $this->Autos_model->getMoneda(  $config["per_page"], $page  );
		
		$data['contador_tabla'] = $contador_tabla;
		$data['column'] = $this->column();
		$data['fields'] = $this->fields();
		$data['home'] = 'template/lista_template';

		$this->parser->parse('template2', $data);
	}

	public function nuevo(){

		// Seguridad :: Validar URL usuario	
		$menu_session = $this->session->menu;	
		parametros($menu_session);

		$data['brand'] = $this->Autos_model->getBrand();

		$data['menu'] = $this->session->menu;
		$data['home'] = 'admin/autos/a_nuevo';

		$this->parser->parse('template2', $data);
	}

	public function save(){

		if(isset($_POST)){
			$data = $this->Autos_model->save( $_POST );
			redirect(base_url()."admin/autos/car_accesorio/". $data);
		}
		
	}

	public function car_accesorio($id_car){
		// Seguridad :: Validar URL usuario	
		$menu_session = $this->session->menu;	
		parametros($menu_session);

		$data['accesorios'] = $this->Accesorio_model->getAllAccesorios();
		$data['car'] = $id_car;

		$data['menu'] = $this->session->menu;
		$data['home'] = 'admin/autos/accesorios';

		$this->parser->parse('template2', $data);
		//redirect(base_url()."admin/autos/accesorio");
	}

	public function save_accesorios(){

		if(isset($_POST)){
			$data = $this->Autos_model->save_accesorios( $_POST  );
			redirect(base_url()."admin/autos/car_funciones/". $data );
		}
	}

	public function car_funciones($id_car){
		// Seguridad :: Validar URL usuario	
		$menu_session = $this->session->menu;	
		parametros($menu_session);

		$data['funciones'] = $this->Functiones_model->getAllFunciones();
		$data['car'] = $id_car;

		$data['menu'] = $this->session->menu;
		$data['home'] = 'admin/autos/funciones';

		$this->parser->parse('template2', $data);
		//redirect(base_url()."admin/autos/accesorio");
	}

	// Interno
	public function car_accesorio1($id_car){

		$data['accesorios'] = $this->Accesorio_model->getCarAccesorios($id_car);
		$data['allAccesorios'] = $this->Accesorio_model->getAllAccesorios();
		$data['car'] = $id_car;

		$data['menu'] = $this->session->menu;
		$data['home'] = 'admin/autos/accesorios_edit';

		$this->parser->parse('template2', $data);
	}

	public function save_accesorios1(){

		if(isset($_POST)){
			$data = $this->Autos_model->save_accesorios( $_POST  );
			redirect(base_url()."admin/autos/index");
		}
	}

	public function car_funciones1($id_car){

		$data['Allfunciones'] = $this->Functiones_model->getAllFunciones();
		$data['carFunciones'] = $this->Functiones_model->getFuncionesId( $id_car );
		$data['car'] = $id_car;

		$data['menu'] = $this->session->menu;
		$data['home'] = 'admin/autos/funciones_edit';

		$this->parser->parse('template2', $data);
		//redirect(base_url()."admin/autos/accesorio");
	}

	// Interno End

	public function save_funciones(){

		if(isset($_POST)){
			$data = $this->Autos_model->save_funciones( $_POST  );
			redirect(base_url()."admin/autos/index");
		}
	}

	public function save_funciones1(){

		if(isset($_POST)){
			$data = $this->Autos_model->save_funciones( $_POST  );
			redirect(base_url()."admin/autos/index");
		}
	}

	public function ver($id){
		// Seguridad :: Validar URL usuario	
		$menu_session = $this->session->menu;	
		parametros($menu_session);

		$data['auto'] = $this->Autos_model->getOneAuto($id);
		$data['funciones'] = $this->Autos_model->getFunciones($id);
		$data['accesorios'] = $this->Autos_model->getAccesorios($id);
		

		$data['menu'] = $this->session->menu;
		$data['home'] = 'admin/autos/ver';

		$this->parser->parse('template2', $data);
		//redirect(base_url()."admin/autos/accesorio");
	}

	public function getModelo($id){
		$modelo = $this->Autos_model->getModelo($id);
		echo json_encode($modelo);
	}

	

	public function editar( $auto_id ){

		// Seguridad :: Validar URL usuario	
		$menu_session = $this->session->menu;	
		parametros($menu_session);

		$data['menu'] = $this->session->menu;

		$data['auto'] = $this->Autos_model->getOneAuto($auto_id);
		$data['funciones'] = $this->Autos_model->getFunciones($auto_id);
		$data['accesorios'] = $this->Autos_model->getAccesorios($auto_id);
		$data['brand'] = $this->Autos_model->getBrandLines();
		$data['home'] = 'admin/autos/a_editar';

		$this->parser->parse('template2', $data);
	}

	public function update(){
		if(isset($_POST)){
			$data = $this->Autos_model->update( $_POST );

			if($data){
				$this->session->set_flashdata('warning', "Moneda Fue Actualizado");
			}else{
				$this->session->set_flashdata('danger', "Moneda No Fue Creado");
			}
		}

		redirect(base_url()."admin/autos/index");
	}

	public function column(){

		$column = array(
			'#','Marca','Modelo','Año','Precio V','Vendido','Estado'
		);
		return $column;
	}

	public function fields(){
		$fields['field'] = array(
			'Brand_name','Brand_Line_name','Car_year','Car_price_sale','Car_sale','estado'
		);
		
		$fields['id'] = array('Car_id');
		$fields['estado'] = array('Car_status');
		$fields['titulo'] = "Autos Lista";

		return $fields;
	}

	// Galeria

	public function galeria( $car_id ){
		$data['menu'] = $this->session->menu;
		$data['car_id'] = $car_id;
		$data['fotos'] = $this->Autos_model->get_fotos( $car_id );

		$data['home'] = 'admin/autos/galeria';

		$this->parser->parse('template2', $data);
	}

	public function fotografia_save(){
		if(file_get_contents($_FILES['foto']['tmp_name'])){
			$this->Autos_model->fotografia_save($_POST);
		}

		redirect(base_url()."admin/autos/galeria/". $_POST['car_id']);
	}

	public function delete_galeria($id, $car){
		$this->Autos_model->delete_galeria($id);
		redirect(base_url()."admin/autos/galeria/". $car);
	}
}
