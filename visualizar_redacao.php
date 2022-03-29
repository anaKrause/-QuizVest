<?php
session_start();

require_once __DIR__.'/conexao.php';
///*
if(!isset($_SESSION['user'])){
    header('Location:./entrar.php');
    }   
$login = $_SESSION['user'];
$email = $login['login'];

$id = $_GET['id'];
$procuranome = $conn->prepare("SELECT * FROM usuarios WHERE email='$email'");
$procuranome->execute();
$nome = $procuranome->fetch(PDO::FETCH_ASSOC);


$procuraredacao = $conn->prepare("SELECT * FROM redacoes WHERE id='$id'");
$procuraredacao->execute();
$listaredacao = $procuraredacao->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_visualizacao_redacao.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <title>Redações</title>
</head>
<body>
    <?php require './reader.php'?>
    <div class="opcao column side">
        <p class="destaque">&nbsp; Meu painel &nbsp;</p>
        <ul>
        <li class="menu_lateral"><a href="redacao.php">Redações</a></li>
        <li class="menu_lateral"><a href="#">Apostilas</a></li>
        <li class="menu_lateral"><a href="#">Plano de estudo</a></li>
        <li class="menu_lateral"><a href="#">Simulados</a></li>
        <li class="menu_lateral"><a href="#">Meu desempenho</a></li>
        </ul>
    </div>
<section>
    <div class="redac"><p>Redações</p></div>
    <div class="espaco">
    <h3><?=$listaredacao['tema']?></h3>
    <div class="pontuação nota"><p id="pont"><?=$listaredacao['notaredacao']?></p></div>
    <p><?=$listaredacao['redacao']?></p>

    <table class="competencias">
        <tr>
            <td><p>Competência 1</p></td>
            <td><p>Competência 2</p></td>
            <td><p>Competência 3</p></td>
            <td><p>Competência 4</p></td>
            <td><p>Competência 5</p></td>
        </tr>
        <tr>
            <td><div class="pontuação c"><p id="co"><?=$listaredacao['competencia1']?></p></div></td>
            <td><div class="pontuação c"><p id="co"><?=$listaredacao['competencia2']?></p></div></td>
            <td><div class="pontuação c"><p id="co"><?=$listaredacao['competencia3']?></p></div></td>
            <td><div class="pontuação c"><p id="co"><?=$listaredacao['competencia4']?></p></div></td>
            <td><div class="pontuação c"><p id="co"><?=$listaredacao['competencia5']?></p></div></td>
        </tr>

    </div>
</section>
</body>
</html>