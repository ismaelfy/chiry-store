<?php 

class Brand
{
	private $id;
	private $nombre;
    private $cn;
    private $datos;
	function __construct($nombre=false)
	{
        require_once 'Conexion.php';
        $conect   = new Conexion();
        $this->cn = $conect->Conectar();
		$this->nombre=$nombre;
        $this->datos=array();        	
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
    /*METODO PARA MANTENEMIENTO BRAND*/

    public function Listar()
    {
    	$consulta= "SELECT * FROM brand";
    	$result = $this->cn->query($consulta);
        if (mysqli_num_rows($result)) {
            while ($fila = mysqli_fetch_object($result)) {
                $this->datos[]=$fila;
            }    
        }else {
            $this->datos=0;
        }
    	
    	return $this->datos;
    }



}