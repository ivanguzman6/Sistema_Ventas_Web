<?php 
//Incluimos inicialmente la conexion con la base de datos
require "../config/Conexion.php";

Class Articulo
{
	//Implementamos el constructor
	public function _construct()
	{

	}

	public function insertar($idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen)
	{
		$sql="INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
		VALUES ('$idcategoria','$codigo','$nombre','$stock','$descripcion','$imagen',1)";

		return ejecutarConsulta($sql); 

	}

	//Implementamos un metodo para editar registros
	public function editar($idarticulo,$idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen)
	{
		$sql="UPDATE articulo SET idcategoria='$idcategoria',codigo='$codigo',nombre='$nombre',stock='$stock',descripcion='$descripcion',imagen='$imagen' 
		WHERE idarticulo='$idarticulo'";

		return ejecutarConsulta($sql); 
	}

	//Implementamos un metodo para desactivar categorias
	public function desactivar($idarticulo)
	{
		$sql="UPDATE articulo SET condicion='0' WHERE idarticulo='$idarticulo'";

		return ejecutarConsulta($sql); 
	}

	//Implementamos un metodo para activar categorias
	public function activar($idarticulo)
	{
		$sql="UPDATE articulo SET condicion='1 ' WHERE idarticulo='$idarticulo'";

		return ejecutarConsulta($sql); 
	}    

	//Implementar un metodo para mostrar los datos de un registro o modificar
	public function mostrar($idarticulo)
	{
		$sql="SELECT * FROM articulo WHERE idarticulo='$idarticulo'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un metod para listar los registros
	public function listar()
	{
		$sql="SELECT a.idarticulo,c.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,a.descripcion,a.imagen,a.condicion " .
			 "FROM articulo a " .
			 "INNER JOIN categoria c on a.idcategoria = c.idcategoria ";
		return ejecutarConsulta($sql); 
	}
}

?>