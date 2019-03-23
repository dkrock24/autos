<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Linea extends CI_Controller {

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

		$this->load->helper('paginacion/paginacion_helper');
		$this->load->model('admin/Linea_model');  
		$this->load->model('admin/Menu_model');
		$this->load->model('accion/Accion_model');
		$this->load->model('admin/Autos_model');
	}

// Start PAIS **********************************************************************************

	public function index(){

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
		
		$total_row = $this->Linea_model->record_count();
		$config = paginacion($total_row, $_SESSION['per_page'] , "admin/atributos/index");
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

		$data['menu'] = $this->session->menu;
		$data['contador_tabla'] = $contador_tabla;
		
		$data['registros'] = $this->Linea_model->get_atributos(  $config["per_page"], $page );
		$data['column'] = $this->column();
		$data['fields'] = $this->fields();
		$data['home'] = 'template/lista_template';

		$this->parser->parse('template2', $data);
	}

	public function nuevo(){
			
		$data['home'] = 'producto/linea/l_nuevo';
		$data['brand'] = $this->Autos_model->getBrand();
		$data['menu'] = $this->session->menu;

		$this->parser->parse('template2', $data);
	}

	public function save(){
		// Insert pais
		$this->Linea_model->save( $_POST );

		redirect(base_url()."admin/linea/index");
	}

	public function editar( $modelo ){
		
		$data['menu'] = $this->session->menu;		
		$data['modelo'] = $this->Linea_model->editar( $modelo );
		$data['brand'] = $this->Autos_model->getBrand();
		$data['home'] = 'producto/linea/l_editar';

		$this->parser->parse('template2', $data);
	}

	public function update( ){
		
		$this->Linea_model->update( $_POST );
		
		redirect(base_url()."admin/linea/index");
	}

	public function actualizar(){
		// Insert pais
		$this->Atributos_model->actualizar_atributo( $_POST );

		redirect(base_url()."admin/atributos/index");
	}

	public function column(){

		$column = array(
			'#','Marca','Modelo','Descripcion','Estado'
		);
		return $column;
	}

	public function fields(){
		$fields['field'] = array(
			'Brand_name','Brand_Line_name','Brand_Line_description','estado'
		);
		
		$fields['id'] = array('Brand_Line_id');
		$fields['estado'] = array('Brand_Line_status');
		$fields['titulo'] = "Modelos Lista";

		return $fields;
	}

}

?>
