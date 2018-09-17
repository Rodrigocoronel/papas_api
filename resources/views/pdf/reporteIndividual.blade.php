<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Reporte Individual</title>
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
		<p >{{$fecha}}</p>
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
			<h3 ><img src="images/linetag.png" width="4" height="15">   Datos Tecnico </h3>
		</div><br/>

		<table width="100%">
		  <tr  >
		    <th  width="43%" class="sombra2">
		    	<b>Nombre:	</b><?php echo ucfirst(($ticket['usuario']->name)) 	?>
		    </th>
		    <th width="4%"></th>
		    <th width="43%" class="sombra2"> Depatamento:	<?php echo ucfirst(($ticket['departamento']->nombre)) ?>
		    </th>
		  </tr >
		  <tr >
		    <th  class="sombra">Producción:	<?php echo ucfirst(('$ '.number_format($ticket['total'],2))) ?></th>
		    <th width="4%"></th>
		    <th  class=" sombra">Meta:	<?php echo ucfirst(('$ '.number_format($ticket['meta'],2))) ?></th>
		  </tr>
		  <tr >
		    <th  class="sombra2">Porcentaje Actual:	<?php echo ucfirst(($ticket['actual'])) ?> % </th>
		    <th width="4%"></th>
		    <th  class="sombra2">Procentaje Esperado:	<?php echo ucfirst(($ticket['esperado'])) ?> %</th>
		  </tr>
		  <tr >
		    <th  class="sombra">Total de Ventas:	<?php echo ucfirst(('$ '.number_format($ticket['total_ventas'],2))) ?></th>
		   
		    <th  class="sombra"></th>
		  </tr>
		</table>
		<br/>

		<div align="center">
			<h3 ><img src="images/linetag.png" width="4" height="15">   Ticket de producción </h3>
		</div><br/>

		<div>
		<table  class="intro">
			<thead class="botBorder">
				<tr >
					<th width="20%">Fecha</th>
					<th width="20%">Clave</th>
					<th width="50%">Cleinte</th>
					<?php if($ticket['usuario']->departamento=='1') {?>
				    		<th width="10%" align="right">Subtotal</th>
				    	<?php

				    	}else{ ?> <th width="10%" align="right">Utilidad</th> <?php

				    	}
				    	 ?>
				    	
					
					
				</tr>
			</thead>
			<tbody>
				<?php
				$n = 1;
				$total =0;
				foreach ($ticket['tickets'] as $key => $value)
				{
					$total +=$value['produccion_numero'];
				?>

					<tr>
						<td><?php echo $value["fecha_finalizado"]; ?></td>
						<td><?php echo $value["clave"]; ?></td>
						<td><div style="word-wrap: break-word; font-size : 10px"><?php echo $value["cliente"]; ?></div></td>
						
						<td align="right"><?php echo $value["total"] ?></td>
					</tr>

				<?php
				$n++;	
				}
				?>

			</tbody>
		</table>
		<div align="right" style="margin-top: 20px; margin-bottom: 10px;">
			Total: <?php echo '$ '.number_format($total,2) ?>
		</div>
		

		

		
	</div>
	<div style="font-size: 10px; background: #E5EAE9; height: 50px">
		
	</div>
</body>
</html>