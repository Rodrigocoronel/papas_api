<?php
	$image = './../storage/app/images/papaslogoonwhite.jpg';
	$imageData = base64_encode(file_get_contents($image));
	$src = 'data:'.mime_content_type($image).';base64,'.$imageData;
?>
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
				table-layout: fixed;
			}
			th.x { width: 5%; border: 2px solid; }
			th.y { width: 5%; padding: 2px;}
			td.x { width: 5%; border: 1px solid; }
			.cen { text-align: center; }
		</style>
	</head>
	<body>
		<table>
			<thead>
				<tr>
					@FOR($a=1;$a<=20;$a++) <th class='y'></th> @ENDFOR
				</tr>
				<tr>
					<th class="y" colspan="5"> <?php echo '<img src="',$src,'" alt="" height="30" width="120">'; ?> </th>
					<th class="y cen" colspan="10"> <h2 align="center"> REPORTE DE INVENTARIO </h2> </th>
					<th class="y" colspan="5"> </th>
				</tr>
				<tr>
					<th class="y" colspan="8"> ÁREA:  &nbsp;{{ $almacen }} </th>
					<th class="y" colspan="7"> FECHA: &nbsp;{{ $fecha }}   </th>
					<th class="y" colspan="5"> HORA:  &nbsp;{{ $hora }} hrs. </th>
				</tr>
				<tr>
					<th class="y" colspan="20"> </th>
				</tr>
				<tr>
					<th class="x cen"> No. </th>
					<th class="x cen" colspan="2"> 
						@IF($desglosar==1)
							Fólio
						@ELSE
							Cantidad
						@ENDIF 
					</th>
					<th class="x cen" colspan="2"> Insumo </th>
					@IF($area=='9999')
						<th class="x cen" colspan="11"> Descripción </th>
						<th class="x cen" colspan="4"> Área </th>
					@ELSE
						<th class="x cen" colspan="15"> Descripción </th>
					@ENDIF
				</tr>
			</thead>
			<tbody>
				@FOREACH($data as $todo => $dataValues)
					<tr>
						<td class="x cen"> {{ $todo + 1 }}</td>
						<td class="x cen" colspan="2">
							@IF($desglosar==1)
								{{ $dataValues['id'] }}
							@ELSE
								{{ $dataValues['cantidad'] }}
							@ENDIF
						</td>
						<td class="x cen" colspan="2"> {{ $dataValues['insumo'] }} </td>
						@IF($area=='9999')
							<td class="x cen" colspan="11"> {{ $dataValues['desc_insumo'] }} </td>
							<td class="x cen" colspan="4"> {{ $dataValues['almacen_id'] }} </td>
						@ELSE
							<td class="x cen" colspan="15"> {{ $dataValues['desc_insumo'] }} </td>
						@ENDIF
					</tr>
				@ENDFOREACH
			</tbody>
		</table>
	</body>
</html>