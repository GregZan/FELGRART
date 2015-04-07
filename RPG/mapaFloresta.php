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
	background-image: url("floresta.png");
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
 [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
 [1,1,1,1,1,1,3,3,3,3,3,3,3,3,3,1,1,1,1,1],
 [1,1,1,1,3,3,3,1,1,1,1,1,3,3,1,1,1,1,1,1],
 [1,1,1,1,3,3,1,1,1,1,1,1,3,3,1,1,1,1,1,1],
 [1,1,1,1,1,3,3,3,1,1,1,1,3,3,9,1,1,1,1,1],
 [1,1,1,1,1,3,3,3,1,1,1,1,1,1,1,1,1,1,1,1],
 [1,1,1,1,1,3,3,3,3,3,1,1,1,1,1,1,1,1,1,1],
 [1,1,1,1,1,3,3,3,1,3,1,1,1,1,1,1,1,1,1,1],
 [1,1,1,1,1,3,3,3,1,3,1,1,1,1,1,1,1,1,1,1],
 [1,1,1,1,1,1,1,1,1,3,1,1,1,1,1,1,1,1,1,1],
 [1,1,1,1,1,1,1,1,1,3,1,1,1,1,1,1,1,1,1,1],
 [1,1,8,1,1,1,1,1,1,3,1,1,1,1,1,1,1,1,1,1],
 [1,1,3,1,1,1,1,1,1,3,1,1,1,1,1,1,1,1,1,1],
 [1,1,3,3,1,1,1,1,1,3,1,1,1,1,1,1,1,1,1,1],
 [1,1,3,3,3,1,1,1,1,3,3,1,1,1,1,1,1,1,1,1],
 [1,1,3,3,3,1,1,1,1,3,3,3,3,3,3,3,1,1,1,1],
 [1,1,1,1,1,1,1,1,1,3,3,1,1,1,3,3,1,1,1,1],
 [1,1,1,1,1,1,1,1,1,3,1,1,1,1,3,3,3,3,1,1],
 [1,1,1,1,1,1,1,1,1,3,1,1,1,1,3,3,3,3,1,1],
 [1,1,1,1,1,1,1,1,1,6,1,1,1,1,1,1,1,1,1,1]
];

if(selecionado == 5)
{
	if(vila == 0)
	{
		tileMap[15][4] = 5;
	}
	else if(vila == 1)
	{
		tileMap[18][9] = 5;
	}
}
else if(selecionado != 5)
{
	tileMap[18][9] = selecionado;
	if(feiticeiraE == 1)
	{
		tileMap[15][4] = 5;
	}
}

