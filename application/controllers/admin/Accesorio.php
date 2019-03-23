<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accesorio extends CI_Controller {

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

		$this->load->model('admin/Accesorio_model');  
		$this->load->model('admin/Menu_model');
		$this->load->model('accion/Accion_model');
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
		
		$total_row = $this->Accesorio_model->record_count();
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

		// Seguridad :: Validar URL usuario	
		$menu_session = $this->session->menu;	
		//parametros($menu_session);

		$data['menu'] = $this->session->menu;
		$data['contador_tabla'] = $contador_tabla;
		
		$data['registros'] = $this->Accesorio_model->get_pais(  $config["per_page"], $page  );
		$data['column'] = $this->column();
		$data['fields'] = $this->fields();
		$data['home'] = 'template/lista_template';

		$this->parser->parse('template2', $data);
	}
	
	public function nuevo(){
		
		$data['menu'] = $this->session->menu;
		$data['home'] = 'admin/pais/a_nuevo';

		$this->parser->parse('template2', $data);
	}

	public function crear(){
		
		$this->Accesorio_model->crear( $_POST );

		redirect(base_url()."admin/accesorio/index");
	}

	public function editar( $accesorio ){

		$data['menu'] = $this->session->menu;
		$data['accesorio'] = $this->Accesorio_model->editar( $accesorio );
		$data['home'] = 'admin/pais/a_edit';

		$this->parser->parse('template2', $data);
	}
	
	public function update( ){
		// UPDATE PAIS //
		$data['pais'] = $this->Accesorio_model->update( $_POST );
		
		redirect(base_url()."admin/accesorio/index");
	}
	
	public function delete( $id_pais ){
		// DELETE PAIS //
		$data['pais'] = $this->Pais_model->pais_delete( $id_pais );
		
		redirect(base_url()."admin/pais/index");
	}

// End PAIS

// Start Departamento **********************************************************************************

	public function dep( $pais_id ){
		// Get Departamentos

		$id_rol = $this->session->userdata['usuario'][0]->id_rol;

		$data['menu'] = $this->session->menu;
		$data['depart'] = $this->Pais_model->get_dep( $pais_id );
		$data['id_departamento'] = $pais_id;
		$data['home'] = 'admin/pais/dep';

		$this->parser->parse('template', $data);
	}

	public function nuevo_dep( $id_pais ){
		// Mostrar formulario para crear nuevo departamento

		$id_rol = $this->session->userdata['usuario'][0]->id_rol;

		$data['menu'] = $this->session->menu;
		$data['id_pais'] = $id_pais;
		$data['home'] = 'admin/pais/dep_nuevo';

		$this->parser->parse('template', $data);
	}

	public function crear_dep(){
		// Guardar el nuevo departamento

		$this->Pais_model->crear_dep( $_POST );

		redirect(base_url()."admin/pais/dep/".$_POST['id_pais']);
	}

	public function editar_dep( $id_dep ){
		// Editar Departamento

		$id_rol = $this->session->userdata['usuario'][0]->id_rol;

		$data['menu'] = $this->session->menu;
		$data['dep'] = $this->Pais_model->editar_dep( $id_dep );
		$data['home'] = 'admin/pais/dep_editar';

		$this->parser->parse('template', $data);
	}

	public function update_dep(){

		$this->Pais_model->update_dep( $_POST );
		
		redirect(base_url()."admin/pais/dep/".$_POST['id_pais']);
	}

// End Departamento

// Start Ciudad **********************************************************************************

	public function ciu($id_dep){
		$id_rol = $this->session->userdata['usuario'][0]->id_rol;

		$data['menu'] = $this->session->menu;
		$data['ciu']  = $this->Pais_model->get_ciu_by( $id_dep );
		$data['home'] = 'admin/pais/ciu';

		$this->parser->parse('template', $data);
	}

	public function nuevo_ciu( $id_dep ){
		$id_rol = $this->session->userdata['usuario'][0]->id_rol;

		$data['menu'] = $this->session->menu;
		$data['dep']  =  $id_dep;
		$data['home'] = 'admin/pais/ciu_nuevo';

		$this->parser->parse('template', $data);
	}

	public function crear_ciu(){

		$this->Pais_model->crear_ciu( $_POST );
		
		redirect(base_url()."admin/pais/ciu/".$_POST['id_departamento']);
	}

	public function editar_ciu( $id_ciu ){
		$id_rol = $this->session->userdata['usuario'][0]->id_rol;

		$data['menu'] = $this->session->menu;
		$data['ciu']  =  $this->Pais_model->get_ciu( $id_ciu );
		$data['home'] = 'admin/pais/ciu_editar';

		$this->parser->parse('template', $data);
	}

	public function update_ciu(){

		$this->Pais_model->update_ciu( $_POST );
		
		redirect(base_url()."admin/pais/ciu/".$_POST['departamento']);
	}

	public function column(){

		$column = array(
			'#','Nombre','Descripcion','Estado'
		);
		return $column;
	}

	public function fields(){
		$fields['field'] = array(
			'Accesorios_name','Accesorios_descripcion','estado'
		);
		
		$fields['id'] = array('Accesorio_id');
		$fields['estado'] = array('Accesorios_status');
		$fields['titulo'] = "Accesorios Lista";

		return $fields;
	}

}

?>
