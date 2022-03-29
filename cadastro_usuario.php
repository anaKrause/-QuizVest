<?php
session_start();
require_once __DIR__.'/conexao.php';

$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$celular = $_POST['celular'];
$senha = $_POST['senha'];
$confsenha = $_POST['confsenha'];
$login = $_POST['email'];

$busca = $conn->prepare("SELECT * FROM usuarios WHERE email='$email'");
$busca->execute();
$resultado = $busca->fetch(PDO::FETCH_ASSOC);

if($resultado < 1){


    if($senha == $confsenha){
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $sobrenome = filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
    $celular = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    $stmt = $conn->prepare("INSERT INTO usuarios(nome,sobrenome,email,cpf,celular,senha) VALUES (:nome, :sobrenome, :email, :cpf, :celular, :senha)");
    $stmt->bindValue(":nome", $nome);
    $stmt->bindValue(":sobrenome", $sobrenome);
    $stmt->bindValue(":email", $email);
    $stmt->bindValue(":cpf", $cpf);
    $stmt->bindValue(":celular", $celular);
    $stmt->bindValue(":senha", $senha);
    $stmt->execute();
    $var =0;
    $ins = $conn->prepare("INSERT INTO perguntasrespondidas(email, perguntas_biologia, perguntas_espanhol,perguntas_arte, perguntas_filosofia, perguntas_fisica, perguntas_geografia, perguntas_historia, perguntas_ingles, perguntas_literatura, perguntas_matematica, perguntas_portugues, perguntas_quimica, perguntas_sociologia) VALUES (:email, :perguntas_biologia, :perguntas_espanhol, :perguntas_arte, :perguntas_filosofia, :perguntas_fisica, :perguntas_geografia, :perguntas_historia, :perguntas_ingles, :perguntas_literatura, :perguntas_matematica, :perguntas_portugues, :perguntas_quimica, :perguntas_sociologia) ");
    $ins->bindValue(":email",$email);
    $ins->bindValue(":perguntas_biologia", $var);
    $ins->bindValue(":perguntas_espanhol", $var);
    $ins->bindValue(":perguntas_arte", $var);
    $ins->bindValue(":perguntas_filosofia", $var);
    $ins->bindValue(":perguntas_fisica", $var);
    $ins->bindValue(":perguntas_geografia", $var);
    $ins->bindValue(":perguntas_historia", $var);
    $ins->bindValue(":perguntas_ingles", $var);
    $ins->bindValue(":perguntas_literatura", $var);
    $ins->bindValue(":perguntas_matematica", $var);
    $ins->bindValue(":perguntas_portugues", $var);
    $ins->bindValue(":perguntas_quimica", $var);
    $ins->bindValue(":perguntas_sociologia", $var);
    $ins->execute();






    $user['login'] = $login;
    $user['senha'] = $senha;
    $_SESSION['user']= $user;
    header("Location:index.php");
    die();


}else if($resultado > 0 ){
    header("Location:entrar.php");
    }

}else if($resultado > 0 ){
    header("Location:entrar.php");
}