$(window).load(function(){
if (spawn==1) {
	$("#dialogo").show(); 
	$("#conteudo-historia").html("(Apesar de meus poderes e conhecimento, será impossível para eu sozinha enfrentar o Lorde das Trevas... preciso procurar por alguns colegas de aventura para enfrenta-lo, vou dar uma olhada no vilarejo para ver se encontro alguém...)");
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
// 6->vila / 7->montanha / 8->portal / 9->portal / 10-> boss 
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
			if(tileMap[i][j]==5 && selecionado!=5 && feiticeiraE == 1){
				$("#conteudo").append("<img src='Imagens/personagens/540.png' width='30px' height='30px' >");
			}
			else if(tileMap[i][j]==5 && selecionado!=5 && feiticeiraE == 0)
			{
				$("#conteudo").append("<span style='background-color:rgba(0,0,0,0.0); width: 30px; height: 30px; display: inline-block;'></span>");
				tileMap[i][j] = 3;
			}
			if (tileMap[i][j]==3)
			$("#conteudo").append("<span style='background-color:rgba(0,0,0,0.0); width: 30px; height: 30px; display: inline-block;'></span>");
			else if (tileMap[i][j]==1)
			$("#conteudo").append("<span style='background-color:rgba(0,0,0,0.0); width: 30px; height: 30px; display: inline-block;'></span>");
			else if (tileMap[i][j]==8 || tileMap[i][j]==9)
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
        if (direction == 37 && movimenta!=0) {
   			spawn=0;
        	direcao=37;
            if (tileMap[iP][jP-1]==3){ 
            tileMap[iP][jP]=3;
			tileMap[iP][jP-1]=selecionado;
		   $("#dialogo").hide();
			}
        }
        if (direction == 38 && movimenta!=0) {
        	direcao=38;
          	if (tileMap[iP-1][jP]==3){ 
            tileMap[iP][jP]=3;
			tileMap[iP-1][jP]=selecionado;
			$("#dialogo").hide();
			}
			else if(tileMap[iP-1][jP]==8)
			{
				tileMap[iP][jP]=3;
				tileMap[4][13]=selecionado; 
			$("#dialogo").hide();
			}
        }
        if (direction == 39 && movimenta!=0) {
        	direcao=39;
        	spawn=0;
        	if (tileMap[iP][jP+1]==3){ 
            tileMap[iP][jP]=3;
			tileMap[iP][jP+1]=selecionado;    
			$("#dialogo").hide();
			}
			else if(tileMap[iP][jP+1]==5)
			{
				$("#conteudo-historia").html("Hummm ola rapaz... voce esta me procurando? <br/><br/><br/><br/><a href='#' style='text-align: right;' data-id='opcao1-link'>1- Sim! Ouvi dizer que voce pode me levar para a fortaleza do Lorde das Trevas...<br/><br/></a><a href='#' style='text-align: right;' data-id='opcao2-link'>2- Com certeza! Como nao iria ficar sabendo de uma delicia igual voce? Meu sonho e ficar com uma garota sensual e misteriosa igual voce!</a>");
				$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/feiticeira.png" >');
				$("#dialogo").show();
				imprimeMapa(movimenta,direcao);
				movimenta=0;
			}
			else if(tileMap[iP][jP+1]==9)
			{
				tileMap[iP][jP]=3;
				tileMap[12][2]=selecionado;
			$("#dialogo").hide();
			movimenta=1;
			}
        }
        if (direction == 40 && movimenta!=0) {
        	direcao=40;
        	spawn=0;
        	if (tileMap[iP+1][jP]==3){ 
            tileMap[iP][jP]=3;
			tileMap[iP+1][jP]=selecionado;  
			$("#dialogo").hide();
			}
			else if(tileMap[iP+1][jP]==5)
			{
				$("#conteudo-historia").html("Hummm ola rapaz... voce esta me procurando? <br/><br/><br/><br/><a href='#' style='text-align: right;' data-id='opcao1-link'>1- Sim! Ouvi dizer que voce pode me levar para a fortaleza do Lorde das Trevas...<br/><br/></a><a href='#' style='text-align: right;' data-id='opcao2-link'>2- Com certeza! Como nao iria ficar sabendo de uma delicia igual voce? Meu sonho e ficar com uma garota sensual e misteriosa igual voce!</a>");
				$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/feiticeira.png" >');
				$("#dialogo").show();
				imprimeMapa(movimenta,direcao);
				movimenta=0;
			}
			else if(tileMap[iP+1][jP]==6)
			{
				$("#guerreE").val(guerreiroE);
				$("#feitiE").val(feiticeiraE);
				$("#bardoE").val(bardoE);
				$("#ladraoE").val(ladraoE);
				$("#opcao").val(selecionado);
				$("#vilaId").val("0");
				$("#montanhaId").val("0");
				$("#florestaId").val("1");
				$("#missao").val(missao);
				$("#spawn").val(spawn);
				//vila;
				$('form').get(0).setAttribute('action', 'mapaVila.php');

				//submeter form sem clicar
    			$('#form').submit();
			}
        }
       imprimeMapa(movimenta,direcao);
    }
}
$("body").on( "click",'a',(function(){
	if ($(this).data("id")=="opcao1-link"){ 
		if((guerreiroE == 0) && (bardoE == 0) && (ladraoE == 0)){
			movimenta=0;
			$("#conteudo-historia").html("Certamente posso fazer isso mas... eu  tambem gostaria de ir, Se eu puder ir com voces podem ter certeza que irei teleportar nos todos em seguranca para a entrada da fortaleza dele...<br/><br/><br/><a href='#' data-id='opcao1'>1- Claro quanto mais pessoas melhor!<br/><br/></a>  <a href='#' data-id='opcaoa2'>2- Acho melhor nao... vamos procurar outra maneira obrigado!</a>");
			$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/feiticeira.png" >');
		}
		else {
			$("#conteudo-historia").html("Certamente posso fazer isso mas... gostaria de um grupo forte pra isso para eu ir junto... se voce conseguir 2 membros para o grupo alem de voce pode ter certeza que ajudo voces!");
			$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/feiticeira.png" >');
			movimenta=1;
		}
	}

	if($(this).data("id")=="opcaoa2"){
		movimenta=1;
		$("#dialogo").hide();
	}


	if ($(this).data("id")=="opcao2-link"){
		$("#conteudo-historia").html("<p>Seu safado!</p><a href='#' style='text-align: right;' data-id=gameover>Prosseguir</a>");
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/feiticeira.png" >');
		movimenta=0;		
	}

	if ($(this).data("id")=="gameover"){
		$("#dialogo").hide();
		movimenta=0;
		alert('Game Over');
		missao="0";//finalizada
		selecionado="5";
		window.location = "index.php";
	}
	if ($(this).data("id")=="opcao1"){
		$("#conteudo-historia").html("Perfeito então, vamos lá!<br/><a href='#' data-id='falaBardo'>Continuar</a>");
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/feiticeira.png" >');
		movimenta=0;	
	}

	if ($(this).data("id")=="opcao2"){
		$("#conteudo-historia").html("Perfeito então, vamos lá!<br/><a href='#' data-id='falaBardo'>Continuar</a>");
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/feiticeira.png" >');
		movimenta=0;	
	}
	
	if ($(this).data("id")=="falaBardo"){
		$("#conteudo-historia").html("Caramba fácil assim? Vamos lá então!<br/><a href='#' data-id='falaGuerreiro'>Continuar</a>");
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/bardo.png" >');	
		movimenta=0;
	}
	
	if ($(this).data("id")=="falaGuerreiro"){
		$("#conteudo-historia").html("Argh... odeio magias, magia de viagem então da ultima vez me deixou mais enjoado que uma viagem comum...<br/><a href='#' data-id='falaLadrao'>Continuar</a>");
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/guerreiro.png" >');	
		movimenta=0;
	}
	
	if ($(this).data("id")=="falaLadrao"){
		$("#conteudo-historia").html("Larga mão de ser fresco cara, e vamos logo com isso que sinto que estamos cada vez mais perto do teso... Lorde das Trevas hehe<br/><a href='#' data-id='teleporteBoss'>Teleportar para o Mapa do Lorde das Trevas</a>");
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/ladrao.png" >');
		movimenta=0;	
	}
	
	if ($(this).data("id")=="teleporteBoss"){
		$("#guerreE").val(guerreiroE);
		$("#feitiE").val(feiticeiraE);
		$("#bardoE").val(bardoE);
		$("#ladraoE").val(ladraoE);
		$("#opcao").val(selecionado);
		$("#vilaId").val("1");
		$("#montanhaId").val("0");
		$("#florestaId").val("0");
		$("#missao").val(missao);
		$("#spawn").val(spawn);
		//floresta;
		$('form').get(0).setAttribute('action', 'mapaBoss.php');

		//submeter form sem clicar
    	$('#form').submit();
	}
}));
});

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
		<img id="img-personagem" align="left" src="Imagens/rosto_personagens/feiticeira.png" >
	</div>
	<p id="conteudo-historia" style="padding: 5px;text-align: justify;"></p>
</div>

</body>


</html>