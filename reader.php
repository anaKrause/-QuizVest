<?php
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_reader.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <title>Document</title>
</head>

<body>
    <header>
        <div id="cabecalho">  
            <div class="menu">
                <div id="nTexto">
                <a href="index.php"><img class="ima" src="imagens/logoo.png"></a> 
                    <input type="text" id="txtBusca" placeholder="Buscar..."/>
                    <a href="#"> <img  class="lup" src="imagens/lupa.png" id="btnBusca" alt="Buscar"/></a>
                    <a href="#"><img class ="notif" src="imagens/not.png" /></a>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="user_btn"><img class="user" src="imagens/user.png"></a>
                        <div class="dropdown-content">
                        <a href="./perfil.php">Conta</a>
                        <a href="./sair.php">Sair</a>
                        </div>
                        </li>
                  </div>
               <div class="txt">
                   <h1>Olá, <?=$nome['nome']?>!</h1>
               </div>
            </div>
        </div>
    </header>
</body>
</html>