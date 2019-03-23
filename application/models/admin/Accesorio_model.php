<?php
class Accesorio_model extends CI_Model {
	
	const accesorio =  'accesorio';
    const caraccesorio =  'caraccesorio';

    
	function get_pais( $limit, $id  ){

		$this->db->select('*');
        $this->db->from(self::accesorio.' as p');
        $this->db->limit($limit, $id);
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        } 
	}

	function record_count(){
        return $this->db->count_all(self::accesorio);
    }

	// EDITAR PAIS //
	function getAllAccesorios( ){

		$this->db->select('*');
        $this->db->from(self::accesorio);
        $query = $this->db->get(); 
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        } 
	}

	// UPDATE PAIS //
	function update( $accesorio ){

		$data = array(
            'Accesorios_name' => $accesorio['Accesorios_name'],
            'Accesorios_descripcion' => $accesorio['Accesorios_descripcion'],            
            'Accesorios_status' => $accesorio['Accesorios_status']
        );

        $this->db->where('Accesorio_id', $accesorio['Accesorio_id']);
        $this->db->update(self::accesorio, $data);  
	}

	function crear( $accesorio ){

		$data = array(
            'Accesorios_name' => $accesorio['Accesorios_name'],
            'Accesorios_descripcion' => $accesorio['Accesorios_descripcion'],            
            'Accesorios_status' => $accesorio['Accesorios_status']
        );
		$this->db->insert(self::accesorio, $data ); 
	}

    function editar( $accesorio ){

        $this->db->select('*');
        $this->db->from(self::accesorio);
        $this->db->where('Accesorio_id', $accesorio );
        $query = $this->db->get(); 
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        } 
    }

// DEPARTAMENTOS ---------------------------------------------------------------------

	function get_dep( $id_pais ){

		$this->db->select('*');
        $this->db->from(self::accesorio.' as p');
        
        $this->db->where('p.id_pais',$id_pais ); 

        $query = $this->db->get(); 
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        } 
	}

	function crear_dep( $departamento ){

		$data = array(
            'nombre_depa' 	=> $departamento['nombre_depa'],
            'estado_depa' 	=> $departamento['estado_depa'],
            'fecha_creacion_depa' => date("Y-m-d"),
            'id_pais' 		=> $departamento['id_pais']
        );

		$this->db->insert(self::accesorio, $data ); 
	}

	function editar_dep( $id_dep ){

		$this->db->select('*');
        $this->db->from(self::accesorio.' as p');
        
        $this->db->where('pd.id_depa',$id_dep ); 

        $query = $this->db->get(); 
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
	}

	function update_dep( $departamento ){

		$data = array(
           'nombre_depa' 	=> $departamento['nombre_depa'],
            'estado_depa' 	=> $departamento['estado_depa'],
            'fecha_actuqalizacion_depa' => date("Y-m-d"),
        );

        $this->db->where('id_depa', $departamento['id_depa']);
		$this->db->update(self::accesorio, $data ); 
	}


    function getCarAccesorios($id_car){
        $this->db->select('*');
        $this->db->from(self::accesorio.' as a');
        $this->db->join(self::caraccesorio.' as ca', ' on a.Accesorio_id = ca.Accesorio_id','right');
        $this->db->where('ca.Car_id',$id_car ); 

        $query = $this->db->get(); 
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

// END


}

?>

