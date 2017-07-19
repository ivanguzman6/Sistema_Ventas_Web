//Variable que almacena todos los datos
var tabla;

//FUncion que se ejecuta al inicio
function init()
{
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
}
//Funcion limpiar
function limpiar()
{

	$("#idingreso").val("");
	$("#idproveedor").val("");
	$("#idusuario").val("");
	$("#tipo_comprobante").val("");
	$("#serie_comprobante").val("");
	$("#num_comprobante").val("");
	$("#fecha_hora").val("");
	$("#impuesto").val("");	
} 

//Función mostrar formulario, recibe valores en la variable llamada flag
function mostrarform(flag)
{
	limpiar();
	//si el flag es true
	if(flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();	
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();	
	}
}

//Funcion cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//funcion Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing":true,//Activamos el procesamiento del datatables
		"aServerSide":true,//Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip',//Definimos los elementos del control de tabla
		buttons: [
					'copyHtml5',
					'excelHtml5',
					'csvHtml5',
					'pdf'
				],
		"ajax":
				{
					url: '../ajax/ingreso.php?op=listar',
					type: "get",
					dataType: "json",
					error: function(e)
					{
						console.log(e.responseText);
					} 

				},
		"bDestroy":true,
		"iDisplayLenght": 10, //Paginación
		"aLengthMenu": [[10, 20, 40, 60, -1], [10, 20, 40, 60, "All"]],
		"order": [[0,"desc"]] //ordar por la primera columna, descendente		
	})
}

//Funcion para guardar o editar
function guardaryeditar(e)
{
	e.preventDefault(); //No se activara la accion predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	//el nombre 'formulario' hace referencia al 'id' que se le coloco al formulario en la vista 
	var formData = new FormData($("#formulario")[0]);
	
	//alert($("#formulario")[0][0]);

	$.ajax({
		url:"../ajax/ingreso.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function(datos)
		{
			swal( 
				  'Listo',
				  datos,
				)

			//bootbox.alert(datos);
			mostrarform(false);
			tabla.api().ajax.reload();
		}

	});
	limpiar();	

}

function mostrar(vidingreso)
{
	$.post("../ajax/ingreso.php?op=mostrar",{idarticulo : vidarticulo},function(data,status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		$("#idarticulo").val(data.idarticulo);
		$('#idcategoria').val(data.idcategoria);
		$('#idcategoria').selectpicker('refresh');
		$("#codigo").val(data.codigo);
		$("#nombre").val(data.nombre);
		$("#stock").val(data.stock);
		$("#descripcion").val(data.descripcion);
		$("#imagenmuestra").show();
		$("#imagenmuestra").attr("src","../files/articulos/" +data.imagen);
		$("#imagenactual").val(data.imagen);
		generarbarcode();
		
	})
}

function anular(vidingreso)
{
	swal({
		  title: 'Anular Ingreso',
		  text: "Está seguro de que desea anular el ingreso?",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, anular',
		  cancelButtonText: 'Cancelar'
		}).then(function () {
			$.post("../ajax/ingreso.php?op=anular",{idingreso : vidingreso},function(e)
			{	
				swal('Listo',e,'success');
			  	tabla.api().ajax.reload();
			})
		}).catch(swal.noop)
}


init();