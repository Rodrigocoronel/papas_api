<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Reporte De Traspaso</title>
		<style type="text/css">

			.header {  }
			.general { width: 100%; }
			.reporte { width: 100%; }
			.reporte tr:nth-child(even) {
				background-color: #bbbbbb;
			}
			.der { text-align: right; }
			.cen { text-align: center; }

		</style>
	</head>

	<body>
		<?php 
			$a = array(1=>"1", 2=>"2", 3=>"3", 4=>"4", 5=>"5");
			$fecha1 = "- - - - -";
			$fecha2 = "- - - - -";
			$area = "- - - - -";
			$movimiento = "- - - - -";
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
					<b> Fecha: </b> <i> 25/12/2009 </i>
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
				<th class="cen" width=5%> No. </th>
				<th class="cen" width=15%> Fecha: </th>
				<th width=15%> Movimiento </th>
				<th width=15%> Codigo </th>
				<th width=30%> Producto </th>
				<th width=20%> Area </th>
			</tr>

			@foreach($a as $x)
				<tr>
					<td class="cen" > {{ $x }} </td>
					<td class="cen" > {{ $x }} </td>
					<td > {{ $x }} </td>
					<td > {{ $x }} </td>
					<td > {{ $x }} </td>
					<td > {{ $x }} </td>
				</tr>
			@endforeach

		</table>
		<hr>
		
	</body>
</html>