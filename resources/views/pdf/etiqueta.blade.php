<?php
	foreach($imagen as $index => $img)
	{
		$imageData = base64_encode(file_get_contents($img));
		$imagen64[$index] = 'data:'.mime_content_type($img).';base64,'.$imageData;
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>reporte</title>
		<style type="text/css">
			@page{ margin: 0.0cm 0.4cm 0.0cm 0.4cm; }
			html{ width: 100%; }			
			body{ width: 100%; }
			td.trim
			{
				white-space: nowrap;
				overflow: hidden;
			}
			.cen { text-align: center; }
			td.x { width: 30%; }
			td.y { width: 30%; }
			td.z { width: 40%; }
			.sm { font-size: xx-small; }
			.md { font-size: x-small; }
		</style>
	</head>
	<body>
		<table>
			<tbody>
				@foreach($etiqueta as $index => $registro)
					<tr>
						<td class="x cen" rowspan="4">
							<?php 
								echo '<img src="',$imagen64[$index],'" alt="" height="75" width="75">';
							?>
						</td>
						<td class="y md"> <b>FÓLIO: </b> </td>
						<td class="z md"> <b> {{ $registro['id'] }} </b> </td>
					</tr>
					<tr>
						<td class="y md"><b> FACTURA: </b> </td>
						<td class="z md"><b> {{ $registro['folio_factura'] }} </b> </td>
					</tr>
					<tr>
						<td class="y md"> <b>COMPRA: </b> </td>
						<td class="z md"> <b> {{ $registro['fecha_compra'] }} </b> </td>
					</tr>
					<tr>
						<td class="y md"><b> INSUMO: </b> </td>
						<td class="z md"><b> {{ $registro['insumo'] }} </b> </td>
					</tr>
					<tr>
						<td class="x sm trim" colspan="3"> <b> {{ $registro['desc_insumo'] }} </b> </td>
					</tr>
					<tr>
						<td class="x sm trim" colspan="3"> <b> {{ $registro['comprador'] }} </b> </td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</body>
</html>