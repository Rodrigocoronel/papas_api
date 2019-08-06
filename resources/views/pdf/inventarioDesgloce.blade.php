<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>reporte</title>
		<style type="text/css">
			
			.utilidad tr:nth-child(even) {background-color: #f2f2f2;}
			table.encabezados{
				width: 100%;
				border-collapse: collapse;
			}
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
			.cen { text-align: center; }
		</style>
		
	</head>
	<body>
		<h2 align="center">REPORTE DE INVENTARIO </h2>
		<table class="encabezados">
			<thead>
				<tr>
					<th> <br> </th>
				</tr>
				<tr>
					<th width="8%"> ÁREA:         </th>
					<th width="37%"> {{$almacen}} </th>
					<th width="10%"> FECHA:       </th>
					<th width="24%"> {{$fecha}}   </th>
					<th width="9%"> HORA:         </th>
					<th width="12%"> {{$hora}}    </th>
				</tr>
				<tr>
					<th> <br> </th>
				</tr>
			</thead>
		</table>
		
		<table class="utilidad" border="1px solid">
			<thead>
				<tr>
					<th align="center" width="15%">Fólio</th>
					<th align="center" width="15%">Insumo</th>
					<th align="center" width="50%">Descripción</th>
					<th align="center" width="20%">Área</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data as $todo => $dataValues)
					<tr>
						<td align="center">{{$dataValues['id']}}</td>
						<td align="center">{{$dataValues['insumo']}}</td>
						<td align="center">{{$dataValues['desc_insumo']}}</td>
						<td align="center">{{$dataValues['almacen_id']}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>

	</body>
</html>