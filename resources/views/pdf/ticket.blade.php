<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Maxicomm Ticket</title>
	<style type="text/css">

		html, body {
			font-family: Arial, helvetica;
			font-size: 17px;
		}
	
		h2, h3, h4, h5 {
			margin: 0;
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

		.title {
			color: #ED0303;
		}

		table.intro {
			width: 100%;
			border-collapse: collapse;
			/*border-spacing: 15px;*/
			/*border: 1px solid rgba(0,0,0,.1);*/
		}
		table.intro,
		table.intro td {
			border: 1px solid rgba(0,0,0,.1);
			padding: 15px;
		}

	</style>
</head>
<body>

	<table class="header">
		<tr>
			<td>
				<h2 class="title">Maxicomm</h2>
			</td>
			<td width=50%></td>
			<td width=25%>
				<h4>Ticket</h4>
				<h5>clave: <?php echo $ticket->clave; ?></h5>
				<small>Fecha: <?php echo $ticket->fecha_ticket; ?></small>
			</td>
		</tr>
	</table>
	
	<table class="intro">
		<tr>
			<td width="50%">
				<p>Maxicomm</p>
				<p>Macheros 366, entre 3era.<br/>
				y 4ta., Zona Centro<br>
				C.P. 22800<br>
				Ensenada, Baja California</p>
				<p>Tel. (646) 178-8008</p>
			</td>
			<td width="50%">
				<p><?php echo ucfirst(strtolower($ticket->cliente->cliente)) ?><br>
					<?php echo ucfirst(strtolower($ticket->cliente->contacto)) ?><br>
					<?php echo $ticket->cliente->correo ?>
				</p>
				<p><?php echo ucfirst(strtolower($ticket->cliente->domicilio)) ?><br>
					<?php echo ucfirst(strtolower($ticket->cliente->ciudad)) ?></p>
				<p>Tel. <?php echo $ticket->cliente->telefono ?></p>
			</td>
		</tr>
	</table>

	<table class="intro">
		<tr>
			<td>
				<u>Proceso:</u>
				<br><br><?php echo $ticket->ProcessName; ?>
				<br><br><u>Descripción:<u><br>
				{!! $ticket->descripcion !!}
			</td>
		</tr>
	</table>

	<table class="intro">
		<tr>
			<td width=33%>
				<u>Total:</u>
				<br><br><?php echo ($ticket->precio > 0) ? 
				"$".number_format($ticket->precio, 2) : '---'; ?>
			</td>
			<td width=33%>
				<u>Fecha de Pago:</u>
				<br><br><?php echo $ticket->fecha_pago ? $ticket->fecha_pago : '---'; ?>
			</td>
			<td width=33%>
				<u>Factura:</u>
				<br><br><?php echo $ticket->factura ? $ticket->factura : '---'; ?>
			</td>
		</tr>
	</table>

	<?php
	if( isset($firma) ) {
	?>
	

		<table class="intro">
			<tr>
				<td width=100%>
					<img src="<?php echo $firma; ?>" 
					style="display: block; margin: 0 auto; width: 300px; height: auto;" />
					<p>Firma</p>
				</td>
			</tr>
		</table>


	<?php
	}
	?>

</body>
</html>