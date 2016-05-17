<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GCC115";


echo $_GET["id"];


try {
 	// CONECTA AO BANCO DE DADOS
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // BUSCANDO SE O USUARIO E SENHA EXISTE NO BANCO DE DADOS
    $stmt = $conn->prepare(" DELETE FROM Peca  WHERE id_peca = '$_GET[id]'"); 
    $stmt->execute();

    header("Location:consulta_estoque.php");

}
catch(PDOException $e) {
    echo $conn . "<br>" . $e->getMessage();
}





?>