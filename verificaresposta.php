<?php
session_start(); 
require_once __DIR__.'/conexao.php';
$resposta = $_POST['resposta'];
$id = $_GET['id'] ?? 1; 

$login = $_SESSION['user'];
$email = $login['login'];

$materia = $_SESSION['materia'];
$perguntas = $_SESSION['perguntas'];

$procurascore = $conn->prepare("SELECT * FROM usuarios WHERE email='$email'");
$procurascore->execute();
$score = $procurascore->fetch(PDO::FETCH_ASSOC);
$pontuacao = $score['score'];


$procuranome = $conn->prepare("SELECT * FROM usuarios WHERE email='$email'");
$procuranome->execute();
$nome = $procuranome->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>CSS Template</title>

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
        <a href=""><img class="ima" src="imagens/logoo.png"></a> 
            <input type="text" id="txtBusca" placeholder="Buscar..."/>
            <a href="#"> <img  class="lup" src="imagens/lupa.png" id="btnBusca" alt="Buscar"/></a>
            <a href="#"><img class ="notif" src="imagens/not.png" /></a>
            <a href="#"><img class="user" src="imagens/user.png"></a>
          </div>
       <div class="txt">
           <h1>Olá, <?=$nome['nome']?>!</h1>
       </div>
    </div>
</div>

</header>

<section>
 
  <article>
    

<?php

$cor_certa ="#AEED41";
$cor_errada = "#FF5F54";

$listarpergunta = $conn->prepare("SELECT * FROM $perguntas WHERE id='$id'");
$listarpergunta->execute();

$query_perguntas = "SELECT COUNT(id) AS qnt_perguntas FROM $perguntas";
$result_perguntas = $conn->prepare($query_perguntas);
$result_perguntas->execute();
$row_perguntas = $result_perguntas->fetch(PDO::FETCH_ASSOC);


echo '<div class="pagination">';
for($indice=1;$indice<=$row_perguntas['qnt_perguntas'];$indice++){
  if($id==$indice){
    echo '<a href="#" class="active">'.$indice.'</a>';
  }else{
    echo '<a href="#">'.$indice.'</a>';

  }

}
echo '</div>';


echo '<h1 class="questao">Questão '.$id.'</h1>';

    while($linha=$listarpergunta->fetch(PDO::FETCH_ASSOC)){
       $respostacerta = $linha['resposta'];
        if($linha["resposta"]==$resposta){
            echo "<p class='enunciado'>(<b>".$linha["edicaoEnem"]."</b>) ".$linha['enunciado']."</p>";
            if($linha['imagem'] <> NULL){
                echo'<img class="imagem" src="data:image/jpeg;base64,' . base64_encode( $linha['imagem'] ) . '" />';
            }
                
                echo "<p class='texto'>".$linha["texto"]."</p>"
                ."<p class='referencia'>".$linha["referencia"]."</p>"
                ."<p class='texto'>".$linha["texto2"]."</p>"
                ."<p class='referencia'>".$linha["referencia2"]."</p>"
                ."<p class ='pergunta'>".$linha["pergunta"]."</p>";


                $alternativas = "<div class='a";
                if($respostacerta=='A'){
                    $alternativas .=" resposta_correta";
                }else if($resposta=='A'){
                    $alternativas .=" resposta_errada";
                }
                $alternativas .="'><label class='sla' for='op1'>".$linha["A"]."</div><br>";
                
                $alternativas .= "<div class='a";
                if($respostacerta=='B'){
                    $alternativas .=" resposta_correta";
                }else if($resposta=='B'){
                    $alternativas .=" resposta_errada";
                }
                $alternativas .="'><label class='sla' for='op1'>".$linha["B"]."</div><br>";

                $alternativas .= "<div class='a";
                if($respostacerta=='C'){
                    $alternativas .=" resposta_correta";
                }else if($resposta=='C'){
                    $alternativas .=" resposta_errada";
                }
                $alternativas .="'><label class='sla' for='op1'>".$linha["C"]."</div><br>";

                $alternativas .= "<div class='a";
                if($respostacerta=='D'){
                    $alternativas .=" resposta_correta";
                }else if($resposta=='D'){
                    $alternativas .=" resposta_errada";
                }
                $alternativas .="'><label class='sla' for='op1'>".$linha["D"]."</div><br>";

                $alternativas .= "<div class='a";
                if($respostacerta=='E'){
                    $alternativas .=" resposta_correta";
                }else if($resposta=='E'){
                    $alternativas .=" resposta_errada";
                }
                $alternativas .="'><label class='sla' for='op1'>".$linha["E"]."</div><br>";

                echo $alternativas;


            $pontuacaoatualizada = $pontuacao+10;
            $atualizarscore = $conn->prepare("UPDATE usuarios SET score=:score WHERE email=:email");
            $atualizarscore->bindParam(':score',$pontuacaoatualizada);
            $atualizarscore->bindValue('email',$email);
            $atualizarscore->execute();
            



        }else{
            echo "<p class='enunciado'>(".$linha["edicaoEnem"].") ".$linha['enunciado']."</p>";
            if($linha['imagem'] <> NULL){
                echo'<img class="imagem" src="data:image/jpeg;base64,' . base64_encode( $linha['imagem'] ) . '" />';
            }
                
                echo "<p class='texto'>".$linha["texto"]."</p>"
                ."<p class='referencia'>".$linha["referencia"]."</p>"
                ."<p class='texto'>".$linha["texto2"]."</p>"
                ."<p class='referencia'>".$linha["referencia2"]."</p>"
                ."<p class ='pergunta'>".$linha["pergunta"]."</p>";

        
                $alternativas = "<div class='a";
                if($respostacerta=='A'){
                    $alternativas .=" resposta_correta";
                }else if($resposta=='A'){
                    $alternativas .=" resposta_errada";
                }
                $alternativas .="'><label class='sla' for='op1'>".$linha["A"]."</div><br>";
                
                $alternativas .= "<div class='a";
                if($respostacerta=='B'){
                    $alternativas .=" resposta_correta";
                }else if($resposta=='B'){
                    $alternativas .=" resposta_errada";
                }
                $alternativas .="'><label class='sla' for='op1'>".$linha["B"]."</div><br>";

                $alternativas .= "<div class='a";
                if($respostacerta=='C'){
                    $alternativas .=" resposta_correta";
                }else if($resposta=='C'){
                    $alternativas .=" resposta_errada";
                }
                $alternativas .="'><label class='sla' for='op1'>".$linha["C"]."</div><br>";

                $alternativas .= "<div class='a";
                if($respostacerta=='D'){
                    $alternativas .=" resposta_correta";
                }else if($resposta=='D'){
                    $alternativas .=" resposta_errada";
                }
                $alternativas .="'><label class='sla' for='op1'>".$linha["D"]."</div><br>";

                $alternativas .= "<div class='a";
                if($respostacerta=='E'){
                    $alternativas .=" resposta_correta";
                }else if($resposta=='E'){
                    $alternativas .=" resposta_errada";
                }
                $alternativas .="'><label class='sla' for='op1'>".$linha["E"]."</div><br>";

                echo $alternativas;


        }
        $id++;
        
        echo '<a class="proximo" href="./questionario.php?id='.$id.'"> PRÓXIMO </a>';

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