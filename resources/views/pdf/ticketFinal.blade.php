<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Maxicomm Ticket</title>
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
		table.intro2 {
			width: 100%;
			padding: 0px;
			margin-top: 0px;
			border-collapse: collapse;
			
			/*border-spacing: 15px;*/
			
		}

		table.intro {
			width: 100%;
			padding: 0px;
			margin-top: 0px;
			border-collapse: collapse;
			
			/*border-spacing: 15px;*/
			border: 2px solid rgba(0,0,0,.1);
		}
		table.intro td {
			border: 2px solid rgba(0,0,0,.1);
		}
		table.intro th {
			border: 2px solid rgba(0,0,0,.1);
		}
		.descripcion{
			text-align: center;
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
		<p >{{date('d-m-Y', strtotime($ticket->fecha_pago))}}</p>
	</div>

	<div class="ticketborder" > 
		<table class="intro2">
			<tr>
				<td   align="left">
					<img src="images/logomaxicont.png" alt="My SVG Icon" width="360" height="58">
				</td>
				
				<td  align="right">
					<table style="width:100%">
					  <tr>
					    <th style="font-size: 12px">Inicio : </th>
					    <th style="font-size: 12px">Clave :</th>
					  </tr>
					  <tr>
					    <td style="font-size: 12px">
					    	<?php echo date('d-m-Y', strtotime($ticket->created_at))?> <br/>
							<?php echo date('H:i:s', strtotime($ticket->created_at))?>
						</td>
					    <td style="font-size: 12px">
					    	<?php echo $ticket->clave ?>
					    </td>
					  </tr>
					</table>					
				</td>
			</tr>
		</table>

		<div align="center">
			<h3 ><img src="images/linetag.png" width="4" height="15">   Datos Cliente </h3>
		</div><br/>

		<table width="100%">
		  <tr  >
		    <th  width="43%" class="sombra2">
		    	<b>Nombre:	</b><?php echo ucfirst(($ticket->cliente->cliente)) 	?>
		    </th>
		    <th width="4%"></th>
		    <th width="43%" class="sombra2">Empresa:	<?php echo ucfirst(($ticket->cliente->rSocial)) ?>
		    </th>
		  </tr >
		  <tr >
		    <th  class="sombra">Usuario:	<?php echo ucfirst(($ticket->cliente->contacto)) ?></th>
		    <th width="4%"></th>
		    <th  class=" sombra">RFC:	<?php echo ucfirst(($ticket->cliente->rfc)) ?></th>
		  </tr>
		  <tr >
		    <th  class="sombra2">Domicilio:	<?php echo ucfirst(($ticket->cliente->domicilio)) ?> </th>
		    <th width="4%"></th>
		    <th  class="sombra2">Teléfono:	<?php echo ucfirst(($ticket->cliente->telefono)) ?></th>
		  </tr>
		 
		</table>
		<br/>
		<div align="center">
			<h3 ><img src="images/linetag.png" width="4" height="15">   Descripción de producto/servicio </h3>
		</div><br/>

		<div>
		<table  class="intro">
			<thead class="botBorder">
				<tr >
					<th width="20%">Producto/Servicio</th>
					<th class="descripcion" width="60%">Descripción</th>
					<th class="descripcion" width="10%">Cantidad</th>
					<th class="descripcion" width="10%" align="right">Precio</th>
					
				</tr>
			</thead>
			<tbody>
				<?php
				$n = 1;
				$total =0;
				foreach ($ticket->itemsArray as $key => $value)
				{
					$total +=$value['total'];
				?>

					<tr>
						<td><?php echo $value["categoria"]; ?></td>
						<td class="descripcion"><div style="word-wrap: break-word; font-size : 10px"> <?php echo $value["descripcion"]; ?> </div></td>
						<td class="descripcion"><?php echo $value["cantidad"]; ?></td>
						<td align="right"><?php echo '$'.number_format($value["total"],2) ?></td>
					</tr>

				<?php
				$n++;	
				}
				?>

			</tbody>
		</table>
		<div align="right" style="margin-top: 20px; margin-bottom: 10px;">
			Total: <?php echo '$'.number_format($total,2)  ?>
		</div>
		<div align="center" style="margin-top: 20px; margin-bottom: 10px;">
			<?php if(file_exists( '/home/g9x390li93u2/laravel/public/images/signCapture/final-'.$ticket->id.'.png')) {

				    		$src='images/signCapture/final-'.$ticket->id.'.png';
				    		?>
				    		<img src=<?php echo $src;?> width="250px" height="50px">
				    		<br/>
					<b style="justify-content: center">Nombre y Firma de conformidad del cliente</b>
					<br/><br/>

				    	<?php

				    	}
				    	 ?>
				    	
					
		</div>
	</div>

		

		<div style=" width: 100%">
		
		<p align="right"  >
						Tecnico:	<?php echo ucfirst(($asignado)) ?>
					</p>
	</div>
	</div>
	
	<div style="font-size: 10px; background: #E5EAE9">
		<table width="100%">
			<tr>
				<td  width="100%">
					<p align="left" style="font-size: 10px" >
						•	Maxicom no se hace responsable por la integridad 
						de la informacion cuando la perdida sea ocacionada 
						por virus o daño fisico del disco duro.<br/>
						•	Maxicomm no se hace responsable por equipos abandonado por mas de 30 dias.
					</p>
				</td>
			</tr>
			<tr>
				<td><br/></td>
			</tr>
			<tr>
				<td width="50%" align="center" style="padding-left: 30px">
					<p>
						<img src="images/ubiacion.png" width="15" height="15">
						Macheros No.366-2 entre 3ra. y 4ta Z.C.,Ensenada, Bc, Mexico Tel(646)178-80-08
					</p>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>