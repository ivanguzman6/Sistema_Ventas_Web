<?php
//Activar almacenamiento en el buffer
ob_start();
session_start();

if(!isset($_SESSION["nombre"]))
{
    header("Location: login.html");
}
else
{
    require 'header.php';

    if($_SESSION['consultav']==1)
    {
        ?>

        <!--Contenido-->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h1 class="box-title">Consulta de Ventas por Fecha y Cliente</h1>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <!-- centro -->
                            <div class="panel-body table-responsive" id="listadoregistros">
                                <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <label>Fecha Desde</label>
                                    <input type="date" class="form-control" name="fecha_desde" id="fecha_desde" value="<?php echo date("Y-m-d"); ?>">
                                </div>
                                <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <label>Fecha Hasta</label>
                                    <input type="date" class="form-control" name="fecha_hasta" id="fecha_hasta" value="<?php echo date("Y-m-d"); ?>">
                                </div>
                                <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                    <label>Cliente</label>
                                    <select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true" required>
                                    </select>
                                    <button class="btn btn-success" onclick="listar()">Mostrar</button>
                                </div>
                                <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                    <th>Fecha</th>
                                    <th>Usuario</th>
                                    <th>Cliente</th>
                                    <th>Tipo Comprobante</th>
                                    <th>Comprobante</th>
                                    <th>Total Venta</th>
                                    <th>Impuesto</th>
                                    <th>Estado</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <th>Fecha</th>
                                    <th>Usuario</th>
                                    <th>Cliente</th>
                                    <th>Tipo Comprobante</th>
                                    <th>Comprobante</th>
                                    <th>Total Venta</th>
                                    <th>Impuesto</th>
                                    <th>Estado</th>
                                    </tfoot>
                                </table>
                            </div>

                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->

        </div><!-- /.content-wrapper -->
        <!--Fin-Contenido-->
        <?php
    }
    else
    {
        require 'noacceso.php';
    }
    require 'footer.php';
    ?>
    <script type="text/javascript" src="scripts/ventasfechacliente.js"></script>
    <?php
}
ob_end_flush();
?>