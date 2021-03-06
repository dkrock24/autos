<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persona extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->database(); 

		$this->load->library('parser');
		@$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('paginacion/paginacion_helper');
		$this->load->library('pagination');   
		$this->load->helper('seguridad/url_helper');
		$this->load->model('accion/Accion_model');	

		$this->load->model('admin/Menu_model');
		$this->load->model('admin/Terminal_model');
		
		$this->load->model('admin/Cliente_model');
		$this->load->model('admin/Usuario_model');
		$this->load->model('admin/ModoPago_model');
		$this->load->model('admin/Ciudad_model');
		$this->load->model('admin/Sexo_model');
		$this->load->model('admin/Persona_model');
		$this->load->model('producto/Producto_model');				
		$this->load->model('producto/Orden_model');
		$this->load->model('admin/Autos_model');
	}

	public function index()
	{
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
		
		$total_row = $this->Persona_model->record_count();
		$config = paginacion($total_row, $_SESSION['per_page'] , "admin/pais/index");
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


		// GET PAIS
		//$id_rol = $this->session->userdata['usuario'][0]->id_rol;

		// Seguridad :: Validar URL usuario	
		$menu_session = $this->session->menu;	
		//parametros($menu_session);

		$id_rol = $this->session->roles[0];
		$vista_id = 20; // Vista Orden Lista
		//$id_usuario 	= $this->session->usuario[0]->id_usuario;

		$data['menu'] = $this->session->menu;
		$data['contador_tabla'] = $contador_tabla;
		
		$data['registros'] = $this->Persona_model->getPersona(  $config["per_page"], $page  );
		$data['column'] = $this->column();
		$data['fields'] = $this->fields();
		$data['home'] = 'template/lista_template';

		$this->parser->parse('template2', $data);
	}

	public function nuevo(){

		// Seguridad :: Validar URL usuario	
		$menu_session = $this->session->menu;	
		parametros($menu_session);

		$id_rol = $this->session->roles[0];
		$vista_id = 20; // Vista Orden Lista

		$data['menu'] = $this->session->menu;
		$data['autos'] = $this->Autos_model->getAutoAlquiler();

		$data['home'] = 'admin/persona/persona_nuevo';

		$this->parser->parse('template2', $data);
	}

	public function crear(){

		$this->Autos_model->crear_alquiler( $_POST );

		redirect(base_url()."admin/persona/index");
	}

	public function editar( $auto_rentado_id ){
		// Seguridad :: Validar URL usuario	
		$menu_session = $this->session->menu;	
		parametros($menu_session);

		$data['menu'] 	= $this->session->menu;		
		$data['rentado']= $this->Persona_model->getAutoRentadoId( $auto_rentado_id );
		$data['autos'] = $this->Autos_model->getAutoAlquiler();

		$data['home'] 	= 'admin/persona/persona_editar';

		$this->parser->parse('template2', $data);
	}

	public function update(){

		$data['bodegas'] = $this->Autos_model->update_alquiler( $_POST );

		redirect(base_url()."admin/persona/index");
	}

	public function ver( $id_rentado ){
		$menu_session = $this->session->menu;	
		parametros($menu_session);

		$data['menu'] 	= $this->session->menu;		
		$data['rentado']= $this->Persona_model->getAutoRentadoId( $id_rentado );
		
		$data['funciones'] = $this->Autos_model->getFunciones( $data['rentado'][0]->Car_id );
		$data['accesorios'] = $this->Autos_model->getAccesorios($data['rentado'][0]->Car_id);
		

		$data['home'] 	= 'admin/persona/ver';

		$this->parser->parse('template2', $data);
	}

		public function column(){

		$column = array(
			'#','Marca','Modelo','Cliente','Estado'
		);
		return $column;
	}

	public function fields(){
		$fields['field'] = array(
			'Brand_name','Brand_Line_name','full_name','estado'
		);
		
		$fields['id'] = array('Car_rental_id');
		$fields['estado'] = array('rentado_estado');
		$fields['titulo'] = "Rentados Lista";

		return $fields;
	}
}