<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Functiones extends CI_Controller {

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

		$this->load->model('admin/Functiones_model');  
		$this->load->model('admin/Menu_model');
		$this->load->model('accion/Accion_model');
	}

// Start  **********************************************************************************

	public function index(){

		//Paginacion
		$_SESSION['per_page']='';
		$contador_tabla;
		if( isset( $_POST['total_pagina'] )){
			$per_page = $_POST['total_pagina'];
			$_SESSION['per_page'] = $per_page;
		}else{
			if($_SESSION['per_page'] == ''){
				$_SESSION['per_page'] = 10;
			}			
		}
		
		$total_row = $this->Functiones_model->record_count();
		$config = paginacion($total_row, $_SESSION['per_page'] , "admin/functiones/index");
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

		
		$menu_session = $this->session->menu;	

		$data['menu'] = $this->session->menu;
		$data['column'] = $this->column();
		$data['fields'] = $this->fields();
		$data['contador_tabla'] = $contador_tabla;
		
		$data['registros'] = $this->Functiones_model->get_giros( $config["per_page"], $page );
		$data['home'] = 'template/lista_template';

		$this->parser->parse('template2', $data);
	}

	public function nuevo(){


		$data['menu'] = $this->session->menu;		
		$data['home'] = 'admin/giros/giros_nuevo';

		$this->parser->parse('template2', $data);
	}

	public function crear(){
		// Insert Nuevo Giro
		$data = $this->Functiones_model->crear( $_POST );

		redirect(base_url()."admin/functiones/index");
	}

	public function editar( $function_id ){
		
		

		$data['menu'] = $this->session->menu;		
		$data['Funciones'] = $this->Functiones_model->editar( $function_id );
		$data['home'] = 'admin/giros/giros_editar';

		$this->parser->parse('template2', $data);
	}

	public function update(){
		// Actualizar Giro 
		$data = $this->Functiones_model->update( $_POST );

		redirect(base_url()."admin/functiones/index");
	}

	public function get_atributos( $id_giro ){

		$data['atributos'] = $this->Atributos_model->geAllAtributos();
		$data['atributos_total'] = $this->Atributos_model->get_atributos_total();
		$data['giro'] = $this->Giros_model->get_giro_id( $id_giro );
		$data['plantilla'] = $this->Giros_model->get_plantilla( $id_giro );
		$data['plantilla_giro_total'] = $this->Giros_model->get_total_plantilla_giro( $id_giro );

		echo json_encode( $data );
		//echo json_encode( $giro );
	}

	public function guardar_giro_atributos(){

		$this->Giros_model->insert_plantilla( $_POST );

		$data['plantilla'] = $this->Giros_model->get_plantilla( $_POST['giro'] );
		$data['plantilla_giro_total'] = $this->Giros_model->get_total_plantilla_giro( $_POST['giro']  );
		
		echo json_encode( $data );
		
	}

	public function eliminar_giro_atributos(){
		$this->Giros_model->eliminar_plantilla( $_POST );

		$data['plantilla'] = $this->Giros_model->get_plantilla( $_POST['giro'] );
		$data['plantilla_giro_total'] = $this->Giros_model->get_total_plantilla_giro( $_POST['giro']  );
		
		echo json_encode( $data );
	}

	// GIROS EMPRESA

	public function listar_giros(){
		$data['lista_giros'] = $this->Giros_model->getAllgiros();
		$data['lista_empresa'] = $this->Giros_model->get_empresa2();

		echo json_encode( $data );
	}

	public function guardar_giro_empresa(){
		$this->Giros_model->insert_giro_empresa( $_POST );
	}

	public function get_empresa_giro( $id_empresa ){
		$data['lista_giros'] = $this->Giros_model->get_empresa_giro( $id_empresa );
		$data['empresa_giro_total'] = $this->Giros_model->get_total_empresa_giro( $id_empresa );

		echo json_encode( $data );
	}

	public function eliminar_giro_empresa(){
		$this->Giros_model->eliminar_giro_empresa( $_POST );

		$data['lista_giros'] = $this->Giros_model->get_empresa_giro( $_POST['empresa']  );
		$data['empresa_giro_total'] = $this->Giros_model->get_total_empresa_giro( $_POST['empresa'] );
		
		echo json_encode( $data );
	}

	public function column(){

		$column = array(
			'#','Nombre','Estado'
		);
		return $column;
	}

	public function fields(){
		$fields['field'] = array(
			'Function_name','estado'
		);
		
		$fields['id'] = array('Function_id');
		$fields['estado'] = array('Function_status');
		$fields['titulo'] = "Funciones Lista";

		return $fields;
	}
	

}

?>
