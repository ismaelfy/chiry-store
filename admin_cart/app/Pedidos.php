<?php
class Pedidos
{
    private $id;
    private $fecha;
    private $document;
    private $cliente_id;
    private $tipo_pago;
    private $estado;

    private $datos;
    private $table = 'ventas';
    private $detail = 'detalle_venta';
    private $cn;


    /**
     * Class Constructor
     * @param    $id   
     * @param    $fecha   
     * @param    $document   
     * @param    $cliente_id   
     * @param    $tipo_pago   
     * @param    $estado   
     * @param    $datos   
     * @param    $cn   
     */
    public function __construct($id = '', $fecha = '', $document = '', $cliente_id = '', $tipo_pago = '', $estado = '')
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->document = $document;
        $this->cliente_id = $cliente_id;
        $this->tipo_pago = $tipo_pago;
        $this->estado = $estado;
        $this->datos = array();

        require_once 'Conexion.php';
        $conect   = new Conexion();
        $this->cn = $conect->Conectar();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     *
     * @return self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param mixed $document
     *
     * @return self
     */
    public function setDocument($document)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClienteId()
    {
        return $this->cliente_id;
    }

    /**
     * @param mixed $cliente_id
     *
     * @return self
     */
    public function setClienteId($cliente_id)
    {
        $this->cliente_id = $cliente_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipoPago()
    {
        return $this->tipo_pago;
    }

    /**
     * @param mixed $tipo_pago
     *
     * @return self
     */
    public function setTipoPago($tipo_pago)
    {
        $this->tipo_pago = $tipo_pago;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     *
     * @return self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDatos()
    {
        return $this->datos;
    }

    /**
     * @param mixed $datos
     *
     * @return self
     */
    public function setDatos($datos)
    {
        $this->datos = $datos;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCn()
    {
        return $this->cn;
    }

    /**
     * @param mixed $cn
     *
     * @return self
     */
    public function setCn($cn)
    {
        $this->cn = $cn;

        return $this;
    }

    /*  functions && methods  */
    public function all()
    {
        $consulta = "SELECT v.*, c.nombre, c.telefono, c.email, c.direccion FROM $this->table v INNER join client c on c.id=v.id_cli ";
        $resultado = $this->cn->query($consulta);
        if (mysqli_num_rows($resultado)) {
            while ($row = mysqli_fetch_object($resultado)) {
                $date = new DateTime($row->fecha);
                $row->fecha = $date->format("Y/m/d H:i a");
                $this->datos[] = $row;
            }
            return $this->datos;
        }
        return null;
    }
    public function find_detail($id = null)
    {
        if (!$id)
            return false;

        $consulta = "SELECT * FROM $this->detail where id_venta = $id";
        $resultado = $this->cn->query($consulta);
        if (mysqli_num_rows($resultado)) {
            while ($row = mysqli_fetch_object($resultado)) {                
                $this->datos[] = $row;
            }
            return $this->datos;
        }
        return null;
    }
    public function find($id = null)
    {
        if ($id)
            return false;
        
    }
    public function update($data = array(), $id = null)
    {
        if ($id)
            return false;
    }
    public function create($data = array())
    {
        # code...
    }
}
