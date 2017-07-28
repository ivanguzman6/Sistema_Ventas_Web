<?php 
//Incluimos inicialmente la conexion con la base de datos
require "../config/Conexion.php";

Class Consultas
{
	//Implementamos el constructor
	public function _construct()
	{

	}

	
	//Implementar un metod para listar los registros
	public function comprasfecha($fecha_desde,$fecha_hasta)
	{
		$sql="SELECT DATE(i.fecha_hora) as fecha, u.nombre as usuario,p.nombre as proveedor, i.tipo_comprobante,i.serie_comprobante, i.num_comprobante, i.total_compra, i.impuesto,i.estado FROM ingreso i INNER JOIN persona p on i.idproveedor=p.idpersona INNER JOIN usuario u on i.idusuario=u.idusuario WHERE date(i.fecha_hora)>='$fecha_desde' and DATE(i.fecha_hora)<='$fecha_hasta'";
		return ejecutarConsulta($sql); 
	}


}

?>