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

		<?php $movimientos = array(1 => "Entrada" , 2 => "Salida", 3 => "Cancenlación", 4 => "Venta", 5 => "Baja", 6 => "Traspaso"); ?>

		<table class="header">
			<img src="../storage/app/images/papaslogo.png" width=100; height=25; />
		</table>
		<br> <br>
		<table class="general" >
			<tr>
				<td width=35%>
					<b> Reporte De Traspaso De Botellas #{{$dataTraspaso->id}}</b>
				</td>
				<td width=40%> </td>
				<td class="der" width=25%>
					<b> Fecha: </b> <i> {{$dataTraspaso['created_at']}}</i>
				</td>
			</tr>
		</table>
		<br>
		<table class="general">
			<tr>
				<td width=18%> <b> Area De Salida: </b> </td>
				<td>  {{ $dataTraspaso->user_rel->almacen->nombre }} </td>

			</tr>
		</table>
		<hr>
		<table class="reporte">
			<tr>
				<th class="cen" width=10%> Cantidad </th>
				<th width=20%> Movimiento </th>
				<th width=45%> Descripción </th>
			</tr>
			@foreach($data as $datos => $value)
				<tr>
					<td class="cen" width=10%> {{$value['qty']}} </td>
					<td width=20%> {{ $movimientos[ $value['movimiento_id'] ] }} </td>
					<td width=50%> {{$value['descs']}} </td>
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
				<td width=29%> <span style="font-size: 12px;"> ({{ $dataTraspaso->user_rel->name }}) </span>  </td>
				<td width=16%> </td>
				<td width=29%> <span style="font-size: 12px;"> ({{$dataTraspaso->recibe}}) </span> </td>
				<td width=13%> </td>
			</tr>
			<tr class="cen">
				<td width=13%> </td>
				<td width=29%> <b> ENTREGA </b> </td>
				<td width=16%> </td>
				<td width=29%> <b> RECIBE </b> </td>
				<td width=13%> </td>
			</tr>
			
		</table>
		
	</body>
</html>