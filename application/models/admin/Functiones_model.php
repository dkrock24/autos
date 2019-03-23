<?php
class Functiones_model extends CI_Model {
	
	const functions =  'functions';
    const carfunction =  'carfunction';
    
    const plantillas = 'giro_pantilla';
    const atributos = 'atributo';
    const empresa = 'pos_empresa';
    const empresa_plantilla = 'giros_empresa';


	function get_giros( $limit, $id ){;
		$this->db->select('*');
        $this->db->from(self::functions);
        $this->db->limit($limit, $id);
        $query = $this->db->get(); 
        //echo $this->db->queries[2];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        } 
	}

    function getAllFunciones(){;
        $this->db->select('*');
        $this->db->from(self::functions);
        $query = $this->db->get(); 
        //echo $this->db->queries[2];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        } 
    }

    function getFuncionesId( $id_car ){;
        $this->db->select('*');
        $this->db->from(self::functions.' as f');
        $this->db->join(self::carfunction.' as cf','on f.Function_id = cf.Function_id');
        $this->db->where('cf.Car_id', $id_car );
        $query = $this->db->get(); 
        //echo $this->db->queries[2];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        } 
    }

    function record_count(){
        return $this->db->count_all(self::functions);
    }

    function get_empresa(){
        $this->db->select('*');
        $this->db->from(self::functions);
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    function get_empresa2(){
        $this->db->select('id_empresa,nombre_razon_social');
        $this->db->from(self::functions);
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

	function crear( $funciones ){

		$data = array(
            'Function_name' => $funciones['Function_name'],
            'Function_status' => $funciones['Function_status'],
        );
		$insert = $this->db->insert(self::functions, $data ); 

        return $insert;

	}

	function editar( $function_id ){ 

		$this->db->select('*');
        $this->db->from(self::functions);
        $this->db->where('Function_id ='. $function_id );
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
	}

	function update( $funciones ){
		$data = array(
            'Function_name' => $funciones['Function_name'],
            'Function_status' => $funciones['Function_status'],
        );
        
        $this->db->where('Function_id', $funciones['Function_id']);
        $insert = $this->db->update(self::functions, $data);  
        return $insert;
	}

}