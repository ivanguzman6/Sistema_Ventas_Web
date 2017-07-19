<?php 
//Si aun no se ha iniciado la sesion
if(strlen(session_id()) < 1)
  session_start();

require_once "../modelos/Ingreso.php";

$ingreso=new Ingreso();

$idingreso=isset($_POST["idingreso"])? limpiarCadena($_POST["idingreso"]):"";
$idproveedor=isset($_POST["idproveedor"])? limpiarCadena($_POST["idproveedor"]):"";
$idusuario=$_SESSION["idusuario"];
$tipo_comprobante=isset($_POST["tipo_comprobante"])? limpiarCadena($_POST["tipo_comprobante"]):"";
$serie_comprobante=isset($_POST["serie_comprobante"])? limpiarCadena($_POST["serie_comprobante"]):"";
$num_comprobante=isset($_POST["num_comprobante"])? limpiarCadena($_POST["num_comprobante"]):"";
$fecha_hora=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";
$impuesto=isset($_POST["impuesto"])? limpiarCadena($_POST["impuesto"]):"";
$total_compra=isset($_POST["total_compra"])? limpiarCadena($_POST["total_compra"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idingreso)){
			$rspta=$ingrso->insertar($idproveedor,$idusuario,$tipo_comprobante,$serie_comprobante,$num_comprobante,$fecha_hora,$impuesto,$total_compra,$_POST["idarticulo"],$_POST["cantidad"],$_POST["precio_compra"],$_POST["precio_venta"]	);
			echo $rspta ? "Ingreso registrado" : "Ingreso no se pudo registrar";
		}
		else {
			
		}
	break;

	case 'anular':
		$rspta=$ingreso->anular($idingreso);
 		echo $rspta ? "Ingreso Anulado" : "Ingreso no se puede anular";
 		break;
	break;
 
	case 'mostrar':
		$rspta=$ingreso->mostrar($idingreso);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$ingreso->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object())
 		{
 			$data[]=array(
 				"0"=>($reg->estado=='Aceptado')?'<button class="btn btn-warning" onclick="mostrar('.$reg->idingreso.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="anular('.$reg->idingreso.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-warning" onclick="mostrar('.$reg->idingreso.')"><i class="fa fa-pencil"></i></button>',
 				"1"=>$reg->idingreso,
 				"2"=>$reg->fecha,
 				"3"=>$reg->proveedor,
 				"4"=>$reg->usuario,
 				"5"=>$reg->tipo_comprobante,
 				"6"=>$reg->serie_comprobante.'-'.$reg->num_comprobante,
 				"7"=>$reg->total_compra,
 				"8"=>($reg->estado=='Aceptado')?'<span class="label bg-green" style="font-size:100%">Aceptado</span>':'<span class="label bg-red" style="font-size:100%">Anulado</span>'
 				);
 		}
 		$results = array(
 			//"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

}
?>