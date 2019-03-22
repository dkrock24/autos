<?php
class Accesorio_model extends CI_Model {
	
	const accesorio =  'accesorio';



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
	function update_pais( $pais ){

		$data = array(
            'nombre_pais' => $pais['nombre_pais'],
            'zip_code' => $pais['zip_code'],
            'id_moneda' => $pais['moneda_pais'],
            'fecha_actualizacion_pais' => date("Y-m-d h:i:s"),
            'estado_pais' => $pais['estado_pais']
        );

        $this->db->where('id_pais', $pais['id_pais']);
        $this->db->update(self::accesorio, $data);  
	}

	// Delete Pais
	function pais_delete( $id_pais ){
		
	}

	function crear_pais( $pais ){

		$data = array(
            'nombre_pais' => $pais['nombre_pais'],
            'zip_code' => $pais['zip_code'],
            'id_moneda' => $pais['moneda_pais'],
            'fecha_creacion_pais' => date("Y-m-d h:i:s"),
            'estado_pais' => $pais['estado_pais']
        );
		$this->db->insert(self::accesorio, $data ); 
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

// END


}

?>

