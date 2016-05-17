<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GCC115";


	// CRIANDO A TABELA 'GCC115' (SE EXISTIR, SO ACESSA)
try {
    $conn = new PDO("mysql:host=$servername;dbname=mysql", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    // use exec() because no results are returned
    $conn->exec($sql);
    //echo "Database created successfully<br>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }


// ----- SQL PARA CRIAR AS TABELAS -----

try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	// CRIANDO A TABELA FORNECEDOR (SE EXISTIR, NAO FAZ NADA)
    $sql = "CREATE TABLE IF NOT EXISTS Fornecedor (
    id_fornecedor INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    nome_fornecedor VARCHAR(45) NOT NULL, 
    email VARCHAR(45),
    endereco VARCHAR(60) NOT NULL
    )";
    // exec() para executar a query
    $conn->exec($sql);


	// CRIANDO A TABELA PECA (SE EXISTIR, NAO FAZ NADA)
    $sql = "CREATE TABLE IF NOT EXISTS Peca (
    id_peca INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    nome_peca VARCHAR(45) NOT NULL,
    preco FLOAT(2) NOT NULL,
    quantidade_estoque INT NOT NULL,
    fornecedor INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (fornecedor) REFERENCES Fornecedor(id_fornecedor)  
    	    ON DELETE CASCADE
    		ON UPDATE CASCADE
    )";
    // exec() para executar a query
    $conn->exec($sql);


	// CRIANDO A TABELA LOJA (SE EXISTIR, NAO FAZ NADA)
    $sql = "CREATE TABLE IF NOT EXISTS Loja (
    id_loja INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    cidade VARCHAR(45) NOT NULL,
    endereco VARCHAR(45) NOT NULL,
    telefone INT(11) UNSIGNED
    )";
    // exec() para executar a query
    $conn->exec($sql);


	// CRIANDO A TABELA  FUNCIONARIO (SE EXISTIR, NAO FAZ NADA)
    // BOOLEAN: These types are synonyms for TINYINT(1). A value of zero is considered FALSE. Nonzero values are considered TRUE
    $sql = "CREATE TABLE IF NOT EXISTS Funcionario (
    cpf CHAR(11) PRIMARY KEY, 
    nome VARCHAR(45) NOT NULL,
    usuario VARCHAR(45) NOT NULL,
    senha VARCHAR(45) NOT NULL,
    adm BOOLEAN NOT NULL,  
    loja INT(6) UNSIGNED,
    UNIQUE (usuario),
    FOREIGN KEY (loja) REFERENCES Loja(id_loja)  
    	    ON DELETE CASCADE
    		ON UPDATE CASCADE
    )";
    // exec() para executar a query
    $conn->exec($sql);


	// CRIANDO A TABELA PEDIDO (SE EXISTIR, NAO FAZ NADA)
    $sql = "CREATE TABLE IF NOT EXISTS Pedido (
    id_pedido INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    status VARCHAR(25) NOT NULL,
    funcionario CHAR(11) NOT NULL,
    FOREIGN KEY (funcionario) REFERENCES Funcionario(cpf)  
    	    ON DELETE NO ACTION
    		ON UPDATE NO ACTION
    )";
    // exec() para executar a query
    $conn->exec($sql);


	// CRIANDO A TABELA VENDA (SE EXISTIR, NAO FAZ NADA)
    $sql = "CREATE TABLE IF NOT EXISTS Venda (
    peca INT(6) UNSIGNED, 
    pedido INT(6) UNSIGNED, 
    quantidade INT(4) UNSIGNED,
    PRIMARY KEY (peca, pedido),
    FOREIGN KEY (peca) REFERENCES Peca(id_peca)  
    	    ON DELETE CASCADE
    		ON UPDATE CASCADE,
    FOREIGN KEY (pedido) REFERENCES Pedido(id_pedido)  
    	    ON DELETE CASCADE
    		ON UPDATE CASCADE
    )";
    // exec() para executar a query
    $conn->exec($sql);



    //echo "Tables created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }


$conn = null;
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
</head>

<body>



<!-- IMPRIMINDO MENSAGEM DE SUCESSO -->
<div id="msg-bd" class="alert alert-success">
      <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
      <span class="sr-only">Sucesso!:</span>
      Banco de dados criado <br>.
</div>

<h4>Olá. O banco de dados foi criado. Agora você pode acessar o website e testá-lo.</h4><br />
<a href="login.php" class="btn btn-danger btn-lg"> &lt&lt Ir para o Site &gt&gt</a>


<script src="myscript.js"></script>
</body>
</html>
