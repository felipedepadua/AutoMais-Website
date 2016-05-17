<?php session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GCC115";

 try {
  // CONECTA AO BANCO DE DADOS
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // BUSCANDO TODAS AS PECAS PARA EXIBIR
    $stmt = $conn->prepare(" SELECT P.id_peca, P.nome_peca, P.preco, P.quantidade_estoque, F.nome_fornecedor  
                             FROM Peca AS P, Fornecedor AS F
                             WHERE P.fornecedor=F.id_fornecedor"); 
    $stmt->execute();

    $result = $stmt->fetchAll(); // guarda em 'result' todas as linhas(pecas) de resultado da selecao
    $count = $stmt->rowCount();  // conta o numero de linhas de resultado do query
    //echo $count . "<br>";
    //print_r($result);

    // FORNECEDORES PARA MOSTRAR NO DROPDOWN MENU QUANDO EDITAR UM PECA
    $forn = $conn->prepare("SELECT id_fornecedor,nome_fornecedor  FROM Fornecedor"); //seleciona todos fornecedores
    $forn->execute();
    $result_f = $forn->fetchAll(); // guarda em 'result_f' todas as linhas(forncedores) de resultado da selecao

  }
  catch(PDOException $e)  {
    echo $conn . "<br>" . $e->getMessage();
  }


function imprime_estoque(){


    $temp = $GLOBALS['result'];
    for ($x = 0; $x < $GLOBALS['count']; $x++){ // Itera 'numero de pecas' vezes 
             echo  "<tr>";
             echo  "<td>" . $temp[$x][1] . "</td>"; //  1: coluna do nome da peca
             echo  "<td>" . $temp[$x][2] . "</td>"; //  2: coluna do preco 
             echo  "<td>" . $temp[$x][3] . "</td>"; //  3: coluna da  quantidade
             echo  "<td>" . $temp[$x][4] . "</td>"; //  4: coluna do fornecedor
             echo  '<td id="'.$temp[$x][0].'" style="width:34px;" 
                    onclick=exibir("Form_peca",this.id,"'.$temp[$x][1].'","'.$temp[$x][2].'","'.$temp[$x][3].'","'.$temp[$x][4].'")>
                    <a href="#"> <span class="glyphicon glyphicon-edit">Editar</span> </a> </td>';
             echo  '<td id="'.$temp[$x][0].'" style="width:34px;" onclick="" > 
                    <a href="excluir_peca.php?id='.$temp[$x][0].'"> <span class="glyphicon glyphicon-remove">Excluir</span> </a> </td>';
             echo  "</tr>";
          }
}


function lista_fornecedor(){ //mostra a lista de fornecedores no dropdown menu pra editar.

    $i=0; //contador de linha
    $temp = $GLOBALS['result_f'];
    foreach ($temp as $info) {
      echo '<option value="'.$temp[$i][0].'">Fornecedor ' . $temp[$i][1] . '</option>';
      $i++;
    } 
}


function editar_fornecedor(){ //mostra a lista de fornecedores no dropdown menu pra editar.

    $i=0; //contador de linha
    $temp = $GLOBALS['result_f'];
    foreach ($temp as $info) {
      echo '<option id="'.$temp[$i][1].'"  value="'.$temp[$i][0].'">Fornecedor ' . $temp[$i][1] . '</option>';
      $i++;
    } 
}


?>

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


<h1> CONSULTA - ESTOQUE </h1>

<div class="container">


<!-- FORMULARIO PARA BUSCA (invisivel - so aparece quando clicar em 'buscar') -->
<div id="Form_busca" class="jumbotron" style="display:none;">

<button type="button" class="close" onclick="document.getElementById('Form_busca').style.display='none';">X</button>   

<h4>FILTRE A BUSCA PELOS SEGUINTES CAMPOS: </h4><br />      

<form method="post" action="busca_peca.php"> 
    
<div class="form-group">
  <label>Digite o numero de ID da Peça (caso souber):</label>
  <input type="number" min="1" max="1000000" name="id_busca" class="form-control">
</div>

<div class="form-group">
  <label>Digite o nome da Peça:</label>
  <input  name="peca_busca" class="form-control">
</div>

<div class="form-group">
  <label>Escolha o nome do Fornecedor:</label>
  <select name="forn_busca" class="form-control">
       <option value="" disabled="disabled" selected></option>
       <?php lista_fornecedor();?>
  </select>
</div>

<button type="submit" class="btn btn-primary">Executar Busca</button>

</form>

</div>


<!-- FORMULARIO PARA EDICAO (invisivel - so aparece quando clicar em 'editar') -->
<div id="Form_peca" class="jumbotron" style="display:none;">

<button type="button" class="close" onclick="document.getElementById('Form_peca').style.display='none';">X</button> 

<h4>ATUALIZE OS CAMPOS DA PEÇA</h4>        

<form method="post" action="editar_peca.php">

<div class="form-group">
  <label>ID da Peça:</label>
  <input id="id_f"  name="id" class="form-control" readonly="readonly">
</div>

<div class="form-group">
  <label>Peça:</label>
  <input id="peca_f"  name="peca" class="form-control" required>
</div>

<div class="form-group">
  <label>Quantidade:</label>
  <input type="number" min="1" max="1000" id="quantidade_f" name="quantidade" class="form-control"required>
</div>

<div class="form-group">
  <label>Preço:</label>
  <input type="number" step="0.01" min="0.01" max="3000.00" id="preco_f" name="preco" class="form-control" required>
</div>

<div class="form-group">
  <label>Fornecedor:</label>
  <select id="forn_f" name="fornecedor" class="form-control" required>
       <option value="" disabled="disabled" selected></option>
       <?php editar_fornecedor();?>
  </select>
</div>

<button type="submit" class="btn btn-primary">Salvar edição</button>

</form>

</div>


<!-- BOTAO DE BUSCA -->
  <button type="button" class="btn btn-danger" onclick=exibir("Form_busca","")>
  <span class="glyphicon glyphicon-search"></span> Buscar </button> 

  <!-- Botao de Inserir Peca -->
  <a href="inserir_peca.php" class="btn btn-danger" >Inserir Peca</a>
  <br /><br />

<!-- TABELA -->
<table class="table table-striped table-bordered">
  <tr>
    <th>Peca</th>
    <th>Preco</th>
    <th>Quantidade</th>    
    <th>Fornecedor</th>   
  </tr> 
  <?php imprime_estoque(); ?>
</table>

</div>


<script src="myscript.js"></script>
</body>
</html>