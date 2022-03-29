<?php
session_start();

$material = $_POST['materia'];

echo $material;

if($material=="quimica"){
    $_SESSION['materia']=$material;
    $_SESSION['perguntas']="perguntas_quimica";
}else if($material=="biologia"){
    $_SESSION['materia']=$material;
    $_SESSION['perguntas']="perguntas_biologia";
}else if($material=="fisica"){
    $_SESSION['materia']=$material;
    $_SESSION['perguntas']="perguntas_fisica";
}else if($material=="matematica"){
    $_SESSION['materia']=$material;
    $_SESSION['perguntas']="perguntas_matematica";
}else if($material=="redacao"){
    $_SESSION['materia']=$material;
    $_SESSION['perguntas']="redacoes";
}else if($material=="portugues"){
    $_SESSION['materia']=$material;
    $_SESSION['perguntas']="perguntas_portugues";
}else if($material=="literatura"){
    $_SESSION['materia']=$material;
    $_SESSION['perguntas']="perguntas_literatura";
}else if($material=="arte"){
    $_SESSION['materia']=$material;
    $_SESSION['perguntas']="perguntas_arte";
}else if($material=="ingles"){
    $_SESSION['materia']=$material;
    $_SESSION['perguntas']="perguntas_ingles";
}else if($material=="espanhol"){
    $_SESSION['materia']=$material;
    $_SESSION['perguntas']="perguntas_espanhol";
}else if($material=="gegrafia"){
    $_SESSION['materia']=$material;
    $_SESSION['perguntas']="perguntas_geografia";
}else if($material=="historia"){
    $_SESSION['materia']=$material;
    $_SESSION['perguntas']="perguntas_historia";
}else if($material=="filosofia"){
    $_SESSION['materia']=$material;
    $_SESSION['perguntas']="perguntas_filosofia";
}else if($material=="sociologia"){
    $_SESSION['materia']=$material;
    $_SESSION['perguntas']="perguntas_sociologia";
}
header("Location:.\questionario.php");