<?php 

class Producto 
{
	private $id;
	private $nombre;
	private $imagen;
	private $precio;
	private $stock;
    private $cn;

	function __construct($nombre=false,$imagen=false,$precio=false,$stock=false)
	{
		$this->nombre = $nombre;
		$this->imagen = $imagen;
		$this->precio = $precio;
		$this->stock = $stock;
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
    public function getImagen()
    {
        return $this->imagen;
    }
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
        return $this;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function setPrecio($precio)
    {
        $this->precio = $precio;
        return $this;
    }
    public function getStock()
    {
        return $this->stock;
    }
    public function setStock($stock)
    {
        $this->stock = $stock;
        return $this;
    }

    /*METODOS PARA LISTAR*/
    public function Listar()
    {
    	$consulta = "SELECT id, nombre, imagen, precio, oferta, stock, id_brand FROM product ORDER by oferta DESC";

		$resultado = $this->cn->query($consulta);

		while ($fila = mysqli_fetch_object($resultado)) {
			$this->datos[] =$fila;
		}

		return $this->datos;
    }    

    public function Buscar($id,$nomb)
    {
        $consulta ='';
        if ($id === 0) {
            $consulta .= "SELECT id, nombre, descripcion, imagen, precio, oferta, stock, id_brand FROM product"; 
            $consulta.=" where nombre like '%$nomb%' ";
        } else if ($nomb === 0) {        
            $consulta .= "SELECT id, nombre, descripcion, imagen, precio, oferta, stock, id_brand FROM product where id_brand ='$id'";            
        } else {
            $consulta .= "SELECT id, nombre, descripcion, imagen, precio, oferta, stock, id_brand FROM product WHERE nombre LIKE '%$nomb%' and id_brand='$id'";
        }

        $result = $this->cn->query($consulta);
        if (mysqli_num_rows($result)) {
            while ($fila = mysqli_fetch_object($result)) {
                $this->datos[] =$fila;
            } 
        }else {
            $this->datos=0;
        }
        return $this->datos;
    }

    public function ViewProducto($id)
    {
        $consulta = "SELECT id, nombre, descripcion, imagen, precio, oferta, stock, id_brand FROM product WHERE id='$id'";
        $result = $this->cn->query($consulta);
        if (mysqli_num_rows($result)) {
            while ($fila = mysqli_fetch_object($result)) {
                $this->datos[] =$fila;
            } 
        }else {
            $this->datos=0;
        }
        return $this->datos;
    }
    /*get product for cart*/
    public function Get_Prod($id)
    {
        $consulta = "SELECT id, nombre, descripcion, imagen, precio, oferta, stock, id_brand FROM product WHERE id='$id'";
        $result = $this->cn->query($consulta);
        if (mysqli_num_rows($result)) {
            while ($fila = mysqli_fetch_array($result)) {
                $this->datos[] =$fila;
            } 
        }else {
            $this->datos=0;
        }
        return $this->datos;
    }
     public function SearchProducto($name)
    {
        $consulta = "SELECT id, nombre, descripcion, imagen, precio, oferta, stock, id_brand FROM product WHERE nombre LIKE '%".$name."%'";
        $result = $this->cn->query($consulta);        
        if ($result->num_rows > 0) {
            while ($fila = mysqli_fetch_object($result)) {
                $this->datos[] =$fila;
            } 
        }else {
            $this->datos=0;
        }
        return $this->datos;
    }




















}