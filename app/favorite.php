<?php 

class Favorite
{	
	private $idPrdouct;
	private $idClient;
    private $datos;

	function __construct($idprod=false,$idclient=false)
	{		
		$this->idPrdouct = $idprod;
		$this->idClient = $idclient;		
		$this->datos =array();
        require_once 'Conexion.php';
        $conect   = new Conexion();
        $this->cn = $conect->Conectar();
	}

    public function getIdPrdouct()
    {
        return $this->idPrdouct;
    }
    public function setIdPrdouct($idPrdouct)
    {
        $this->idPrdouct = $idPrdouct;
        return $this;
    }
    public function getIdClient()
    {
        return $this->idClient;
    }
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
        return $this;
    }

    /*metodos */
    public function Registrar(){		
		$idp =$this->getIdPrdouct();
		$idc =$this->getIdClient();        

		$consulta = "INSERT INTO favorite (id_prod, id_cli) VALUES('$idp','$idc')";		
		$resultado = $this->cn->query($consulta);

		if ($resultado)
			return true;

		return false;
	}
	 public function ListarOferta($id_us)
    {
    	$consulta = "SELECT p.id, p.nombre, p.imagen, p.precio, p.oferta, p.stock FROM product p  INNER JOIN favorite f ";
    	$consulta .="on f.id_prod INNER JOIN client c on c.id= f.id_cli WHERE p.id = f.id_prod and c.id='$id_us'";
		
        $resultado = $this->cn->query($consulta);
        
		while ($fila = mysqli_fetch_object($resultado)) {
			$this->datos[] =$fila;
		}

		return $this->datos;
    }
    public function Eliminar($idpro,$idcli){              
        $consulta="DELETE FROM favorite WHERE id_prod='$idpro' and id_cli='$idcli'";        
        $resultado = $this->cn->query($consulta);

        if ($resultado)
            return true;

        return false;
    }

    public function CountFav($id,$id_c)
    {    
        $consulta ="SELECT * FROM favorite WHERE id_prod='$id' and id_cli='$id_c'";        
        $resultado = $this->cn->query($consulta);                
        
        return $resultado->num_rows;
    }
    



}





 ?>