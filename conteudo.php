<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style_conteudo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>

</body>
</html>

<?php
session_start();
require_once __DIR__.'/conexao.php';
if(!isset($_SESSION['user'])){
    header('Location:./entrar.php');
    } 
$indice = 0;
$indicesubconteudo = 0;
$materia = $_POST['materia'];
//$materia = 'biologia';
$quest = "perguntas_";
$quest.=$materia;
$buscamaterial = $conn->prepare("SELECT DISTINCT conteudo FROM conteudos WHERE disciplina='$materia'");
$buscamaterial->execute();
while($resultado = $buscamaterial->fetch(PDO::FETCH_ASSOC)){
    $indice++;
    $conteudo = $resultado['conteudo'];
    echo "<selection><details> <summary>".$indice.".   ".$conteudo."</summary><ul>";


    $buscasubconteudo = $conn->prepare("SELECT subconteudo FROM conteudos WHERE conteudo='$conteudo'");
    $buscasubconteudo->execute();
    while($subconteudo = $buscasubconteudo->fetch(PDO::FETCH_ASSOC)){
        $indicesubconteudo++;
        echo '<li>'.$indice.'.'.$indicesubconteudo.'. '.$subconteudo['subconteudo'].'</li>';
    }
    echo '<li>'.'<a href="redireciona_pg.php">Questinário</a>'
    .'</ul>'.'</details></selection>';



    $_SESSION['perguntas'] = $quest;
    $indicesubconteudo = 0;


}

?>


