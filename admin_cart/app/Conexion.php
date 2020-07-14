 <?php 
	
	class Conexion extends mysqli
	{
		public function Conectar()
		{
			//$con = new mysqli('localhost', 'mdnetfyc_wp501', '0(p1gSVn[2', 'mdnetfyc_chiry') or die('error en la conexion');
			$con = new mysqli('localhost', 'root', '', 'db_ventas') or die('error en la conexion');
			mysqli_set_charset($con,"utf8");
			return $con;
		}
	}

 ?>