<?php
session_start();
require_once __DIR__.'/conexao.php';

$login = $_POST['login'];
$senha = $_POST['senha'];


$usuario = $conn->prepare("SELECT * FROM usuarios WHERE email='$login'");
$usuario->execute();
$logar = $usuario->fetch(PDO::FETCH_ASSOC);


  

    if($senha == $logar['senha']){
        $user['login'] = $login;
        $user['senha'] = $senha;
        $_SESSION['user']= $user;
        header("Location:index.php");
        die(); 
    
}else{
    $_SESSION['lg'] = "Usuário ou Senha não conferem";
    header("Location:entrar.php");
    die();
}




