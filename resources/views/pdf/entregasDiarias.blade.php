<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Maxicomm Ticket</title>
	<style type="text/css">

		html, body {
			font-family: myriad pro;
			font-size: 17px;
		}
	
		h2, h3, h4, h5 {
			margin: 5;
			display: block;
		}

		small {
			font-size: .7em;
			color: #2e2e2e;
		}


		table.header {
			width: 100%;
			border-collapse: collapse;
		}
		table.header,
		table.header td {
			border-bottom: 1px solid rgba(0,0,0,.1);
		}

		table.header td {
			height: 90px;
		}
		
		.logo {
			display: block;
			border: 0;
			margin: 0;
			width: 50px;
			height: auto;
		}

		.ticketborder{
			 padding:2% 0 0 0; 
			 border-top:4px solid #606161; 
			 border-bottom: 4px solid #606161;
			 width: 100%;
		}
		.title {
			color: #ED0303;
			font-size: 20px;
		}

		.float{
			float: right;
		}

		.floatleft {
			float: left;
		}

		.container{
			margin-top: 40px;
		}
		table.intro {
			width: 100%;
			padding: 0px;
			margin-top: 0px;
			/*border-collapse: collapse;*/
			/*border-spacing: 15px;*/
			/*border: 1px solid rgba(0,0,0,.1);*/
		}
	</style>
</head>
<body>
	<div class="ticketborder">
		<table class="intro">
				<tr>
					<td   align="left">
						<img src="images/logomaxicont.png" alt="My SVG Icon" width="360" height="58">
					</td>
					
					<td  align="right">
						<p >{{date('d-m-Y', strtotime($fecha2))}}</p>					
					</td>
				</tr>
			</table>
		<div style="font-size: 30px" align="center">
			<h5>Corte Del Dia</h5>
		</div>
		<br/><br/>
			<div align="center">Efectivo</div>
			<table class="intro" style="font-size: 15px">
				<thead class="heading">
					<tr >
						<th width="20%">Clave</th>
						<th width="30%">Cliente</th>
						<th width="20%">Cobro</th>
						<th width="15%">Total</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$n = 1;
				$total =0;
				foreach ($ticket as $key => $value)
				{
					if($value['tipo_pago'] === "Efectivo"){
						$total +=$value['total'];
						echo "
					<tr >
						<td>".$value['clave']."</td>"
						."<td>".$value['tecnico']."</td>"	
						."<td>".$value['cobro']."</td>"
						."<td>".$value['total']."</td>"
					."</tr>"; 
				}
				?>

					

				<?php
					
				}
				?>
			
				</tbody>
				<div align="right" style="padding-right: 40px">Total: <?php echo $total ?></div>
			</table>

			<hr/>
			<br/>
			<div align="center">Credito</div>
			<br/>
			<table class="intro" style="font-size: 15px">
				<thead class="heading">
					<tr >
						<th width="20%">Clave</th>
						<th width="30%">Cliente</th>
						<th width="20%">Cobro</th>
						<th width="15%">Total</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$n = 1;
				$total =0;
				foreach ($ticket as $key => $value)
				{
					if($value['tipo_pago'] === "Credito"){
						$total +=$value['total'];
						echo "
					<tr >
						<td>".$value['clave']."</td>"
						."<td>".$value['tecnico']."</td>"	
						."<td>".$value['cobro']."</td>"
						."<td>".$value['total']."</td>"
					."</tr>"; 
				}
				?>

					

				<?php
					
				}
				?>
			
				</tbody>
				<div align="right" style="padding-right: 40px">Total: <?php echo $total ?></div>
			</table>
			<hr/>
			<br/>
			<div align="center">Cheque</div>
			<br/>
			<table class="intro" style="font-size: 15px">
				<thead class="heading">
					<tr >
						<th width="20%">Clave</th>
						<th width="30%">Cliente</th>
						<th width="20%">Cobro</th>
						<th width="15%">Total</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$n = 1;
				$total =0;
				foreach ($ticket as $key => $value)
				{
					if($value['tipo_pago'] === "Cheque"){
						$total +=$value['total'];
						echo "
					<tr >
						<td>".$value['clave']."</td>"
						."<td>".$value['tecnico']."</td>"	
						."<td>".$value['cobro']."</td>"
						."<td>".$value['total']."</td>"
					."</tr>"; 
				}
				?>
				<?php	
				}
				?>
			
				</tbody>
				<div align="right" style="padding-right: 40px">Total: <?php echo $total ?></div>
			</table>
			<hr/>
			<br/>
			<div align="center">Tarjeta Credito/Débito</div>
			<br/>
			<table class="intro" style="font-size: 15px">
				<thead class="heading">
					<tr >
						<th width="20%">Clave</th>
						<th width="30%">Cliente</th>
						<th width="20%">Cobro</th>
						<th width="15%">Total</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$n = 1;
				$total =0;
				foreach ($ticket as $key => $value)
				{
					if($value['tipo_pago'] === "Tarjeta Credito/Debito"){
						$total +=$value['total'];
						echo "
					<tr >
						<td>".$value['clave']."</td>"
						."<td>".$value['tecnico']."</td>"	
						."<td>".$value['cobro']."</td>"
						."<td>".$value['total']."</td>"
					."</tr>"; 
				}
				?>
				<?php	
				}
				?>
			
				</tbody>
				<div align="right" style="padding-right: 40px">Total: <?php echo $total ?></div>
			</table>
			<hr/>
			<br/>
			<div align="center">Transferencia</div>
			<br/>
			<table class="intro" style="font-size: 15px">
				<thead class="heading">
					<tr >
						<th width="20%">Clave</th>
						<th width="30%">Cliente</th>
						<th width="20%">Cobro</th>
						<th width="15%">Total</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$n = 1;
				$total =0;
				foreach ($ticket as $key => $value)
				{
					if($value['tipo_pago'] === "Transferencia"){
						$total +=$value['total'];
						echo "
					<tr >
						<td>".$value['clave']."</td>"
						."<td>".$value['tecnico']."</td>"	
						."<td>".$value['cobro']."</td>"
						."<td>".$value['total']."</td>"
					."</tr>"; 
				}
				?>
				<?php	
				}
				?>
			
				</tbody>
				<div align="right" style="padding-right: 40px">Total: <?php echo $total ?></div>
			</table>
		<footer>
			<div class="container">
				
				<div class="floatleft">
					_____________________________
					<div>
						<p>
							Entrega
						</p>
					</div>
				</div>

				<div class="float">
					_____________________________
					<div>
						<p>
							Recibe
						</p>
					</div>
				</div>
			</div>
		</footer>
	</div>
</body>
</html>