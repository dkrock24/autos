<?php
class Login_model extends CI_Model {

    const brand = 'brand';
    const user = 'user';
    
    public function brands( )
    {   
        $this->db->select('*');
        $this->db->from(self::brand); 
        $query = $this->db->get();  
        
        if($query->num_rows() > 0 ){
            return $query->result();
        }else{
            return 0;
        } 
    }
        
        public function login( $usuario , $passwd )
        {   
            // hacemos la llamada a la BD por defecto que valida el usuario y empresa
            $db = $this->load->database('default', TRUE);
            $this->load->model('admin/Encrypt_model', 'admin');
            $pass = $this->admin->encrypt($passwd);

            $db->select('*');
            $db->from(self::user);
            $db->where(self::user.'.user',$usuario);    
            $db->where(self::user.'.password',$pass);   
            $query = $db->get(); 
            //echo $db->queries[0];
            
            if($query->num_rows() > 0 ){
     
                return $query->result();
            }else{
 
                return 0;
            } 
        }
        public function autenticacion( $usuario , $passwd ){

            $db = $this->load->database('default', TRUE);
            $this->load->model('admin/Encrypt_model', 'admin');
            $pass = $this->admin->encrypt($passwd);

            $db->select('*');
            $db->from(self::sys_usuario);
            $db->join(self::sys_empleado,' on '. self::sys_empleado .'.id_empleado = '. self::sys_usuario.'.Empleado');
            $db->join(self::sys_role,' on '. self::sys_role .'.id_rol = '. self::sys_usuario.'.id_rol');
            $db->join(self::sys_sucursal,' on '. self::sys_sucursal .'.id_sucursal = '. self::sys_empleado.'.Sucursal');

            $db->where(self::sys_usuario.'.nombre_usuario',$usuario);    
            $db->where(self::sys_usuario.'.contrasena_usuario',$passwd);   
            $query = $db->get(); 
            //echo $db->queries[0];
            
            if($query->num_rows() > 0 ){
     
                return $query->result();
            }else{
 
                return 0;
            } 
        }
        public function usuarios()
        {   
           
            $this->db->select('*');
            $this->db->from(self::users); 
            $query = $this->db->get();  
            
            if($query->num_rows() > 0 ){
                return $query->result();
            }else{
                return 0;
            } 
        }
        
}
?>