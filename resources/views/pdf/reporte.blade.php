<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Reporte De Movimientos</title>
		<style type="text/css">

			.header {  }
			.general { width: 100%; }
			.reporte { width: 100%; }
			.reporte tr:nth-child(even) {
				background-color: #bbbbbb;
			}
			.der { text-align: right; }
			.cen { text-align: center; }
			.lt12 { font-size: 12px; }
			.lt14 { font-size: 14px; }

		</style>
	</head>

	<body>
		<?php 
			$a = array(1=>"1", 2=>"2", 3=>"3", 4=>"4", 5=>"5");
			if($fecha1 == "")     $fecha1 =     "- - - - - - -";
			if($fecha2 == "")     $fecha2 =     "- - - - - - -";
			if($area == "")       $area =       "- - - - - - -";
			if($movimiento == "") $movimiento = "- - - - - - -";
		?>

		<table class="header">
			<img src="../storage/app/images/logob.jpg" width=100; height=25; />
		</table>
		<br> <br>
		<table class="general">
			<tr>
				<td width=35%>
					<b> Reporte De Movimientos </b>
				</td>
				<td width=40%> </td>
				<td class="der" width=25%>
					<b> Fecha: </b> <i> <?php echo date('Y-m-d H:i:s') ?> </i>
				</td>
			</tr>
		</table>
		<br>
		<table class="general">
			<tr>
				<td width=50%> <b> Fecha Inicial: </b> {{ $fecha1 }}     </td>
				<td width=50%> <b> Area:          </b> {{ $area }}       </td>
			</tr>
			<tr>
				<td width=50%> <b> Fecha Final:   </b> {{ $fecha2 }}     </td>
				<td width=50%> <b> Movimiento:    </b> {{ $movimiento }} </td>
			</tr>
		</table>
		<hr>
		<table class="reporte">
			<tr>
				<th class="lt12 cen" width=8%> NO. </th>
				<th class="lt12 cen" width=15%> FECHA/HORA </th>
				<th class="lt12 cen" width=15%> MOVIMIENTO </th>
				<th class="lt12 cen" width=10%> CODIGO </th>
				<th class="lt12 cen" width=37%> PRODUCTO </th>
				<th class="lt12 cen" width=15%> AREA </th>
			</tr>
			@foreach($movimientos as $x => $y)
				<tr>
					<td class="lt12 cen"> {{ $x + 1              }} </td>
					<td class="lt12 cen"> {{ $y['fecha']         }} </td>
					<td class="lt12 cen">
						<?php
							switch($y['movimiento_id'])
							{
								case 1: echo "Entrada"; break;
								case 2: echo "Salida"; break;
						        case 3: echo "Cancenlación"; break;
						        case 4: echo "Venta"; break;
						        case 5: echo "Baja"; break;
								case 6: echo "Traspaso"; break;
     						} 
     					?>					 
					</td>
					<td class="lt12 cen"> {{ $y['botella_id']    }} </td>
					<td class="lt12">     {{ $y['botella_desc']  }} </td>
					<td class="lt12 cen"> {{ $y['almacen_id']    }} </td>
				</tr>
			@endforeach
		</table>
		<hr>
		
	</body>
</html>