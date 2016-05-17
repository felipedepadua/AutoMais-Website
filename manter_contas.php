<?php session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GCC115";

 try {
  // CONECTA AO BANCO DE DADOS
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // LOJAS PARA MOSTRAR NO DROPDOWN MENU QUANDO CRIAR UMA CONTA
    $loja = $conn->prepare("SELECT id_loja,cidade,endereco  FROM Loja"); 
    $loja->execute();
    $result_l = $loja->fetchAll(); // guarda em 'result' todas as pecas  


    // CONTAS PARA MOSTRAR PARA EXCLUIR [exceto a dele]
    $func = $conn->prepare("SELECT cpf,nome,usuario  FROM Funcionario"); 
    $func->execute();
    $result_f = $func->fetchAll(); // guarda em 'result' todas as pecas 


      // APAGA A CONTA NESSA MESMA PAGINA
      if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            $apaga = $conn->prepare(" DELETE FROM Funcionario  WHERE cpf = '$_POST[cpf]'"); 
            $apaga->execute();

      header("Location:manter_contas.php");
    }

  }
  catch(PDOException $e)  {
    echo $conn . "<br>" . $e->getMessage();
  }


function lista_lojas(){ 

    $i=0; //contador de linha
    $temp = $GLOBALS['result_l'];
    foreach ($temp as $a) {
      echo '<option value="'.$temp[$i][0].'">' . $temp[$i][1] . " - local: " . $temp[$i][2] . '</option>';
      $i++;
    } 
}


function lista_contas(){ 

    $i=0; //contador de linha
    $temp = $GLOBALS['result_f'];
    foreach ($temp as $a) {
      if($temp[$i][2] != $_SESSION['user']){
        echo '<option value="'.$temp[$i][0].'">' . $temp[$i][1] . " - usuario: " . $temp[$i][2] . '</option>';
      }
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
        .container-fluid { padding: 30px 25px; }
        .bg-grey { background-color: #f6f6f6; padding: 20px 40px; border-radius: 10px; }
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


 
<h1> MANTER CONTAS  </h1> <br />

<div class="container">

    <div class="row">
        <div class="col-md-5 bg-grey">

          <h3>Nova Conta</h3> <br />

          <form id="criar_conta" action="inserir_conta.php" method="post">  <!-- FORMULARIO PARA CRIAR USUARIO -->

              <div class="form-group">
                <label>Nome do Funcionario:</label>
                <input type="text" class="form-control" name="nome" placeholder="Digite o Nome" required>
              </div>

              <div class="form-group">
                <label>Nome do Usuario:</label>
                <input type="text" class="form-control" name="usuario" placeholder="Digite o Usuario" required>
              </div>

              <div class="form-group">
                <label>Senha:</label>
                <input type="password" class="form-control" name="senha" placeholder="Digite a senha" required>
              </div>

              <div class="form-group">
                <label>CPF:</label>
                <input type="text" maxlength="11" class="form-control" name="cpf" placeholder="Digite o CPF" required>
              </div>

              <div class="form-group">
                <label>Tipo de Conta:</label>
                <select name="adm" class="form-control" required>
                    <option value="" disabled="disabled" selected></option>
                    <option value="0">Vendedor</option>
                    <option value="1">ADM</option>
                </select>
              </div>

              <div class="form-group">
                <label>Selecione uma loja:</label>
                <select name="loja" class="form-control" required>
                    <option value="" disabled="disabled" selected></option>
                    <?php lista_lojas(); ?>
                </select>
              </div>

              <button type="submit" class="btn btn-danger btn-lg" style="display: block; width: 100%;">Criar</button>
                                  
          </form>
        
        </div>

      <div class="col-md-2"></div>

 
       <div class="col-md-5 bg-grey">

          <h3>Excluir Conta</h3> <br /><br /><br />
       
          <form id="alter_conta" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">  <!-- FORMULARIO PARA EXCLUIR USUARIO --> 

              <div class="form-group">
                <label>Selecione a conta:</label>
                <select name="cpf" class="form-control" required>
                    <option value="" disabled="disabled" selected></option>
                    <?php lista_contas(); ?>
                </select>
              </div>

              <br /><br />
              <button type="submit" class="btn btn-danger btn-lg" style="display: block; width: 100%;">Excluir</button>
                                  
          </form>     

       </div>

    </div>

</div>

</body>
</html>