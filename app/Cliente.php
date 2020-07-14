<?php

	class Cliente
	{		
		private $nombre;
		private $direccion;
		private $email;
		private $telefono;
        private $pwd;		
		
	function __construct($nombre=false,$direccion=false,$email=false,$telefono=false,$pwd=false)
	{
		$this->nombre = $nombre;
		$this->direccion = $direccion;
		$this->email = $email;
		$this->telefono = $telefono;
		$this->pwd = $pwd;			
		$this->datos=array();
        require_once 'Conexion.php';
        $conect   = new Conexion();
        $this->cn = $conect->Conectar();
	}
	
	
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }
    public function getDireccion()
    {
        return $this->direccion;
    }
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
        return $this;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    public function getPwd()
    {
        return $this->pwd;
    }
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;
        return $this;
    }
    public function getTelefono()
    {
        return $this->telefono;
    }
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
        return $this;
    }   

    

    /*metodos cliente*/
    public function Registrar(){
		$nombre =$this->getNombre();
		$direccion =$this->getDireccion();
		$email =$this->getEmail();
        $pwd =$this->getPwd();
		$telefono =$this->getTelefono();

		$consulta = "INSERT INTO client(nombre, direccion, email,pwd, telefono)";
		$consulta .= " VALUES ('$nombre','$direccion','$email','$pwd','$telefono')";
		$resultado = $this->cn->query($consulta);
		if ($resultado)
			return true;

		return false;
	}
    public function Actualizar($id,$nombre,$direccion,$email,$telefono){     

        $consulta = "UPDATE client SET nombre='$nombre',direccion='$direccion',email='$email',telefono='$telefono'";
        $consulta.= " WHERE id='$id'";
        
        $resultado = $this->cn->query($consulta);
        
        if ($resultado)
            return true;

        return false;
    }
    public function updatePassword($id,$pass){
        $consulta = "UPDATE client SET pwd='$pass' WHERE id='$id'";        
        
        $resultado = $this->cn->query($consulta);        
        if ($resultado)
            return true;

        return false;
    }

    public function ValidarMail($email){
        $consulta ="SELECT nombre, email FROM client WHERE email='$email'";
        $resultado = $this->cn->query($consulta);

        if($resultado->num_rows>0 ) {
            while ($fila = mysqli_fetch_object($resultado)) {
                $this->datos[]= $fila;
            } 
        } else {
            $this->datos =0;
        }               
        return $this->datos;
        
    }

    public function Login_user($usu, $pwd){
        $consulta ="SELECT email FROM client WHERE email='$usu'";
        $resultado = $this->cn->query($consulta);
        if ($resultado->num_rows>0 ) {
            $sql ="SELECT id, nombre, direccion, email, pwd, telefono, estado FROM client WHERE email='$usu' && pwd='$pwd'";
            
            $result = $this->cn->query($sql);            
            if ($result->num_rows>0) {                
                while ($fila = mysqli_fetch_array($result)) {
                    $this->data[]= $fila;                    
                }

            } else {
                $this->data=1;
            }            

        } else {
            $this->data =0;
        }

        return $this->data;        
    }
    public function ValidarPwd($id,$pwd)
    {
        $consulta="SELECT nombre, direccion, email FROM client WHERE id='$id' and pwd='$pwd'";
        $result = $this->cn->query($consulta);
        if ($result->num_rows>0) {
            while ($fila = mysqli_fetch_object($result)) {
                $this->datos[]=$fila;
            } 
        } else {
            $this->datos=0;
        }
        return $this->datos;
    }

	


}






























 ?>