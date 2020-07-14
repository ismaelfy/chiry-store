<?php

class Detalleventa
{
    private $numDoc;
    private $idprod;
    private $descripcion;
    private $cantidad;
    private $precio;
    private $importe;
    private $fecha;
    private $datos;
    private $cn;


    function __construct($numDoc = false, $idprod = false, $descripcion = false, $cantidad = false, $precio = false, $importe = false, $fecha = false)
    {
        $this->numDoc = $numDoc;
        $this->idprod = $idprod;
        $this->descripcion = $descripcion;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->importe = $importe;
        $this->fecha = $fecha;
        $this->datos = array();
        require_once 'Conexion.php';
        $conect   = new Conexion();
        $this->cn = $conect->Conectar();
    }
    public function getNumDoc()
    {
        return $this->numDoc;
    }
    public function setNumDoc($numDoc)
    {
        $this->numDoc = $numDoc;
        return $this;
    }

    public function getIdprod()
    {
        return $this->idprod;
    }
    public function setIdprod($idprod)
    {
        $this->idprod = $idprod;
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
    public function getCantidad()
    {
        return $this->cantidad;
    }
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
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
    public function getImporte()
    {
        return $this->importe;
    }
    public function setImporte($importe)
    {
        $this->importe = $importe;
        return $this;
    }
    public function getFecha()
    {
        return $this->fecha;
    }
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
        return $this;
    }

    /*metodos*/
    public function RegistrarDetalle()
    {
        $numdoc = $this->getNumDoc();
        $idprod = $this->getIdprod();
        $decrip = $this->getDescripcion();
        $canti = $this->getCantidad();
        $precio = $this->getPrecio();
        $impo = $this->getImporte();

        $consulta = "INSERT INTO detalle_venta(id_venta,idprod,descripcion, cantidad, precio, importe) VALUES ";
        $consulta .= "('$numdoc','$idprod','$decrip','$canti','$precio','$impo')";
        $resultado = $this->cn->query($consulta);
        if ($resultado)
            return true;

        return false;
    }
    public function ListarDetalle($id)
    {
        $consulta = "SELECT * FROM detalle_venta WHERE id_venta='$id'";
        $resultado = $this->cn->query($consulta);
        if (mysqli_num_rows($resultado)) {
            while ($fila = mysqli_fetch_object($resultado)) {
                $this->datos[] = $fila;
            }
            return $this->datos;
        }
        return null;
    }
}
