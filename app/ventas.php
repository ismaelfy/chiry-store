<?php
class Ventas
{
	private $idcli;
	private $datos;
	private $cn;
	private $table = 'ventas';
	private $table_detail = 'detalle_venta';
	function __construct($idcli = false)
	{
		$this->idcli = $idcli;
		$this->datos = array();
		require_once 'Conexion.php';
		$conect   = new Conexion();
		$this->cn = $conect->Conectar();
	}
	/*gettes and setters*/
	public function getIdcli()
	{
		return $this->idcli;
	}
	public function setIdcli($idcli)
	{
		$this->idcli = $idcli;
		return $this;
	}

	/*metodos */
	public function Get_Num_Doc()
	{
		$consulta = "SELECT count(id) as num_doc FROM ventas";
		$result = $this->cn->query($consulta);
		if (mysqli_num_rows($result)) {
			$Doc = 0;
			while ($row = mysqli_fetch_object($result)) {
				$Doc = $row->num_doc;
			}
			return "DC-000-000" . ($Doc + 1);
		}
		return 1;
	}

	public function Registrar($doc)
	{
		$idcli = $this->getIdcli();
		$consulta = "INSERT INTO ventas(fecha,ndoc, id_cli,tipo_pago,status) VALUES ('$doc->fecha','$doc->codigo','$idcli','$doc->tipo_pago','$doc->status')";
		$resultado = $this->cn->query($consulta);
		if ($resultado)
			return $this->cn->insert_id;
		return false;
	}
	public function save($data = null)
	{
		if ($data == null) {
			return false;
		}
		$keys    = [];
		$columns = [];
		foreach ($data as $key => $value) {
			$keys[]    = $key;
			$columns[] = "'{$value}'";
		}
		$columns = implode(', ', $columns);
		$keys    = implode(', ', $keys);

		$query   = "INSERT INTO $this->table ({$keys}) VALUES ({$columns})";
		$result  = $this->cn->query($query);
		if ($result) {
			return $this->cn->insert_id;
		}
		return false;
	}
	public function update($data = null, $id = null)
	{
		if ($data == null || $id == null) {
			return false;
		}
		$datos = [];
		foreach ($data as $key => $value) {
			$datos[] = "$key='{$value}'";
		}
		$datos = implode(', ', $datos);
		$query   = "UPDATE $this->table  SET $datos  where id={$id}";
		$result  = $this->cn->query($query);
		if ($result) {
			return $this->cn->insert_id;
		}
		return false;
	}
	public function save_detail($data = null)
	{
		if ($data == null) {
			return false;
		}
		$keys    = [];
		$columns = [];
		foreach ($data as $key => $value) {
			$keys[]    = $key;
			$columns[] = "'{$value}'";
		}
		$columns = implode(', ', $columns);
		$keys    = implode(', ', $keys);
		$query   = "INSERT INTO $this->table_detail ({$keys}) VALUES ({$columns})";
		$result  = $this->cn->query($query);
		if ($result) {
			return $this->cn->insert_id;
		}
		return false;
	}

	public function getNumRows()
	{
		$consulta = "SELECT * FROM ventas";
		$resultado = $this->cn->query($consulta);
		return $resultado->num_rows;
	}
	public function Listar($ini, $tope, $idcli)
	{
		$consulta = "SELECT v.*, v.ndoc as document FROM ventas v INNER join client c on ";
		$consulta .= " c.id=v.id_cli  where v.id_cli=$idcli  ORDER BY v.id DESC LIMIT $ini,$tope";

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
