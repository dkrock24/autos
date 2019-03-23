<?php
class Linea_model extends CI_Model {
	
	const brand =  'brand';
    const brand_line =  'brand_line';

	function get_atributos( $limit, $id  ){

		$this->db->select('*');
        $this->db->from(self::brand.' as b');
        $this->db->join(self::brand_line.' l ', ' on b.Brand_id = l.Brand_id', 'right'); 
        $this->db->order_by('b.Brand_id'); 
        $this->db->limit($limit, $id);
        $query = $this->db->get(); 
        //echo $this->db->queries[2];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        } 
	}

    function geAllAtributos(){

        $this->db->select('*');
        $this->db->from(self::brand_line);
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        } 
    }

    function record_count(){
        return $this->db->count_all(self::brand_line);
    }

    function get_atributos_total(){

        $this->db->select('count(*) as atributos_total');
        $this->db->from(self::brand_line);
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        } 
    }

	function save( $modelos){

        
		$data = array(
            'Brand_Line_name' => $modelos['Brand_Line_name'],
            'Brand_Line_description' => $modelos['Brand_Line_description'],
            'Brand_Line_status' => $modelos['Brand_Line_status'],
            'Brand_id' => $modelos['Brand_id'],
        );
		$this->db->insert(self::brand_line, $data ); 
	}

    function editar($modelo ){

        $this->db->select('*');
        $this->db->from(self::brand_line);
        $this->db->where('Brand_Line_id', $modelo);
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        } 
    }

    function update( $modelo){

        $data = array(
            'Brand_Line_name' => $modelo['Brand_Line_name'],
            'Brand_Line_description' => $modelo['Brand_Line_description'],
            'Brand_Line_status' => $modelo['Brand_Line_status'],
            'Brand_id' => $modelo['Brand_id'],
        );
        $this->db->where('Brand_Line_id', $modelo['Brand_Line_id'] ); 
        $this->db->update(self::brand_line, $data ); 

    }

    function guardar_atributos_opciones( $ultimo_id , $atributos ){
        // esta funcion guarda las opcciones de los tipos de atributos de multiples opciones
        var_dump($atributos);
        $contador = 1;
        foreach ($atributos as $key => $value) {

            $option = (int)$key;

            $int2 = (int) $option;
            
            if($int2 != 0){

                $data = array(
                    'Atributo'  => $ultimo_id,
                    'attr_valor' => $value,
                    'attr_fecha_creado' => date("Y-m-d h:i:s"),
                    'attr_estado' => 1
                );
                $this->db->insert(self::brand_line, $data ); 
                $contador += 1;
            }            
        }
    }

	function get_atributo_id( $id_prod_atributo ){ 

		$this->db->select('*');
        $this->db->from(self::brand_line.' as a');
        $this->db->join(self::brand_line.' as op ',' on op.Atributo=a.id_prod_atributo', 'left');
        $this->db->where('a.id_prod_atributo ='. $id_prod_atributo );
        
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
	}

	function actualizar_atributo( $atributo ){

		$data = array(
            'nam_atributo' => $atributo['nam_atributo'],
            'tipo_atributo' => $atributo['tipo_atributo'],
            'estado_atributo' => $atributo['estado_atributo'],
            'actualizado_atributo' => date("Y-m-d h:i:s")
        );

        $this->db->where('id_prod_atributo', $atributo['id_prod_atributo']);
        $this->db->update(self::brand_line, $data);  

        $this->deleteOpciones($atributo['id_prod_atributo']);

        $this->guardar_atributos_opciones($atributo['id_prod_atributo'] , $atributo );


	}

    function deleteOpciones($id_atributo){
        $data = array(
            'Atributo' => $id_atributo,
        );

        $this->db->delete(self::brand_line, $data); 
    }
}