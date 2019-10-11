<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>reporte</title>
		<style type="text/css">
			@page{ margin: 0.4cm 0.4cm 0.0cm 0.4cm; }
			html{ width: 100%; }			
			body{ width: 100%; }

			.cen { text-align: center; }
			.sm { font-size: xx-small; }
			.md { font-size: x-small; }


			div.main {
				position: relative;
				width: 100%;
				height: 107px;

			}
			div.codigo {
				position: absolute;
				top: 0px;
				left: 0px;
				width: 75px;
				height: 60%;

			}
			div.titulos {
				position: absolute;
				top: 2px;
				left: 76px;
				width: 65px;
				height: 56px;

			}
			div.info {
				position: absolute;
				top: 2px;
				left: 148px;
				width: 100%;
				height: 56px;

			}
			div.info2 {
				position: absolute;
				top: 59px;
				left: 76px;
				width: 100%;
				height: 18px;

			}
			div.info3 {
				position: absolute;
				top: 75px;
				left: 0px;
				width: 100%;
				height: 30px;

			}
		</style>
	</head>
	<body>
		@foreach($etiqueta as $index => $registro)
			<div class="main">
				<div class="codigo">
					<img src={{storage_path('codigos/'.$registro['id'].'.png')}} height="75" width="75"/>
				</div>
				<div class="titulos md">
					<b>
						FÓLIO:
						FACTURA:
						COMPRA:
						INSUMO:
					</b>
				</div>
				<div class="info md">
					<b>
						{{ $registro['id'] }} <br>
						{{ $registro->factura->folio_factura }} <br>
						{{ $registro['fecha_compra'] }} <br>
						{{ $registro['insumo'] }} <br>
					</b>
				</div>
				<div class="info2 md">
					<b>
						PAPAS & BEER <br>
					</b>
				</div>
				<div class="info3 sm">
					<b>
						{{ $registro['desc_insumo'] }} <br>
						{{ $registro->factura->proveedor }} <br>
					</b>
				</div>
			</div>
		@endforeach
	</body>
</html>