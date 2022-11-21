<?php
	session_start();
	include_once("db.php");
	$consulta_eventos = "SELECT id, titulo, vehiculo, reparacion, horas, inicio, fin FROM mis_eventos";
	$resultado_eventos = mysqli_query($conexion, $consulta_eventos);
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset='utf-8' />
		<title>Agregar Cita</title>
		<link href='css/bootstrap.min.css' rel='stylesheet'>
		<link href='css/fullcalendar.min.css' rel='stylesheet' />
		<link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
		<link href='css/personalizado.css' rel='stylesheet' />
<style type="text/css">
body {
    margin: 0px 0px;
    padding: 0;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    font-size: 14px;
}
</style>
		<script src='js/jquery.min.js'></script>
		<script src='js/bootstrap.min.js'></script>
		<script src='js/moment.min.js'></script>
		<script src='js/fullcalendar.min.js'></script>
		<script src='locale/es-es.js'></script>
		<script>
			$(document).ready(function() {
				$('#calendar').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay'
					},
					defaultDate: Date(),
					navLinks: true, // can click day/week names to navigate views
					editable: true,
					eventLimit: true, // allow "more" link when too many events
					eventClick: function(event) {
						
						$('#visualizar #id').text(event.id);
						$('#visualizar #title').text(event.title);
						$('#visualizar #vehiculo').text(event.vehiculo);
						$('#visualizar #reparacion').text(event.reparacion);
						$('#visualizar #hora').text(event.hora);
						$('#visualizar #start').text(event.start.format('DD/MM/YYYY HH:mm:ss'));
						$('#visualizar #end').text(event.end.format('DD/MM/YYYY HH:mm:ss'));
						$('#visualizar').modal('show');
						return false;

					},
					
					selectable: true,
					selectHelper: true,
					select: function(start, end){
						$('#cadastrar #start').val(moment(start).format('DD/MM/YYYY HH:mm:ss'));
						$('#cadastrar #end').val(moment(end).format('DD/MM/YYYY HH:mm:ss'));
						$('#cadastrar').modal('show');						
					},
					events: [
						<?php
							while($registros_eventos = mysqli_fetch_array($resultado_eventos)){
								?>
								{
								id: '<?php echo $registros_eventos['id']; ?>',
								title: '<?php echo $registros_eventos['titulo']; ?>',
								vehiculo: '<?php echo $registros_eventos['vehiculo']; ?>',
								reparacion: '<?php echo $registros_eventos['reparacion']; ?>',
								horas: '<?php echo $registros_eventos['horas']; ?>',
								start: '<?php echo $registros_eventos['inicio']; ?>',
								end: '<?php echo $registros_eventos['fin']; ?>',
								},<?php
							}
						?>
					]
				});
			});
			
			//Mascara para o campo data e hora
			function DataHora(evento, objeto){
				var keypress=(window.event)?event.keyCode:evento.which;
				campo = eval (objeto);
				if (campo.value == '00/00/0000 00:00:00'){
					campo.value=""
				}
			 
				caracteres = '0123456789';
				separacao1 = '/';
				separacao2 = ' ';
				separacao3 = ':';
				conjunto1 = 2;
				conjunto2 = 5;
				conjunto3 = 10;
				conjunto4 = 13;
				conjunto5 = 16;
				if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (19)){
					if (campo.value.length == conjunto1 )
					campo.value = campo.value + separacao1;
					else if (campo.value.length == conjunto2)
					campo.value = campo.value + separacao1;
					else if (campo.value.length == conjunto3)
					campo.value = campo.value + separacao2;
					else if (campo.value.length == conjunto4)
					campo.value = campo.value + separacao3;
					else if (campo.value.length == conjunto5)
					campo.value = campo.value + separacao3;
				}else{
					event.returnValue = false;
				}
			}
		</script>
</head>
	<body>
	
