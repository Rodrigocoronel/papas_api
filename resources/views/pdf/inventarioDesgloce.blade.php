<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>reporte</title>
	<style type="text/css">
		
		.utilidad tr:nth-child(even) {background-color: #f2f2f2;}

		table.utilidad{
			width: 100%;
			border-collapse: collapse;
		}

		body{
			width: 100%;
		}
		html{
			width: 100%;
		}

	</style>
	
</head>
<body>
	<h4>Inventario almacen {{$almacen}}</h4>
	<table class="utilidad" border="1px solid">
		<thead>
			<tr>
				<th width="15%">Folio</th>
				<th width="15%">Insumo</th>
				<th width="15%">Desc.</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $todo => $dataValues)
				<tr>
					<td align="center">{{$dataValues['id']}}</td>
					<td align="center">{{$dataValues['insumo']}}</td>
					<td align="center">{{$dataValues['desc_insumo']}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>