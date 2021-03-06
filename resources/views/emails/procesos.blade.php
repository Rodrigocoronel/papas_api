    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" style="font-family: myriad pro;  font-size: 13px;">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>[SUBJECT]</title>
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
<body  style="font-family: myriad pro;  font-size: 13px;">
  <div align="right">
    <p >{{date('d-m-Y')}}</p>
  </div>

  <div class="ticketborder" style=" padding:2% 0 0 0; border-top:4px solid #606161; border-bottom: 4px solid #606161; width: 100%;" > 
    <table class="intro">
      <tr>        
        <td  align="right">
          <table style="width:100%">
            <tr>
             
              <th style="font-size: 12px">Ticket :   <?php echo $ticket->clave ?></th>
            </tr>
          </table>          
        </td>
      </tr>
    </table>

    <div align="center">
      <h3 >  Datos Cliente </h3>
    </div><br/>

    <table width="100%">
      <tr  >
        <th  width="43%" class="sombra2" style=" background: #E5EAE9; margin-left : 20px; padding-left: 10px; padding-top: 5px; padding-bottom: 5px;">
          <b>Nombre:  </b><?php echo ucfirst(($ticket->cliente->cliente))   ?>
        </th>
        <th width="4%"></th>
        <th width="43%" class="sombra2" style=" background: #E5EAE9; margin-left : 20px; padding-left: 10px; padding-top: 5px; padding-bottom: 5px;">Empresa:  <?php echo ucfirst(($ticket->cliente->rSocial)) ?>
        </th>
      </tr >
      <tr >
        <th  class="sombra" style=" padding-left: 10px; padding-top: 5px; padding-bottom: 5px;" >Contacto:  <?php echo ucfirst(($ticket->cliente->contacto)) ?></th>
        <th width="4%"></th>
        <th  class=" sombra" style=" padding-left: 10px; padding-top: 5px; padding-bottom: 5px;">RFC: <?php echo ucfirst(($ticket->cliente->rfc)) ?></th>
      </tr>
      <tr >
        <th  class="sombra2" style=" background: #E5EAE9; margin-left : 20px; padding-left: 10px; padding-top: 5px; padding-bottom: 5px;">Domicilio: <?php echo ucfirst(($ticket->cliente->domicilio)) ?> </th>
        <th width="4%"></th>
        <th  class="sombra2" style=" background: #E5EAE9; margin-left : 20px; padding-left: 10px; padding-top: 5px; padding-bottom: 5px;">Teléfono:  <?php echo ucfirst(($ticket->cliente->telefono)) ?></th>
      </tr>
     
    </table>
    <br/>
    <div align="center">
      <h3 > Estado: <?php echo ucfirst(($estado)) ?> </h3>
    </div><br/>

   

    

    <div style=" width: 100%">
    
    <p align="right"  >
            Tecnico:  <?php echo ucfirst(($asignado)) ?>
          </p>
  </div>
  </div>
  
  <div style="font-size: 10px; background: #E5EAE9">
    <table width="100%">
      <tr>
        <td  width="100%">
          <p align="left" style="font-size: 10px" >
            • Maxicom no se hace responsable por la integridad 
            de la informacion cuando la perdida sea ocacionada 
            por virus o daño fisico del disco duro.<br/>
            • Maxicomm no se hace responsable por equipos abandonado por mas de 30 dias.
          </p>
        </td>
      </tr>
      <tr>
        <td><br/></td>
      </tr>
      <tr>
        <td width="50%" align="center" style="padding-left: 30px">
          <p>
            
            Macheros No.366-2 entre 3ra. y 4ta Z.C.,Ensenada, Bc, Mexico Tel(646)178-80-08
          </p>
        </td>
      </tr>
    </table>
  </div>
</body>
</html>