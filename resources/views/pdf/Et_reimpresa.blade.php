<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Etiquetas Reimpresas</title>
		<style type="text/css">
			@page{ margin: 0.5cm 1cm 1.5cm 1cm; }
			html{ width: 100%; }			
			body{ width: 100%; }
			table{
				width: 100%;
				border-collapse: collapse;
				
			}
			.cen { text-align: center; }

			.reporte { width: 100%; }
			.reporte tr:nth-child(even) {
				background-color: #bbbbbb;
			}
		</style>
	</head>

	<body>
		<span style="font-size: 12px;">Etiquetas Reimpresas {{$fecha1}} - {{$fecha2}}</span>
		<hr>
		<table class="reporte">
			<thead style="font-size: 14px;">
				<tr>
					<th class="">Descripción de insumo</th>
					<th class="">Folio Eliminado</th>
					<th class="">Folio Nuevo</th> 
					<th class="">Fecha</th>
					<th class="">Usuario</th> 
				</tr>
			</thead>
			<tbody style="font-size: 12px;">
				@foreach($data as $botella => $valueBotella)
					<tr>
						<td>{{ $valueBotella->desc_insumo }}</td>
						<td>{{ $valueBotella->destruida_id }}</td>
						<td>{{ $valueBotella->nueva_id }}</td>
						<td>{{ $valueBotella->created_at }}</td>
						<td>{{ $valueBotella->name }}</td>
					</tr>

				@endforeach
			</tbody>
		</table>
	</body>
</html>