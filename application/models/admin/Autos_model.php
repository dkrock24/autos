<?php
class Autos_model extends CI_Model {
	const empleado =  'sys_empleado';
    const carfunction = 'carfunction';
    const functions = 'functions';
    const persona = 'sys_persona';
    const usuario_roles = 'sys_usuario_roles';
    const empleado_sucursal = 'sys_empleado_sucursal';
    const caraccesorio = 'caraccesorio';
    const car = 'car';
    const brand = 'brand';
    const brand_line = 'brand_line';
    const accesorio = 'accesorio';   
    const carrental = 'carrental';   

    

    

    function getMoneda(  $limit, $id ){
    	$this->db->select('*');
        $this->db->from(self::car.' as c');
        $this->db->join(self::brand_line.' l', ' on c.Brand_Line_id = l.Brand_Line_id');
        $this->db->join(self::brand.' b', ' on b.Brand_id = l.Brand_id');
        $this->db->limit($limit, $id);
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    function getModelo($id){
        $this->db->select('*');
        $this->db->from(self::brand_line);
        $this->db->where('Brand_id', $id );
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    function getAllMoneda(){
        $this->db->select('*');
        $this->db->from(self::car);
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    function getAutoAlquiler(){
        $this->db->select('*');
        $this->db->from(self::car.' as c');
        $this->db->join(self::brand_line.' l', ' on c.Brand_Line_id = l.Brand_Line_id');
        $this->db->join(self::brand.' b', ' on b.Brand_id = l.Brand_id');
        $this->db->where('c.Car_rental', 1 );
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    function crear_alquiler($car){
         $data = array(
            'Car_id' => $car['Car_id'],
            'full_name' => $car['full_name'],
            'age' => $car['age'],
            'dui' => $car['dui'],
            'nit' => $car['nit'],
            'licence' => $car['licence'],
            'address' => $car['address'],
            'phone1' => $car['phone1'],
            'phone2' => $car['phone2'],
            'date_start' => $car['date_start'],
            'date_end' => $car['date_end'],
            'created' => date("Y-m-d"),
            'amount' => $car['amount'],
            'deposito' => $car['deposito'],
            'estado' => $car['estado'],
        );
        $insert = $this->db->insert(self::carrental, $data ); 
    }

    function record_count(){
        return $this->db->count_all(self::car);
    }

    function save($car){

        $data = array(
            'Brand_Line_id' => $car['Brand_Line_id'],
            'Car_price_sale' => $car['Car_price_sale'],
            'Car_price_rental' => $car['Car_price_rental'],
            'Car_negociable' => $car['Car_negociable'],
            'Car_sale' => $car['Car_sale'],
            'Car_rental' => $car['Car_rental'],
            'Car_year' => $car['Car_year'],
            'Car_color' => $car['Car_color'],
            'Car_description' => $car['Car_description'],
            'Car_status' => $car['Car_status'],
        );
        $insert = $this->db->insert(self::car, $data ); 

        return $insert;
    }

    function getMonedaId( $moneda_id ){
        $this->db->select('*');
        $this->db->from(self::car);
        $this->db->where('id_moneda', $moneda_id );
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    function update($moneda){

        $data = array(
            'moneda_nombre' => $moneda['moneda_nombre'],
            'moneda_simbolo' => $moneda['moneda_simbolo'],
            'moneda_estado' => $moneda['moneda_estado'],
            'moneda_alias' => $moneda['moneda_alias']
        );
        $this->db->where('id_moneda', $moneda['id_moneda'] );
        $insert =  $this->db->update(self::car, $data ); 

        return $insert;
    }

    function getOneAuto($id){
        $this->db->select('*');
        $this->db->from(self::car.' as c');
        $this->db->join(self::brand_line.' l', ' on c.Brand_Line_id = l.Brand_Line_id');
        $this->db->join(self::brand.' b', ' on b.Brand_id = l.Brand_id');
        $this->db->where('c.Car_id', $id );
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    function getFunciones($id){
        $this->db->select('*');
        $this->db->from(self::car.' as c');
        $this->db->join(self::carfunction.' cf', ' on cf.Car_id = c.Car_id');
        $this->db->join(self::functions.' f', ' on f.Function_id = cf.Function_id');
        $this->db->where('c.Car_id', $id );
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    function getAccesorios($id){
        $this->db->select('*');
        $this->db->from(self::car.' as c');
        $this->db->join(self::caraccesorio.' ca', ' on ca.Car_id = c.Car_id');
        $this->db->join(self::accesorio.' a', ' on a.Accesorio_id = ca.Accesorio_id');
        $this->db->where('c.Car_id', $id );
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    // Brand
    
    function getBrand(){
        $this->db->select('*');
        $this->db->from(self::brand);
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    // Accesorios

    function save_accesorios($datos){

        foreach ($datos as $key => $value) {
            
            if($key!='car_id'){
                $data = array(
                    'Accesorio_id' => $key,
                    'Car_id' => $datos['car_id']
                );
                $this->db->insert(self::caraccesorio, $data ); 
            }
        }
        return $datos['car_id'];
    }

    // Funciones

     function save_funciones($datos){

        foreach ($datos as $key => $value) {
            if($key!='car_id'){
                $data = array(
                    'Function_id' => $key,
                    'Car_id' => $datos['car_id']
                );
                $this->db->insert(self::carfunction, $data ); 
            }
        }
        return $datos['car_id'];
    }

}
