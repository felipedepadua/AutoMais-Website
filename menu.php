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
      <img src= "0-auto.jpg" width="150" alt="automais" class="img-responsive center-block" style="margin-top:40px;" />
    </div>
</div>


<h1> SEJA BEM VINDO </h1>
<?php
  //echo "ADM: " . $_SESSION['adm'] . "<br>";
  if($_SESSION['adm'] == 0) { //False 
          echo "<h3> Vendedor(a) </h3>"; 
  } 
  else {  echo "<h3> Gerente do Deposito </h3>"; }
  ?>

<div class="container" style="margin-top:80px";>  

    <div class="row">
        <div class="col-md-6">
            <a href="consulta_estoque.php" class="btn btn-danger btn-lg" style="display: block; width: 100%;">CONSULTAR ESTOQUE</a>
            <a href="inserir_peca.php" class="btn btn-danger btn-lg" style="display: block; width: 100%;">INSERIR PECAS</a> 
            <?php checar_adm_coluna1(); ?> <!-- chama a funcao  -->         
        </div>
 
       <div class="col-md-6">
            <a href="consulta_pedido.php" class="btn btn-danger btn-lg" style="display: block; width: 100%;">CONSULTAR LISTA DE PEDIDOS</a>
            <a href="fazer_pedido.php" class="btn btn-danger btn-lg" style="display: block; width: 100%;">FAZER PEDIDOS</a>
            <?php checar_adm_coluna2(); ?> <!-- chama a funcao  -->                
       </div>
    </div>

</div>

<?php
  function checar_adm_coluna1() {
      if ($_SESSION['adm'] != 0){ // eh ADM(gerente do deposito)
          echo '<a href="manter_contas.php" class="btn btn-warning btn-lg" style="display: block; width: 100%;">CRIAR E EXCLUIR CONTAS</a>';
          echo '<a href="manter_fornecedores.php" class="btn btn-warning btn-lg" style="display: block; width: 100%;">CRIAR OU EXCLUIR FORNECEDOR</a>';
      }
  }


  function checar_adm_coluna2() {
      if ($_SESSION['adm'] != 0){ // eh ADM(gerente do deposito)
          echo '<a href="manter_lojas.php" class="btn btn-warning btn-lg" style="display: block; width: 100%;">CRIAR OU EXCLUIR LOJA</a>';
      }
  }


?>



<script src="myscript.js"></script>
</body>
</html>