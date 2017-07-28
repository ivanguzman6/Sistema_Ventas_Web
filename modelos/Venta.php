<?php 
//Incluimos inicialmente la conexion con la base de datos
require "../config/Conexion.php";

Class Venta
{
	//Implementamos el constructor
	public function _construct()
	{

	}

	public function insertar($idcliente,$idusuario,$tipo_comprobante,$serie_comprobante,$num_comprobante,$fecha_hora,$impuesto,$total_venta,$idarticulo,$cantidad,$precio_venta,$descuento)
	{
		$sql="INSERT INTO venta (idcliente,idusuario,tipo_comprobante,serie_comprobante,num_comprobante,fecha_hora,impuesto,total_venta,estado)
		VALUES ('$idcliente','$idusuario','$tipo_comprobante','$serie_comprobante','$num_comprobante','$fecha_hora','$impuesto','$total_venta','Aceptado')";

		//Se inserta el registro y se toma el id devuelto
		$idventanew=ejecutarConsulta_retornarID($sql);	
		$num_elementos = 0;
		$resultado=true;

		while($num_elementos<count($idarticulo))
		{
			$sql_detalle = "INSERT INTO detalle_venta(idventa,idarticulo,cantidad,precio_venta,descuento) values ('$idventanew','$idarticulo[$num_elementos]','$cantidad[$num_elementos]','$precio_venta[$num_elementos]','$descuento[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $resultado = false;
			$num_elementos=$num_elementos+1;
		}

		return $resultado;
	}

	
	//Implementamos un metodo para desactivar registros
	public function anular($idventa)
	{
		$sql="UPDATE venta SET estado='Anular' WHERE idventa='$idventa'";

		return ejecutarConsulta($sql); 
	}

	//Implementar un metodo para mostrar los datos de un registro o modificar
	public function mostrar($idventa)
	{
		$sql="SELECT v.idventa,DATE(v.fecha_hora) as fecha, v.idcliente,p.nombre as cliente,u.idusuario,u.nombre as usuario,v.tipo_comprobante,v.serie_comprobante,v.num_comprobante,v.total_venta,v.impuesto,v.estado FROM venta v INNER JOIN persona p ON v.idcliente = p.idpersona INNER JOIN usuario u ON v.idusuario = u.idusuario WHERE v.idventa='$idventa'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($idventa)
	{
		$sql="SELECT dv.idventa,dv.idarticulo,a.nombre,dv.cantidad,dv.precio_venta,dv.descuento,(dv.cantidad*dv.precio_venta-dv.descuento) as subtotal FROM detalle_venta dv INNER JOIN articulo a on dv.idarticulo=a.idarticulo WHERE dv.idventa='$idventa'";

		return ejecutarConsulta($sql);
	}

	//Implementar un metod para listar los registros
	public function listar()
	{
		$sql="SELECT v.idventa,DATE(v.fecha_hora) as fecha, v.idcliente,p.nombre as cliente,u.idusuario,u.nombre as usuario,v.tipo_comprobante,v.serie_comprobante,v.num_comprobante,v.total_venta,v.impuesto,v.estado FROM venta v INNER JOIN persona p ON v.idcliente = p.idpersona INNER JOIN usuario u ON v.idusuario = u.idusuario ORDER BY v.idventa DESC";
		return ejecutarConsulta($sql); 
	}


}

?>