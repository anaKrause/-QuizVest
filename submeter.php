<?php
session_start();
require_once __DIR__.'/conexao.php';

$login = $_SESSION['user'];
$email = $login['login'];
$tema = $_POST['tema'];
$texto = $_POST['redacaoaluno'];


$stmt = $conn->prepare("INSERT INTO redacoes (emailAluno, tema, redacao) VALUES (:email, :tema, :redacao)");
$stmt->bindValue(":email", $email);
$stmt->bindValue(":tema", $tema);
$stmt->bindValue(":redacao", $texto);
$stmt->execute();

header('Location: ./redacoes_enviadas.php');
?>