<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
  <title> .: Auto Mais .: </title>
   <!-- BOOTSTRAP -->
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

      <style>
          .btn-lg { margin-top: 10px; }
          h1,h3 { text-align: center;  color: #f4511e; }
      </style>

</head>


<body>

<div class="container">
    <div class="row">
      <a href="logout.php" class="btn btn-danger btn-md" style="margin-top:10px; float:right;">Logout</a>
      <a href="menu.php" class="btn btn-danger btn-md" style="float:right; margin-top:10px; margin-right:10px;">Voltar ao Menu Principal</a>
      <img src= "0-auto.jpg" width="150" alt="automais" class="img-responsive center-block" style="margin-top:40px;" />
    </div>
</div>


 
<h1> CONSULTA - PEDIDOS  </h1> <br />

<div class="container">

<!-- BOTAO DE BUSCA -->
  <button type="button" class="btn btn-danger")>
  <span class="glyphicon glyphicon-search"></span> Buscar </button> 

  <!-- Botao de Inserir Peca -->
  <a href="fazer_pedido.php" class="btn btn-danger" >Fazer Pedido</a>
  <br /><br />

<!-- TABELA -->
<table class="table table-striped table-bordered">
  <tr>
    <th style="width:150px;">Numero do Pedido</th>
    <th>Funcionario</th>
    <th style="width:350px;">Peca(s)</th>    
    <th>Status</th>   
  </tr> 
  <tr>
  	<td>000001</td>
  	<td>Ana</td>
  	<td>Pneu r15, Pirelli, 5 unidades <br>
  		mola t25, Magnet Marelli, 3 unidades
  	</td>
  	<td>Aguardando</td>
  	<td style="width:200px;"><button type="button" onclick="">Alterar Status</button>
	    <button type="button" onclick="">Cancelar</button>
	</td>
  </tr>
  <tr>
  	<td>000002</td>
  	<td>Felipe</td>
  	<td>Motor Ford 1.6, Ford, 1 unidade</td>
  	<td>Aceito</td>
  	<td><button type="button" onclick="">Alterar Status</button>
	    <button type="button" onclick="">Cancelar</button>
	</td>
  </tr>
  <tr>
  	<td>000004</td>
  	<td>Ana</td>
  	<td>Amortecedor f16, Magneti Marelli,2 unidades</td>
  	<td>Entregue</td>
  	<td><button type="button" onclick="">Alterar Status</button>
	</td>
  </tr>
  <tr>
  	<td>000005</td>
  	<td>Paulo</td>
  	<td>Carburador, Bosch, 10 unidades <br>
  		mola t25, Bosch, 3 unidades
  	</td>
  	<td>Recusado</td>
  	<td><button type="button" onclick="">Alterar Status</button>
	</td>
  </tr>
  <tr>
  	<td>000006</td>
  	<td>Paulo</td>
  	<td>Pneu r16, Pirelli, 4 unidades</td>
  	<td>Cancelado</td>
  	<td><button type="button" onclick="">Alterar Status</button>
	</td>
  </tr>
  
</table>

</div>


</body>
</html>