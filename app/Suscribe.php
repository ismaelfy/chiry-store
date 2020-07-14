<?php 
	/*include 'Class.Conexion.php';*/
	class Suscribe
	{
		private $email;
		function __construct($email=false)
		{
			$this->email=$email;
			$this->datos=array();
		require_once 'Conexion.php';
		$conect   = new Conexion();
		$this->cn = $conect->Conectar();
			/*$this->cn = Conectar::con();*/
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

    /*insert suscribe*/
	public function Suscribe(){
		$mail= $this->getEmail();
		$consulta = "INSERT INTO suscribe(email) VALUES ('$mail')";		
		$resultado = $this->cn->query($consulta);
		if ($resultado)
			return true;

		return false;
	}













}




 ?>