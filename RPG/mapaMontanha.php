<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title> Os 4 Aventureiros </title>
  
  <script type='text/javascript' src='jquery.js'></script>
  
  <style type='text/css'>
html, body {
  padding: 0;
  margin: 0;
}
#plane {
    height: 30px;
	width: 30px;
    position:absolute;
    top:0;
    left:0;
}
#conteudo{
	float: left;
	column-count: 5;
	margin: 0;
	padding: 0;
	background-image: url("montanha.png");
	height: 600px;
	width: 600px;
}

ul{
	list-style-type:none;
	padding:0; 
	margin:0;
}
#dialogo{
	float:left;
	margin:0px;
	max-width: 500px;
	max-height: 300px;
	border: 10px  groove  #c1bebe;
}
#prox-link{
	float: right;
}


  </style>

<script type="text/javascript">
var selecionado = "<?php echo $_POST['escolha']; ?>";
var iP,jP;
var guerreiroE = "<?php echo $_POST['guerreiroE']; ?>";
var ladraoE = "<?php echo $_POST['ladraoEE']; ?>";
var bardoE = "<?php echo $_POST['bardoE']; ?>";
var feiticeiraE = "<?php echo $_POST['feiticeiraE']; ?>";
var vila = "<?php echo $_POST['vila']; ?>";
var montanha = "<?php echo $_POST['montanha']; ?>";
var floresta = "<?php echo $_POST['floresta']; ?>";
var missao = "<?php echo $_POST['missao']; ?>";
var movimenta = 1;
var direcao = 40;
var spawn = "<?php echo $_POST['spawn']; ?>";
var tileMap = [
 [1,1,1,1,1,1,3,3,3,3,3,3,3,3,3,3,1,1,1,1],
 [1,1,1,1,1,3,3,3,3,3,3,3,3,3,1,3,1,1,1,1],
 [1,1,1,1,1,3,3,3,3,3,3,3,3,3,3,3,1,1,1,1],
 [1,1,1,1,3,1,1,1,1,1,1,1,1,3,3,1,1,1,1,1],
 [1,1,1,1,3,3,3,3,3,3,3,3,3,3,3,3,3,3,1,1],
 [1,1,1,1,3,3,3,3,1,3,3,3,3,3,3,3,3,3,3,1],
 [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,3,3,1],
 [1,1,1,1,1,3,3,3,3,1,1,1,1,1,1,1,1,3,3,1],
 [1,1,1,1,1,3,3,3,3,3,3,1,1,1,1,1,1,3,3,1],
 [1,1,1,1,1,3,3,3,1,3,3,1,1,1,1,1,1,3,3,1],
 [1,1,1,1,1,3,3,3,1,3,3,3,3,3,3,3,3,3,3,1],
 [1,1,1,1,1,3,3,3,1,3,1,3,3,3,3,3,3,3,3,1],
 [1,1,1,1,1,3,3,3,1,1,1,1,1,1,1,1,1,1,1,1],
 [1,1,1,1,1,3,3,3,1,1,1,1,1,1,1,1,1,1,1,1],
 [1,1,1,1,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,6],
 [1,1,1,1,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,6],
 [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
 [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
 [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
 [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1]
];

if(selecionado == 0)
{
	guerreiroE=0;
	if(vila == 0)
	{
		tileMap[1][5] = 0;
	}
	else
	{
		tileMap[15][18] = 0;
	}
}
else
{
	tileMap[15][18] = selecionado;
	if(guerreiroE == 1)
	{
		tileMap[1][5] = 0;
	}
}

$(window).load(function(){

if (spawn==1) {
	$("#dialogo").show(); 
	$("#conteudo-historia").html("(Hoje fui lutar contra alguns monstros como pedido em um aviso no vilarejo... a recompensa era peças de ouro mas na verdade vim pelo desafio de enfrentar vários monstros sozinho... se bem que não foi la um grande desafio. Já sei! Irei pegar essas peças de ouro e irei procurar por uma maneira de enfrentar o Lorde das Trevas...)");
}

setInterval(movePlane, 100);
var keys = {}

$(document).keydown(function(e) {
    keys[e.keyCode] = true;
});

$(document).keyup(function(e) {
    delete keys[e.keyCode];
});

var images = new Array(11);



// 0->guerreiro / 1->parede / 2->ladrao / 3->terreno / 4->bardo / 5->feiticeira
// 6->vila / 7->montanha / 8->floresta / 9->portal / 10-> boss
imprimeMapa(movimenta,direcao);

function imprimeMapa(seMovimenta,direcao){
	if (seMovimenta == 1){
	$("#conteudo").html("<ul>"); 
	for(var i=0;i<20;i++)
	{
		$("#conteudo").append('<li style="list-style-type:none;padding:-4px;margin:-4px;">');
		for(var j=0;j<20;j++)
		{
			if(tileMap[i][j]==selecionado){
				$("#conteudo").append("<img src='Imagens/personagens/"+selecionado+""+direcao+".png' width='30px' height='30px' >");
				iP=i;
				jP=j;
			}
			if(tileMap[i][j]==0 && selecionado!=0 && guerreiroE == 1){
				$("#conteudo").append("<img src='Imagens/personagens/040.png' width='30px' >");
			}
			else if(tileMap[i][j]==0 && selecionado!=0 && guerreiroE == 0)
			{
				$("#conteudo").append("<span style='background-color:rgba(0,0,0,0.0); width: 30px; height: 30px; display: inline-block;'></span>");
				tileMap[i][j] = 3;
			}
			if (tileMap[i][j]==3)
			$("#conteudo").append("<span style='background-color:rgba(0,0,0,0.0); width: 30px; height: 30px; display: inline-block;'></span>");
			else if (tileMap[i][j]==1)
			$("#conteudo").append("<span style='background-color:rgba(0,0,0,0.0); width: 30px; height: 30px; display: inline-block;'></span>");
			else if (tileMap[i][j]==6)
			$("#conteudo").append("<span style='background-color:rgba(0,0,0,0.0); width: 30px; height: 30px; display: inline-block;'></span>");
		}
		$("#conteudo").append("</li>");                 
	}
	$("#conteudo").append("<ul>"); 
	}
}

function movePlane() {
    for (var direction in keys) {
        if (!keys.hasOwnProperty(direction)) continue;
        if (direction == 37 && movimenta!=0) {//esquerda
            direcao=37;
            spawn=0;
            if (tileMap[iP][jP-1]==3){ 
            tileMap[iP][jP]=3;
			tileMap[iP][jP-1]=selecionado;   
			$("#dialogo").hide();
			}
			else if(tileMap[iP][jP-1]==0)
			{
				if (missao=="1" && missao!="2") {
				$("#conteudo-historia").html("Olha só! Você veio aqui pelo mesmo cartaz da cidade né? Eu vim aqui por que achei interessante testar minha força contra os monstros daqui mas... não eram grande coisa =/, to doido pra achar um oponente mais forte e testar minha forca cara... EI! Já que você veio aqui você deve ser bem forte né? O que acha de uma luta comigo? <br/><a href='#' style='text-align: right;' data-id='sim-link'>Sim</a>&nbsp<a href='#' style='text-align: right;' data-id='nao-link'>Não</a>");
				$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/guerreiro.png" >');
				$("#dialogo").show();
				movimenta=0;
				}
				else{
				$("#conteudo-historia").html("Acho que você não tem nada pra falar comigo!");
				$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/guerreiro.png" >');
				$("#dialogo").show();
				}
			}
        }
        if (direction == 38 && movimenta!=0) {//cima
        	direcao=38;
        	spawn=0;
          	if (tileMap[iP-1][jP]==3){ 
            tileMap[iP][jP]=3;
			tileMap[iP-1][jP]=selecionado;
			$("#dialogo").hide();
			}
			else if(tileMap[iP-1][jP]==0)
			{
				if (missao=="1" && missao!="2") {
				$("#conteudo-historia").html("Olha só! Você veio aqui pelo mesmo cartaz da cidade né? Eu vim aqui por que achei interessante testar minha forca contra os monstros daqui mas... não eram grande coisa =/, to doido pra achar um oponente mais forte e testar minha forca cara... EI! Já que você veio aqui você deve ser bem forte né? O que acha de uma luta comigo? <br/><a href='#' style='text-align: right;' id='aa' data-id='sim-link'>Sim</a>&nbsp<a href='#' style='text-align: right;' data-id='nao-link'>Não</a>");
				$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/guerreiro.png" >');
				$("#dialogo").show();
				movimenta=0;
				}
				else{
				$("#conteudo-historia").html("Acho que você não tem nada pra falar comigo!");
				$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/guerreiro.png" >');
				$("#dialogo").show();
				movimenta=0;
				}
			}
        }
        if (direction == 39 && movimenta!=0) {//direita
        	direcao=39;
        	spawn=0;
        	if (tileMap[iP][jP+1]==3){ 
            tileMap[iP][jP]=3;
			tileMap[iP][jP+1]=selecionado;	
			$("#dialogo").hide();		
			}
			if (tileMap[iP][jP+1]==6){ 
				$("#guerreE").val(guerreiroE);
				$("#feitiE").val(feiticeiraE);
				$("#bardoE").val(bardoE);
				$("#ladraoE").val(ladraoE);
				$("#opcao").val(selecionado);
				$("#vilaId").val("0");
				$("#montanhaId").val("1");
				$("#florestaId").val("0");
				$("#missao").val(missao);
				//vila;
				$('form').get(0).setAttribute('action', 'mapaVila.php');
				movimenta=1;
				//submeter form sem clicar
    			$('#form').submit();
			}
        }
        if (direction == 40 && movimenta!=0) {//baixo
        	direcao=40;
        	spawn=0;
        	if (tileMap[iP+1][jP]==3){ 
            tileMap[iP][jP]=3;
			tileMap[iP+1][jP]=selecionado;  
			$("#dialogo").hide();   
			}
        }
        imprimeMapa(movimenta,direcao);
    }
}

$("body").on( "click",'a',(function(){
	if ($(this).data("id")=="sim-link"){ 
		$("#conteudo-historia").html("Com certeza! E a recompensa será minha caso eu ganhe então! <a href='#' data-id='lutar'>Lutar</a>");
		$("#personagem").html('');
	}
	else{
		$("#conteudo-historia").html("Não gostaria de lutar com você pois certamente eu iria perder, porem... por que você não vem comigo numa aventura? Tenho certeza que conheço o adversário perfeito para você...<a href='#' data-id='guer-lorde'>Continuar</a>");
		$("#personagem").html('');
	}

	if ($(this).data("id")=="lutar") {
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/guerreiro.png" >');
		$("#conteudo-historia").html("(Você Perdeu a batalha) E tu e forte mas também não era o que eu esperava... mas gostei de lutar com você, se quiser pode ficar com o ouro, meu objetivo não e esse afinal de contas...<a href='#' data-id='gold'>Continuar</a>");
	}

	if ($(this).data("id")=="gold") {
		$("#personagem").html('');
		$("#conteudo-historia").html("Muito obrigado! (Você ganhou 20 peças de ouro)<a href='#' data-id='continuar'>Continuar</a>&nbsp<a href='#' data-id='embora'>Ir Embora</a>");
	}

	if ($(this).data("id")=="embora") {
		movimenta=0;
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/monstro.png" >');
		$("#conteudo-historia").html("Você encontrou um zumbi. Apos uma luta (injusta por sinal), você foi morto por ele... <a href='#' data-id='game-over'>Continuar</a>");
	}

	if ($(this).data("id")=="game-over") {
		$("#dialogo").hide();
		alert("Game Over");
		missao="0";//finalizada
		selecionado="5";
		window.location = "index.php";
	}

	if ($(this).data("id")=="continuar") {
		$("#personagem").html('');
		$("#conteudo-historia").html("Na verdade esse ouro e seu mas... por que você não vem comigo numa aventura? Tenho certeza que conheço o adversário perfeito para você...<a href='#' data-id='guer-lorde'>Continuar</a>");
	}

	if ($(this).data("id")=="guer-lorde") {
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/guerreiro.png" >');
		$("#conteudo-historia").html("SERIO? Aceito com maior prazer, seria por acaso o Lorde das Trevas? Se for isso tava pensando em lutar contra ele recentemente, essa seria a oportunidade perfeita! =D<br/>(Guerreiro se juntou ao grupo)<br/><a href='#' data-id='finalizar'>Finalizar</a>");
		movimenta=0;
	}	
	if ($(this).data("id")=="finalizar") {
		$("#conteudo-historia").html("<p>(Zumbi encontrado!)</p><a href='#' data-id='luta-gue'>Prosseguir</a>");
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/monstro.png" >');
		movimenta=0;
	}

	if ($(this).data("id")=="luta-gue") {
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/guerreiro.png" >');
		$("#conteudo-historia").html("OPA pode deixar que eu acabo com esse garoto fácil...!<a href='#' data-id='last'>Continuar</a>");
		movimenta=0;
	}

	if ($(this).data("id")=="last") {
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/monstro.png" >');
		$("#conteudo-historia").html("<p>Zumbi derrotado!</p><a href='#' data-id='fim'>Finalizar</a>");
	}
	if ($(this).data("id")=="fim") {
		missao="2";
		guerreiroE = "0";
		$("#guerreiroE").val(guerreiroE);
		$("#dialogo").hide();
		movimenta=1;
	}
}));

});

/*$('#lutar').on("click",function(){
  $("#conteudo-historia").html("Com certeza! E a recompensa será minha caso eu ganhe então! <a href='#' id='lutar'>Lutar</a>");
});*/

//(Você Perdeu a batalha) E tu e forte mas também não era o que eu esperava... mas gostei de lutar com você, se quiser pode ficar com o ouro, meu objetivo não e esse afinal de contas...

</script>
</head>
<body>
<div id="conteudo"></div>

<form id="form" action="#" method="POST">	
	<input id="opcao" name="escolha" value="#" style="display:none" >
	<input id="guerreE" name="guerreiroE" value="1" style="display:none;" >
	<input id="ladraoE" name="ladraoEE" value="1" style="display:none;" >
	<input id="feitiE" name="feiticeiraE" value="1" style="display:none;" >
	<input id="bardoE" name="bardoE" value="1" style="display:none;" >
	<input id="vilaId" name="vila" value="0" style="display:none;" >
	<input id="montanhaId" name="montanha" value="0" style="display:none;" >
	<input id="florestaId" name="floresta" value="0" style="display:none;" >
	<input id="missao" name="missao" value="0" style="display:none;" >
	<input id="spawnId" name="spawn" value="0" style="display:none;" >
	<input type="submit" id="btn" style="display:none;">
</form>

<div id="dialogo" style="display:none;">
	<div id="personagem" style="padding: 5px;" >
		<img id="img-personagem" align="left" src="Imagens/rosto_personagens/guerreiro.png" >
	</div>
	<p id="conteudo-historia" style="padding: 5px;text-align: justify;"></p>
</div>

</body>


</html>