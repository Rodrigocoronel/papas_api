<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>reporte</title>
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
		<table>
			<thead>
				<tr>
					<th class="y" colspan="5">  
						<img style="position: relative;" src={{storage_path('app/images/papaslogoonwhite.jpg')}} height="30" width="120"/>
					</th>
					<th class="y cen" colspan="10"> <p align="center"> Facturas impresas {{$fecha1}} - {{$fecha2}}</p></th>
					<th class="y" colspan="5"> </th>
				</tr>
			</thead>
		</table>
		<hr/>
		<table class="reporte">
			<thead style="font-size: 14px;">
				<tr>
					<th class="x cen"> Folio Factura </th>
					<th class="x cen" > Fecha Factura</th>
					<th class="x cen" > Fecha Impresa </th>
					<th class="x cen" > Insumo </th>
					<th class="x cen" > Cantidad </th>
					<th class="x cen" > Folios </th>
					<th class="x cen" > Proveedor </th>
				</tr>
			</thead>
			<tbody style="font-size: 12px;">
				@foreach($data as $todo => $dataValues)
					<tr>
						<td class="x cen"> {{ $dataValues->folio_factura }} </td>
						<td class="x cen"> {{ $dataValues->fecha_compra }} </td>
						<td class="x cen"> {{  date("Y-m-d", strtotime($dataValues->fecha_impreso))  }} </td>
						<td class="x cen"> {{ $dataValues->insumo }} </td>
						<td class="x cen"> {{ $dataValues->cantidad }} </td>
						<td class="x cen"> {{ $dataValues->minimo }} - {{$dataValues->maximo }} </td>
						<td class="x "> {{ $dataValues->proveedor }} </td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</body>
</html>