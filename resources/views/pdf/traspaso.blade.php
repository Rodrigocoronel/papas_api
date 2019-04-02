<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Reporte De Traspaso</title>
		<style type="text/css">

			

			.header {

			}
			.general {
				width: 100%;
			}
			.reporte {
				width: 100%;
			}
			.reporte tr:nth-child(even) {
				background-color: #bbbbbb;
			}
			.firma {
				width: 100%;
			}
			.footer {
				width: 100%;
			}

			.der { text-align: right; }
			.cen { text-align: center; }

		</style>
	</head>

	<body>
		<?php 
			$a = array(1=>"00001", 2=>"00002", 3=>"00003", 4=>"00004", 5=>"00005");
			$almacen1 = "Almacen General";
			$almacen2 = "Almacen De Licor";
			$almacenista1 = "Pablo Marmol";
			$almacenista2 = "Pedro Picapiedra";
		?>

		<table class="header">
			<img src="../storage/app/images/logob.jpg" width=100; height=25; />
		</table>
		<br> <br>
		<table class="general" >
			<tr>
				<td width=35%>
					<b> Reporte De Traspaso De Botellas </b>
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
				<td width=18%> <b> Area De Salida: </b> </td>
				<td>  Almacen 1 </td>

			</tr>
			<tr>
				<td> <b> Area De Salida: </b> </td>
				<td> Almacen 2 </td>
			</tr>
		</table>
		<hr>
		<table class="reporte">
			<tr>
				<th class="cen" width=10%> No. </th>
				<th class="cen" width=15%> Folio </th>
				<th width=20%> Movimiento </th>
				<th width=45%> Descripción </th>
			</tr>

			@foreach($a as $x)
				<tr>
					<td class="cen" width=10%> {{ $x }} </td>
					<td class="cen" width=20%> {{ $x }} </td>
					<td width=20%> {{ $x }} </td>
					<td width=50%> {{ $x }} </td>
				</tr>
			@endforeach

		</table>
		<hr> <br> <br> <br>
		<table class="firma">
			<tr>
				<td width=13%> </td>
				<td width=29%> <hr> </td>
				<td width=16%> </td>
				<td width=29%> <hr> </td>
				<td width=13%> </td>
			</tr>
			<tr class="cen">
				<td width=13%> </td>
				<td width=29%> <b> ENTREGO </b> </td>
				<td width=16%> </td>
				<td width=29%> <b> RECIBIO </b> </td>
				<td width=13%> </td>
			</tr>
			<tr class="cen">
				<td width=13%> </td>
				<td width=29%> {{ $almacen1 }} </td>
				<td width=16%> </td>
				<td width=29%> {{ $almacen2 }} </td>
				<td width=13%> </td>
			</tr>
			<tr class="cen">
				<td width=13%> </td>
				<td width=29%> {{ $almacenista1 }} </td>
				<td width=16%> </td>
				<td width=29%> {{ $almacenista2 }} </td>
				<td width=13%> </td>
			</tr>
		</table>
		
	</body>
</html>