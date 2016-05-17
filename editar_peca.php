<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GCC115";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

     //echo $_POST['id']; 
 try {
 	// CONECTA AO BANCO DE DADOS
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ATUALIZANDO OS DADOS DA PECA
    $stmt = $conn->prepare(" UPDATE Peca 
                             SET nome_peca='$_POST[peca]', preco='$_POST[preco]', quantidade_estoque='$_POST[quantidade]', fornecedor='$_POST[fornecedor]'   
                             WHERE id_peca = '$_POST[id]' "); 
    $stmt->execute();

    // Retorna a pagina consulta_estoque
    header("Location:consulta_estoque.php");

    }
catch(PDOException $e)
    {
    echo $conn . "<br>" . $e->getMessage();
    }

}
    ?>