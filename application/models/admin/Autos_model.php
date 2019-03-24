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
    const gallerycar = 'gallerycar';   
    const user = 'user'; 

    //Catalog
    function catalogo($filtro){
        $this->db->select('*');
        $this->db->from(self::car.' as c');
        $this->db->join(self::brand_line.' l', ' on c.Brand_Line_id = l.Brand_Line_id');
        $this->db->join(self::brand.' b', ' on b.Brand_id = l.Brand_id');
        $this->db->join(self::gallerycar.' g', ' on g.Car_id = c.Car_id');
        
        if($filtro!=1 && $filtro['marca']!=0){
            $this->db->where('b.Brand_id', $filtro['marca'] );
            if(isset($filtro['proposito'])){
                $this->db->where('c.'.$filtro['proposito'], 1 );
            }
            
        }
        
        $query = $this->db->get(); 
        $this->db->queries[1];
        //die;
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    function catalogo_alquiler(){
        $this->db->select('*');
        $this->db->from(self::car.' as c');
        $this->db->join(self::brand_line.' l', ' on c.Brand_Line_id = l.Brand_Line_id');
        $this->db->join(self::brand.' b', ' on b.Brand_id = l.Brand_id');
        $this->db->join(self::gallerycar.' g', ' on g.Car_id = c.Car_id');
        $this->db->where('c.Car_sale', 0 );
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    function get_detalle_auto($id){
        $this->db->select('*');
        $this->db->from(self::car.' as c');
        $this->db->join(self::brand_line.' l', ' on c.Brand_Line_id = l.Brand_Line_id');
        $this->db->join(self::brand.' b', ' on b.Brand_id = l.Brand_id');
        //$this->db->join(self::gallerycar.' g', ' on g.Car_id = c.Car_id');
        $this->db->where('c.Car_id', $id );
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    function get_galeria_auto($id){
        $this->db->select('*');
        $this->db->from(self::gallerycar);
        $this->db->where('Car_id', $id );
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    function persona(){
        $this->db->select('*');
        $this->db->from(self::user);
        $this->db->where('User_id', 2 );
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    public function brandsUsadas()
    {   
        $this->db->select('*');
        $this->db->from(self::brand .' as b');      
        $this->db->join(self::brand_line.' as bl','on b.Brand_id = bl.Brand_id');    
        $this->db->join(self::car.' as c','on bl.Brand_Line_id = c.Brand_Line_id');
        $this->db->where('c.Car_status',1);
        $query = $this->db->get();         
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }  
    }

    

    function get_detalle_funciones($id){
        
    }

    //End Catalogo

    
    function getMoneda(  $limit, $id ){
    	$this->db->select('*');
        $this->db->from(self::car.' as c');
        $this->db->join(self::brand_line.' l', ' on c.Brand_Line_id = l.Brand_Line_id');
        $this->db->join(self::brand.' b', ' on b.Brand_id = l.Brand_id');
        $this->db->order_by('c.Car_sale asc');
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
        //$this->db->where('c.Car_rental', 1 );
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
            'rentado_estado' => $car['rentado_estado'],
        );
        $insert = $this->db->insert(self::carrental, $data ); 

        //Update Car for status Rented

        $rental = array(
            'Car_rental' => 1
        );

        $this->db->where('Car_id', $car['Car_id'] ); 
        $this->db->update(self::car, $rental ); 
    }

    function update_alquiler($car){
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
            'rentado_estado' => $car['rentado_estado'],
        );
        $this->db->where('Car_rental_id', $car['Car_rental_id'] ); 
        $this->db->update(self::carrental, $data ); 

        //Update Car for status Rented
        $rentado =0;
        if($car['rentado_estado']==1){
            $rentado =1;
        }

        $rental = array(
            'Car_rental' => $rentado
        );

        $this->db->where('Car_id', $car['Car_id'] ); 
        $this->db->update(self::car, $rental ); 
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

    function update($car){

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
        $this->db->where('Car_id', $car['Car_id'] );
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


    function getBrandLines(){
        $this->db->select('*');
        $this->db->from(self::brand.' as b');
        $this->db->join(self::brand_line.' as bl', ' on b.Brand_id = bl.Brand_id');
        $this->db->group_by('b.Brand_id');
        $query = $this->db->get(); 
        //echo $this->db->queries[1];
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    // Accesorios

    function save_accesorios($datos){

        $data = array(
            'Car_id' => $datos['car_id'] 
        );
        $this->db->delete(self::caraccesorio, $data);

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

        $data = array(
            'Car_id' => $datos['car_id'] 
        );
        $this->db->delete(self::carfunction, $data);

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

    // Fotografia

    function fotografia_save($datos){
        
        $imagen = file_get_contents($_FILES['foto']['tmp_name']);
        $imageProperties = getimageSize($_FILES['foto']['tmp_name']);

        $data = array(
            'Car_id' => $datos['car_id'],
            'Gallery_image' => $imagen,
            'Gallery_type' => $imageProperties['mime'],
            'Gallery_status' => 1,
        );
        $this->db->insert(self::gallerycar, $data ); 
    }

    function get_fotos($car_id){
        $this->db->select('*');
        $this->db->from(self::gallerycar);
        $this->db->where('Car_id', $car_id);
        $query = $this->db->get(); 
        
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }

    function delete_galeria($id){
        $data = array(
            'Gallery_id' => $id
        );
        $this->db->delete(self::gallerycar, $data);
    }

}
