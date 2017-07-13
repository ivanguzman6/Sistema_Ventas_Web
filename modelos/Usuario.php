<?php 
//Incluimos inicialmente la conexion con la base de datos
require "../config/Conexion.php";

Class Usuario
{
	//Implementamos el constructor
	public function _construct()
	{

	}

	public function insertar($nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$login,$clave,$imagen)
	{
		$sql="INSERT INTO usuario (nombre,tipo_documento,num_documento,direccion,telefono,email,cargo,login,clave,imagen,condicion)
		VALUES ('$nombre','$tipo_documento','$num_documento','$direccion','$telefono','$email','$cargo','$login','$clave','$imagen','1')";

		return ejecutarConsulta($sql); 

	}

	//Implementamos un metodo para editar registros
	public function editar($idusuario,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$login,$clave,$imagen)
	{
		$sql="UPDATE usuario SET nombre='$nombre',tipo_documento='$tipo_documento',num_documento='$num_documento',direccion='$direccion',telefono='$telefono',email='$email',cargo='$cargo',login='$login',clave='$clave',imagen='$imagen' 
		WHERE idusuario='$idusuario'";

		return ejecutarConsulta($sql); 
	}

	//Implementamos un metodo para desactivar registros
	public function desactivar($idusuario)
	{
		$sql="UPDATE usuario SET condicion='0' WHERE idusuario='$idusuario'";

		return ejecutarConsulta($sql); 
	}

	//Implementamos un metodo para activar registros
	public function activar($idusuario)
	{
		$sql="UPDATE usuario SET condicion='1 ' WHERE idusuario='$idusuario'";

		return ejecutarConsulta($sql); 
	}    

	//Implementar un metodo para mostrar los datos de un registro o modificar
	public function mostrar($idusuario)
	{
		$sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un metod para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM usuario";
		return ejecutarConsulta($sql); 
	}

	//Implementar un metod para listar los registros y mostrar el select
	public function select()
	{
		$sql="SELECT * FROM usuario WHERE condicion=1";
		return ejecutarConsulta($sql); 
	}
}

?>