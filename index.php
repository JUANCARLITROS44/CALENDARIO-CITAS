<?php
	session_start();
	include_once("db.php");
	//$consulta_eventos = "SELECT id, titulo, idVeh, idRep, horas, inicio FROM mis_eventos";

	$consulta_eventos = "SELECT c.id, c.titulo, c.idVeh, c.idRep, c.horas, c.inicio, v.matricula, r.reparacion 
	FROM mis_eventos c, vehiculos v, reparaciones r WHERE c.idVeh = v.id_Vehiculo AND c.idRep = r.id_reparacion";

	$resultado_eventos = mysqli_query($conexiona, $consulta_eventos);
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
						navLinks: true, 
						editable: true,
						eventLimit: true, 
						eventClick: function(event) {
							
							$('#visualizar #id').text(event.id);
							$('#visualizar #title').text(event.title);
							$('#visualizar #start').text(event.start.format('DD/MM/YYYY'));
							$('#visualizar #horas').text(event.horas);
							$('#visualizar #vehiculo').text(event.vehiculo);
							$('#visualizar #reparacion').text(event.reparacion);
							$('#visualizar').modal('show');
							return false;

						},
						
						selectable: true,
						selectHelper: true,
						select: function(start, end){
							$('#cadastrar #start').val(moment(start).format('DD/MM/YYYY'));
							$('#cadastrar').modal('show');						
						},

						events: [
							<?php
								while($registros_eventos = mysqli_fetch_array($resultado_eventos)){
									?>
									{
									id: '<?php echo $registros_eventos['id']; ?>',
									title: '<?php echo $registros_eventos['titulo']; ?>',
									start: '<?php echo $registros_eventos['inicio']; ?>',
									horas: '<?php echo $registros_eventos['horas']; ?>',
									vehiculo: '<?php echo $registros_eventos['matricula']; ?>',
									reparacion: '<?php echo $registros_eventos['reparacion']; ?>',
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
	
	<!--Inicio elementos contenedor-->
	<div class="container">

		<div class="page-header">
			<h1>Agenda de Citas</h1>
		</div>
		<?php
			if(isset($_SESSION['mensaje'])){
				echo $_SESSION['mensaje'];
				unset($_SESSION['mensaje']);
			}
		?>	
		<div id='calendar'></div>
		
		<div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center">Datos de la Cita</h4>
					</div>
					<!-- Modal DATOS DE LA CITA -->
					<div class="modal-body">
						<dl class="dl-horizontal">
							<dt>ID</dt>
							<dd id="id"></dd>
							<dt>Titulo</dt>
							<dd id="title"></dd>
							<dt>Fecha</dt>
							<dd id="start"></dd>
							<dt>Hora</dt>
							<dd id="horas"></dd>
							<dt>Vehiculo</dt>
							<dd id="vehiculo"></dd>
							<dt>Reparacion</dt>
							<dd id="reparacion"></dd>	
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
									<option value="">Seleccione Hora</option>			
										<option value="8:00">8:00</option>
										<option value="8:00">8:30</option>
										<option value="9:00">9:00</option>
										<option value="8:00">9:30</option>
										<option value="10:00">10:00</option>
										<option value="8:00">10:30</option>
										<option value="11:00">11:00</option>
										<option value="8:00">11:30</option>										
										<option value="12:00">12:00</option>	
										<option value="8:00">12:30</option>										
										<option value="8:00">13:00</option>
										<option value="13:00">13:30</option>
										<option value="14:00">14:00</option>
										<option value="8:00">14:30</option>
										<option value="15:00">15:00</option>
										<option value="8:00">15:30</option>
										<option value="16:00">16:00</option>	
										<option value="8:00">16:30</option>										
										<option value="8:00">17:00</option>										
										<option value="17:00">17:30</option>
										<option value="18:00">18:00</option>
										<option value="18:00">18:30</option>
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
											$resultado_vehiculos = $conexion->prepare("SELECT id_vehiculo, matricula, propietario FROM vehiculos");											
											$resultado_vehiculos->execute();	
											echo "<option vaulue=''>Seleccione Vehiculo</option>";													
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
											$resultado_reparaciones = $conexion ->prepare("SELECT id_reparacion, reparacion, precio FROM reparaciones");											
											$resultado_reparaciones->execute();		
											echo "<option vaulue=''>Seleccione Reparacion</option>";													
											while ($filas2 = $resultado_reparaciones->fetch(PDO::FETCH_OBJ)) {																										
												echo "<option value='{$filas2->id_reparacion}'>{$filas2->reparacion}</option>";
											}											
											$resultado_reparaciones = null; //eliminamos la consulta																	
										?>																
									</select>
								</div>							
							</div>

							<!-- Seleccion FECHA -->
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">FECHA</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="inicio" id="start" onKeyPress="DataHora(event, this)">
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
		</div>
</body>
</html>