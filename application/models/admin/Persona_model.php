<?php
class Persona_model extends CI_Model {
	
	const sys_persona = 'sys_persona';	
    const sys_ciudad = 'sys_ciudad';
    const car = 'car';
    const carrental = 'carrental';
     const brand = 'brand';
    const brand_line = 'brand_line';
	
	function getPersona( $limit, $id ){

		$this->db->select('*');
        $this->db->from(self::carrental.' as r');
        $this->db->join(self::car.' as c', 'on r.Car_id = c.Car_id');
        $this->db->join(self::brand_line.' as bl', 'on bl.Brand_Line_id = c.Brand_Line_id');
        $this->db->join(self::brand.' as b', 'on b.Brand_id = bl.Brand_id');
        $this->db->limit($limit, $id);
        $query = $this->db->get();
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
	}

    function record_count(){
        return $this->db->count_all(self::carrental);
    }

	function crear($datos){

		$data = array(
          	'primer_nombre_persona' 	=> 	$datos['primer_nombre_persona'],
            'segundo_nombre_persona' 	=> $datos['segundo_nombre_persona'],
            'primer_apellido_persona' 	=> $datos['primer_apellido_persona'],
            'segundo_apellido_persona' 	=> $datos['segundo_apellido_persona'],
            'fecha_cumpleaños_persona' 	=> $datos['fecha_cumpleaños_persona'],
            'dui'                       => $datos['dui'],
            'nit'                       => $datos['nit'],
            'direccion_residencia_persona1'=> $datos['direccion_residencia_persona1'],
            'direccion_residencia_persona2'=> $datos['direccion_residencia_persona2'],
            'tel'                       => $datos['tel'],
            'cel'                       => $datos['cel'],
            'mail'                      => $datos['mail'],
            'whatsapp'                  => $datos['whatsapp'],
            'Sexo'                      => $datos['Sexo'],
            'Ciudad'                    => $datos['Ciudad'],
            'comentarios'               => $datos['comentarios'],
            'persona_estado'            => $datos['persona_estado']
        );
        
        $this->db->insert(self::sys_persona, $data);  

	}

	function update($datos){

		$data = array(
            'primer_nombre_persona'     =>  $datos['primer_nombre_persona'],
            'segundo_nombre_persona'    => $datos['segundo_nombre_persona'],
            'primer_apellido_persona'   => $datos['primer_apellido_persona'],
            'segundo_apellido_persona'  => $datos['segundo_apellido_persona'],
            'fecha_cumpleaños_persona'  => $datos['fecha_cumpleaños_persona'],
            'dui'                       => $datos['dui'],
            'nit'                       => $datos['nit'],
            'direccion_residencia_persona1'=> $datos['direccion_residencia_persona1'],
            'direccion_residencia_persona2'=> $datos['direccion_residencia_persona2'],
            'tel'                       => $datos['tel'],
            'cel'                       => $datos['cel'],
            'mail'                      => $datos['mail'],
            'whatsapp'                  => $datos['whatsapp'],
            'Sexo'                      => $datos['Sexo'],
            'Ciudad'                    => $datos['Ciudad'],
            'comentarios'               => $datos['comentarios'],
            'persona_estado'            => $datos['persona_estado']
        );
        $this->db->where('id_persona', $datos['id_persona']);
        $this->db->update(self::sys_persona, $data);  
	}

    function getAutoRentadoId( $id_rentado ){

        $this->db->select('*');
        $this->db->from(self::carrental.' as r');
        $this->db->join(self::car.' as c', 'on r.Car_id = c.Car_id');
        $this->db->join(self::brand_line.' as bl', 'on bl.Brand_Line_id = c.Brand_Line_id');
        $this->db->join(self::brand.' as b', 'on b.Brand_id = bl.Brand_id');
        $this->db->where('r.Car_rental_id', $id_rentado);
        $query = $this->db->get();
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

}