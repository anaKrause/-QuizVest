<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location:./entrar.php');
        }
    require_once __DIR__.'/conexao.php';


    $perguntas = $_SESSION['perguntas'];
    $login = $_SESSION['user'];
    $email = $login['login'];

    $id = $_GET['id'] ?? 1; 
     
    $listarpergunta = $conn->prepare("SELECT * FROM $perguntas WHERE id='$id'");
    $listarpergunta->execute();


    $query_perguntas = "SELECT COUNT(id) AS qnt_perguntas FROM $perguntas";
    $result_perguntas = $conn->prepare($query_perguntas);
    $result_perguntas->execute();
    $row_perguntas = $result_perguntas->fetch(PDO::FETCH_ASSOC);
    

    $estado_questionario = $conn->prepare("SELECT * FROM perguntasrespondidas WHERE email='$email'");
    $estado_questionario->execute();
    $estado_perguntas = $estado_questionario->fetch(PDO::FETCH_ASSOC);

    $selecionausuario = $conn->prepare("SELECT * FROM usuarios WHERE email='$email'");
    $selecionausuario->execute();
    $usuario = $selecionausuario->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Questionário</title>

<link rel="stylesheet" href="style_questionario.css"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

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
            <a href="#"><img class="user" src="imagens/user.png"></a>
          </div>
       <div class="txt">
           <h1>Olá, <?=$usuario['nome']?>!</h1>
       </div>
    </div>
</div>

</header>

<section>
 
<article> 
  
<?php
   // if($estado_perguntas[$perguntas]==1){
   //     header("Location:.\index.php");
   // }
   echo '<div class="pagination">';
    for($indice=1;$indice<=$row_perguntas['qnt_perguntas'];$indice++){
      if($id==$indice){
        echo '<a href="#" class="active">'.$indice.'</a>';
      }else{
        echo '<a href="#">'.$indice.'</a>';

      }

    }
    echo '</div>';

    if($id > $row_perguntas['qnt_perguntas']){
        $var =1;
        $perguntas_respondidas = $conn->prepare("UPDATE perguntasrespondidas SET $perguntas=:perguntas WHERE email=:email");
        $perguntas_respondidas->bindParam(':perguntas', $var);
        $perguntas_respondidas->bindValue('email',$email);
        $perguntas_respondidas->execute();

        header("Location:index.php");
    }
    echo '<h1 class="questao">Questão '.$id.'</h1>';
    echo '<form class="respostas" action="verificaresposta.php?id='.$id.'" method="post">';

    while($linha=$listarpergunta->fetch(PDO::FETCH_ASSOC)){
        //var_dump($linha['imagem']);

        echo "<p class='enunciado'>(<b>".$linha["edicaoEnem"]."</b>) ".$linha['enunciado']."</p>";

        if($linha['imagem'] <> NULL){
        echo'<img class="imagem" src="data:image/jpeg;base64,' . base64_encode( $linha['imagem'] ) . '" />';
    }
        
        echo "<p class='texto'>".$linha["texto"]."</p>"
        ."<p class='referencia'>".$linha["referencia"]."</p>"
        ."<p class='texto'>".$linha["texto2"]."</p>"
        ."<p class='referencia'>".$linha["referencia2"]."</p>"
        ."<p class ='pergunta'>".$linha["pergunta"]."</p>"
        ."<div class='a'><input type='radio' id='op1' name='resposta' value='A'><label class='sla' for='op1'>".$linha["A"]."</label></div><br>"
        ."<div class='a'><input type='radio' id='op2' name='resposta' value='B'><label class='sla' for='op2'>".$linha["B"]."</label></div><br>"
        ."<div class='a'><input type='radio' id='op3' name='resposta' value='C'><label class='sla' for='op3'>".$linha["C"]."</label></div><br>"
        ."<div class='a'><input type='radio' id='op4' name='resposta' value='D'><label class='sla' for='op4'>".$linha["D"]."</label></div><br>"
        ."<div class='a'><input type='radio' id='op5' name='resposta' value='E'><label class='sla' for='op5'>".$linha["E"]."</label></div><br>"
        ."<button class='btn' type='submit'>CONFERIR</button>";
   
    
    }
    
?>
</form>

</article>

</section>

<footer>
  <p>Footer</p>
</footer>

</body>
</html>