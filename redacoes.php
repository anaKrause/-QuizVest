<?php
session_start();
require_once __DIR__.'/conexao.php';


if(!isset($_SESSION['user'])){
    header('Location:./entrar.php');
    } 
    
$login = $_SESSION['user'];
$email = $login['login'];


$listarRedacoes = $conn->prepare("SELECT * FROM redacoes WHERE emailAluno='$email'");
$listarRedacoes->execute();

while($linha=$listarRedacoes->fetch(PDO::FETCH_ASSOC)){
   /* $id = $linha['id'];
    $nota = $linha['competencia1']+$linha['competencia2']+$linha['competencia3']+$linha['competencia4']+$linha['competencia5'];
    $perguntas_respondidas = $conn->prepare("UPDATE redacoes SET notaredacao=:notaredacao WHERE id=:id");
    $perguntas_respondidas->bindParam(':notaredacao', $nota);
    $perguntas_respondidas->bindValue(':id',$id);
    $perguntas_respondidas->execute();
    echo $linha['redacao'];
    */
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <form action='insert_redacao.php' method='post' >
        
        </form>
</body>
</html>
