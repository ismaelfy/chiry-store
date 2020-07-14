<?php

	class User
	{	       
        private $nombre;
        private $usu;
        private $pwd;
        private $id_cargo;
        private $datos;
        private $cn;
		
		function __construct($nombre=false,$usu=false,$pwd=false,$id_cargo=false)
		{
			$this->nombre = $nombre;
			$this->usu = $usu;
			$this->pwd = $pwd;
			$this->id_cargo = $id_cargo;

			$this->datos=array();
        require_once 'Conexion.php';
        $conect   = new Conexion();
        $this->cn = $conect->Conectar();
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
        public function getUsu()
        {
            return $this->usu;
        }
        public function setUsu($usu)
        {
            $this->usu = $usu;
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
        public function getIdCargo()
        {
            return $this->id_cargo;
        }
        public function setIdCargo($id_cargo)
        {
            $this->id_cargo = $id_cargo;
            return $this;
        }

    

    /*metodos cliente*/

    public function Login_user($usu, $pwd){
        $consulta ="SELECT id, nombre, usu, id_cargo, estado FROM user WHERE usu='$usu'";        

        $resultado = $this->cn->query($consulta);
        if ($resultado->num_rows>0 ) {
            $sql ="SELECT id, nombre, usu, id_cargo, estado FROM user WHERE usu='$usu' && pwd='$pwd'";
            
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

	









































}
 ?>