<nav class="navbar navbar-default">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="./">Talleres LERMA</a> </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ><a href="./">INICIO <span class="sr-only">(current)</span></a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h4>Agenda de Citas</h4>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
<div class="panel-body">
<!--Inicio elementos contenedor-->
			<div class="page-header">
				<h1>Agenda</h1>
			</div>
			<?php
			if(isset($_SESSION['mensaje'])){
				echo $_SESSION['mensaje'];
				unset($_SESSION['mensaje']);
			}
			?>
		
			<div id='calendar'></div>
		</div>

		<div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center">Datos de la Cita</h4>
					</div>
					<div class="modal-body">
						<dl class="dl-horizontal">
							<dt>ID de Cita</dt>
							<dd id="id"></dd>
							<dt>Titulo de la Cita</dt>
							<dd id="title"></dd>
							<dt>Vehiculo</dt>
							<dd id="vehiculo"></dd>
							<dt>Reparacion</dt>
							<dd id="reparacion"></dd>
							<dt>Horas</dt>
							<dd id="horas"></dd>							
							<dt>Inicio de la Cita</dt>
							<dd id="start"></dd>
							<dt >Fin de la Cita</dt>
							<dd id="end"></dd>
						</dl>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center">Agregar cita</h4>
					</div>

					<!-- Formulario -->
					<div class="modal-body">
						<form class="form-horizontal" method="POST" action="proceso.php"> <
							
							<!-- Seleccion TITULO -->
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Titulo</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="titulo" placeholder="Titulo do Evento">
								</div>
							</div>

							<!-- Seleccion HORA -->
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Horas</label>
								<div class="col-sm-10">
									<select name="horas" class="form-control" id="horas">
										<option value="">Selecione</option>			
										<option value="800">8:00</option>
										<option value="9:00">9:00</option>
										<option value="10:00">10:00</option>
										<option value="11:00">11:00</option>
										<option value="12:00">12:00</option>	
										<option value="13:00">13:00</option>
										<option value="140:00">14:00</option>
										<option value="15:00">15:00</option>
										<option value="16:00">16:00</option>										
										<option value="17:00">17:00</option>
										<option value="18:00">18:00</option>
									</select>
								</div>
							</div>

							<!-- Seleccion VEHICULOS -->
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Vehiculo</label>
								<div class="col-sm-10">
									<select name="vehiculo" class="form-control" id="vehiculo">
										<?php												
											//Creamos las opciones del select	
											$resultado_vehiculos = $conexiona->prepare("SELECT id_vehiculo, matricula, propietario 
											FROM vehiculos");											
											$resultado_vehiculos->execute();	
											echo "<option vaulue=''>Selecione</option>";													
											while ($filas1 = $resultado_vehiculos->fetch(PDO::FETCH_OBJ)) {																										
												echo "<option value='{$filas1->id_vehiculo}'>{$filas1->matricula}</option>";
											}											
											$resultado_vehiculos = null; //eliminamos la consulta																	
										?>																
									</select>
								</div>
							</div>
													
							<!-- Seleccion REPARACIONES -->
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Reparacion</label>
								<div class="col-sm-10">
									<select name="reparacion" class="form-control" id="reparacion">
								
										<?php												
											//Creamos las opciones del select	
											$resultado_reparaciones = $conexiona->prepare("SELECT id_reparacion, reparacion, precio
											FROM reparaciones");											
											$resultado_reparaciones->execute();		
											echo "<option vaulue=''>Selecione</option>";													
											while ($filas2 = $resultado_reparaciones->fetch(PDO::FETCH_OBJ)) {																										
												echo "<option value='{$filas2->id_reparacion}'>{$filas2->reparacion}</option>";
											}											
											$resultado_reparaciones = null; //eliminamos la consulta																	
										?>																
									</select>
								</div>							
							</div>

							<!-- Seleccion INICIO FECHA -->
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">FECHA</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="inicio" id="start" onKeyPress="DataHora(event, this)">
								</div>
							</div>

							<!-- Seleccion FINAL FECHA -->
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Data Final</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="fin" id="end" onKeyPress="DataHora(event, this)">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-success">Registrar</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>


<!--Fin elementos contenedor-->
</div>
</div>
  </div>
</div>



</body>
</html>