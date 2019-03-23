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

	function crear_giro( $nuevo_giro ){

		$data = array(
            'nombre_giro' => $nuevo_giro['nombre_giro'],
            'descripcion_giro' => $nuevo_giro['descripcion_giro'],
            'tipo_giro' => $nuevo_giro['tipo_giro'],
            'codigo_giro' => $nuevo_giro['codigo_giro'],
            'estado_giro' => $nuevo_giro['estado_giro'],
            'fecha_giro_creado' => date("Y-m-d h:i:s")
        );
		$insert = $this->db->insert(self::functions, $data ); 

        return $insert;

	}

	function get_giro_id( $id_giro ){ 

		$this->db->select('*');
        $this->db->from(self::functions);
        $this->db->where('id_giro ='. $id_giro );
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
	}

	function actualizar_giro( $giro ){
		$data = array(
            'nombre_giro' => $giro['nombre_giro'],
            'descripcion_giro' => $giro['descripcion_giro'],
            'tipo_giro' => $giro['tipo_giro'],
            'codigo_giro' => $giro['codigo_giro'],
            'estado_giro' => $giro['estado_giro'],
            'fecha_giro_actualizado' => date("Y-m-d h:i:s")
        );

        $this->db->where('id_giro', $giro['id_giro']);
        $insert = $this->db->update(self::functions, $data);  
        return $insert;
	}

}