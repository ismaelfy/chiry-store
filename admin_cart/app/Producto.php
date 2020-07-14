<?php 

class Producto 
{
	private $nombre;
    private $descripcion;
	private $imagen;
    private $category;
	private $precio;
	private $stock;
    private $oferta;

    private $cn;
    private $datos;

	function __construct($nombre=false,$descripcion=false,$imagen=false,$category=false,$precio=false,$stock=false,$oferta=false)
	{
		$this->nombre = $nombre;
        $this->descripcion = $descripcion;
		$this->imagen = $imagen;
        $this->precio = $precio;
		$this->category = $category;
		$this->stock = $stock;
        $this->oferta = $oferta;
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
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
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
    public function getCategory()
    {
        return $this->category;
    }
    public function setCategory($category)
    {
        $this->category = $category;
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
    public function getOferta()
    {
        return $this->oferta;
    }
    public function setOferta($oferta)
    {
        $this->oferta = $oferta;
        return $this;
    }
    

    /*METODOS */
    public function Registrar() {

        $nombre =$this->getNombre();
        $descripcion =$this->getDescripcion();
        $imagen =$this->getImagen();
        $precio =$this->getPrecio();
        $stock =$this->getStock();
        $category =$this->getCategory();
        $oferta =$this->getOferta();

        $consulta = "INSERT INTO product(nombre, descripcion, imagen, precio, oferta, stock, id_brand) ";
        $consulta .= "VALUES ('$nombre','$descripcion','$imagen','$precio','$oferta','$stock','$category')";       

        $resultado = $this->cn->query($consulta);
        if ($resultado)
            return true;

        return false;
    }

    public function Listar($ini,$tope)
    {
        $consulta = "SELECT p.id,p.nombre,p.descripcion,p.imagen,p.precio,p.oferta,p.stock,b.nombre as category FROM";
        $consulta.= " product p INNER JOIN brand b on b.id=p.id_brand ORDER BY p.id DESC LIMIT $ini,$tope";
        
		$resultado = $this->cn->query($consulta);

		while ($fila = mysqli_fetch_object($resultado)) {
			$this->datos[] =$fila;
		}

		return $this->datos;
    }
    

    public function Buscar($id,$nomb)
    {
        $consulta ='';
        if ($id==0) {
            $consulta .= "SELECT id, nombre, imagen, precio, oferta, stock, id_brand FROM product where nombre like '%$nomb%'";
        } else if ($nomb ==0) {        
            $consulta .= "SELECT id, nombre, imagen, precio, oferta, stock, id_brand FROM product where id_brand ='$id'";            
        } else {
            $consulta .= "SELECT id, nombre, imagen, precio, oferta, stock, id_brand FROM product WHERE id_brand ='$id' and nombre  like '%$nomb%'";
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

    /*get product for cart*/
    public function Get_Prod($id)
    {
        $consulta = "SELECT id, nombre, imagen, precio, stock FROM product WHERE id='$id'";
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

    public function getNumRows(){
        $consulta = "SELECT * FROM product";
        $resultado = $this->cn->query($consulta);        
        return $resultado->num_rows;
    }






























}