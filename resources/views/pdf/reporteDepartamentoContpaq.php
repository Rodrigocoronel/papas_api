<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Reporte Departamento Contpaq</title>
	<style type="text/css">

		html,body{
			font-family: myriad pro;
			font-size: 13px;

		}
		
		th{
			position: fixed;
		}
		h2, h3, h4, h5 {
			margin: 0;
			display: block;
		}

		small {
			font-size: .8em;
			color: #2e2e2e;
		}

		table.header {
			width: 100%;
			border-collapse: collapse;
			margin: 0px;
			padding: 0px;
		}
		table.header,
		table.header td {
			border-bottom: 1px solid rgba(0,0,0,.1);
		}

		table.header td {
			
		}
		
		.logo {
			display: block;
			border: 0;
			margin: 0;
			width: 50px;
			height: auto;
		}

		.logomaxcont{
		    height: 252px;
		       background-position: center -11px;
		    transform: scale(0.9);
		    position: relative;
		    background-image: url("images/logomaxcont.svg");
		    background-repeat: no-repeat;
		 
		 
		 }

		.ticketborder{
			 padding:2% 0 0 0; 
			 border-top:4px solid #606161; 
			 border-bottom: 4px solid #606161;
			 width: 100%;
		}

		table.intro {
			width: 100%;
			padding: 0px;
			margin-top: 0px;
			/*border-collapse: collapse;*/
			/*border-spacing: 15px;*/
			/*border: 1px solid rgba(0,0,0,.1);*/
		}

		.sombra{
			padding-left: 10px;
			padding-top: 5px;
			padding-bottom: 5px;
		}
		.sombra2{
			background: #E5EAE9
			margin-left : 20px;
			padding-left: 10px;
			padding-top: 5px;
			padding-bottom: 5px;
		}
		p{
			margin: 0px;
		}

	</style>
</head>
<body>
	<div align="right">
		<p ><?php echo $fecha ?></p>
	</div>

	<div class="ticketborder" > 
		<table class="intro">
			<tr>
				<td   align="left">
					<img src="images/logomaxicont.png" alt="My SVG Icon" width="360" height="58">
				</td>
				
				<td  align="right">
					<table style="width:100%">
					  <tr>
					    <th style="font-size: 12px">Inicio : </th>
					    <th style="font-size: 12px">Final :</th>
					  </tr>
					  <tr>
					    <td style="font-size: 12px">
					    	<?php echo $ticket['inicio'] ?>
							
						</td>
					    <td style="font-size: 12px">
					    	<?php echo $ticket['final'] ?>
					    </td>
					  </tr>
					</table>					
				</td>
			</tr>
		</table>

		

		<div align="center">
			<h3 ><img src="images/linetag.png" width="4" height="15">   Tickets Del Mes </h3>
		</div><br/>

		<div>
		<table  class="intro">
			<thead class="botBorder">
				<tr >
					<th width="10%">Fecha</th>
					<th width="10%">Clave</th>
					<th width="10%">Factura</th>
					<th width="15%">Cliente</th>
					<th width="15%">Asesor</th>					
					<th width="10%" align="right">Estado</th>
					<th width="10%" align="right">Subtotal</th>
					<th width="10%" align="right">Costo</th>
					<th width="10%" align="right">Utilidad</th>
					
				</tr>
			</thead>
			<tbody>
				<?php
				$n = 1;
				$total =0;
				$costo=0;
				$utilidad=0;
				foreach ($ticket['tickets'] as $key => $value)
				{
					$total +=$value['subtotal2'];
					$costo +=$value['costo_numero'];
					$utilidad +=$value['produccion_numero'];
				?>

					<tr>
						<td><?php echo $value["fecha_pago"]; ?></td>
						<td><?php echo $value["clave"]; ?></td>
						<td><?php echo $value["factura"]; ?></td>
						<td><div style="word-wrap: break-word; font-size : 10px"><?php echo $value["cliente"]; ?></div></td>
						<td><div style="word-wrap: break-word; font-size : 10px"><?php echo $value["asesor"]; ?></div></td>
						<td align="right"><?php echo $value["pagado"] ?></td>
						<td align="right"><?php echo $value["subtotal"] ?></td>
						<td align="right"><?php echo $value["costo"] ?></td>
						<td align="right"><?php echo $value["produccion"] ?></td>
					</tr>

				<?php
				$n++;	
				}
				?>

			</tbody>
		</table>
		<div align="right" style="margin-top: 20px; margin-bottom: 10px;">
			Subtotal: <?php echo '$ '.number_format($total,2) ?>
		</div>
		<div align="right" style="margin-top: 20px; margin-bottom: 10px;">
			Costo: <?php echo '$ '.number_format($costo,2) ?>
		</div>
		<div align="right" style="margin-top: 20px; margin-bottom: 10px;">
			Utilidad: <?php echo '$ '.number_format($utilidad,2) ?>
		</div>
		

		

		
	</div>
	<div style="font-size: 10px; background: #E5EAE9; height: 50px">
		
	</div>
</body>
</html>