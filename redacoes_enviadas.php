<?php
session_start();

require_once __DIR__.'/conexao.php';
///*
if(!isset($_SESSION['user'])){
    header('Location:./entrar.php');
    }   
$login = $_SESSION['user'];
$email = $login['login'];

$procuranome = $conn->prepare("SELECT * FROM usuarios WHERE email='$email'");
$procuranome->execute();
$nome = $procuranome->fetch(PDO::FETCH_ASSOC);


$procuraredacoes = $conn->prepare("SELECT * FROM redacoes WHERE emailAluno='$email'");
$procuraredacoes->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_redacoes_enviadas.css">
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
        <table class="temas">
            <tr><th>REDAÇÕES ENVIADAS</th><th></th></tr>
            <?php
            while($temas = $procuraredacoes->fetch(PDO::FETCH_ASSOC)){
                echo '<tr class="p2"><td class="p2"><a href="visualizar_redacao.php?id='.$temas['id'].'">'.$temas['tema'].'</a></td><td class="p2"><b>'.$temas['notaredacao'].'</b></td></tr>';
            }

            ?>
            </table>
    </div>
</section>
</body>
</html>