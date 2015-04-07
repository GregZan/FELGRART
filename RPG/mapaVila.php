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
	background-image: url("vilarejo.png");
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

#img-personagem{
	width: 100px;
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
 [1,1,1,1,1,1,1,1,7,1,1,1,1,1,1,1,1,1,1,1],
 [1,1,1,1,3,3,3,3,3,1,1,1,1,1,1,1,1,1,1,1],
 [1,1,1,1,1,1,3,3,3,1,1,1,1,1,1,1,1,1,1,1],
 [1,1,1,1,1,1,3,3,3,1,1,1,1,1,1,1,1,1,1,1],
 [1,1,1,1,1,1,3,3,3,1,1,1,1,1,1,1,1,1,1,1],
 [1,1,1,1,1,1,3,3,3,3,3,1,1,1,1,1,1,1,1,1],
 [1,1,1,3,1,3,3,3,3,3,3,3,1,3,1,1,1,1,1,1],
 [6,3,8,3,3,3,3,3,3,3,3,3,3,3,1,1,1,1,1,1],
 [6,3,3,1,3,3,3,3,3,3,3,3,3,1,1,1,1,1,1,1],
 [1,1,3,1,1,1,3,3,3,1,3,3,3,3,1,3,3,3,1,1],
 [1,3,3,3,1,1,3,3,3,3,3,3,3,3,3,3,1,3,1,1],
 [1,3,3,3,3,3,3,1,3,3,3,1,1,1,1,1,1,3,1,1],
 [1,3,3,3,3,3,3,1,3,3,3,1,1,1,1,1,1,3,1,1],
 [1,1,1,1,3,3,3,1,3,3,3,1,1,1,1,1,1,3,1,1],
 [1,1,1,1,1,3,3,1,3,3,3,3,1,1,1,1,1,3,1,1],
 [1,1,1,1,1,3,3,3,3,3,3,3,1,1,1,1,1,3,1,1],
 [1,1,1,1,1,3,1,1,3,3,1,3,1,1,1,1,1,3,1,1],
 [1,1,3,3,3,3,1,3,3,3,3,3,3,3,3,3,1,3,1,1],
 [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
 [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1]
];

if(selecionado == 4)
{
	if(montanha == 0 && floresta == 0)
	{
		tileMap[8][4] = 4;
	}
	else if(montanha == 1)
	{
		tileMap[8][1] = 4;
	}
	else if(floresta == 1)
	{
		tileMap[1][8] = 4;
	}
}
else if(selecionado != 4)
{
	if(montanha == 1)
	{
		tileMap[8][1] = selecionado;
	}
	else if(floresta == 1)
	{
		tileMap[1][8] = selecionado;
	}
	if(bardoE == 1)
	{
		tileMap[8][4] = 4;
	}
}
if(selecionado == 2)
{
	if(montanha == 0 && floresta == 0)
	{
		tileMap[16][17] = 2;
	}
	else if(montanha == 1)
	{
		tileMap[8][1] = 2;
	}
	else if(floresta == 1)
	{
		tileMap[1][8] = 2;
	}
}
else if(selecionado != 2)
{
	if(montanha == 1)
	{
		tileMap[8][1] = selecionado;
	}
	else if(floresta == 1)
	{
		tileMap[1][8] = selecionado;
	}
	if(ladraoE == 1)
	{
		tileMap[16][17] = 2;
	}
}



$(window).load(function(){
setInterval(movePlane, 100);
var keys = {}

$(document).keydown(function(e) {
    keys[e.keyCode] = true;
});

$(document).keyup(function(e) {
    delete keys[e.keyCode];
});

var images = new Array(11);

if (spawn==1) {
	$("#dialogo").show(); 
	if (selecionado==2) {
		$("#conteudo-historia").html("(Ficar parado aqui com esse bandolim não vai dar em nada... quero bastante grana pow... já sei! Vou achar uns otários para me ajudar a lutar contra o Lorde das Trevas e... enquanto eles lutam irei pegar todo o tesouro dele... hehehehe)");
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/ladrao.png" >');
	} else{
		$("#conteudo-historia").html("(Hora de sair em uma aventura! E lutar contra o Lorde das Trevas é a oportunidade perfeita para isso! Só que preciso encontrar meu Bandolim antes disso...)");
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/bardo.png" >');
	}
}


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
			if(tileMap[i][j]==2 && selecionado!=2 && ladraoE == 1){
				$("#conteudo").append("<img src='Imagens/personagens/240.png' width='30px' height='30px' >");
			}
			else if(tileMap[i][j]==2 && selecionado!=2 && ladraoE == 0)
			{
				$("#conteudo").append("<span style='background-color:rgba(0,0,0,0.0); width: 30px; height: 30px; display: inline-block;'></span>");
				tileMap[i][j] = 3;
			}
			if(tileMap[i][j]==4 && selecionado!=4 && bardoE == 1){
				$("#conteudo").append("<img src='Imagens/personagens/440.png' width='30px' height='30px' >");
			}
			else if(tileMap[i][j]==4 && selecionado!=4 && bardoE == 0)
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
			else if (tileMap[i][j]==7)
			$("#conteudo").append("<span style='background-color:rgba(0,0,0,0.0); width: 30px; height: 30px; display: inline-block;'></span>");
			else if (tileMap[i][j]==8)
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
			else if(tileMap[iP][jP-1]==4 )
			{
				movimenta=0;
				$("#conteudo-historia").html("Tem coisa melhor do que ir numa aventura escutando uma boa musica caro companheiro? Permita que eu responda! COM CERTEZA NAO! =D Eu vi que voce esta querendo enfrentar o Lorde das trevas... e eu quero ir junto, porem meu bandolim foi roubado... se voce recuperar ele para mim tenho certeza que posso te ajudar! <br/><a href='#' style='text-align: right;' data-id='ContinuarBardo'>Proximo</a>");
				$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/bardo.png" >');
				$("#dialogo").show();
			}
			else if(tileMap[iP][jP-1]==6)
			{
				$("#guerreE").val(guerreiroE);
				$("#feitiE").val(feiticeiraE);
				$("#bardoE").val(bardoE);
				$("#ladraoE").val(ladraoE);
				$("#opcao").val(selecionado);
				$("#vilaId").val("1");
				$("#montanhaId").val("0");
				$("#florestaId").val("0");
				$("#missao").val(missao);
				//Montanha;
				$('form').get(0).setAttribute('action', 'mapaMontanha.php');
				//submeter form sem clicar
				$('#form').submit();
				$("#dialogo").hide();
			}
        }
        if (direction == 38 && movimenta!=0) {
        	spawn=0;
        	direcao=38;
          	if (tileMap[iP-1][jP]==3){ 
            tileMap[iP][jP]=3;
			tileMap[iP-1][jP]=selecionado;
			$("#dialogo").hide();
			}
			else if(tileMap[iP-1][jP]==7)
			{
				$("#guerreE").val(guerreiroE);
				$("#feitiE").val(feiticeiraE);
				$("#bardoE").val(bardoE);
				$("#ladraoE").val(ladraoE);
				$("#opcao").val(selecionado);
				$("#vilaId").val("1");
				$("#montanhaId").val("0");
				$("#florestaId").val("0");
				$("#missao").val(missao);
				//floresta;
				$('form').get(0).setAttribute('action', 'mapaFloresta.php');

				//submeter form sem clicar
    			$('#form').submit();
				$("#dialogo").hide();
			}
			else if(tileMap[iP-1][jP]==8)//missao
			{
				if(missao=="0" ){
				$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/icones/missao.jpg" >');
				$("#conteudo-historia").html("PROCURA-SE ALGUEM PARA EXPLORAR AS MONTANHAS DUN'GOR E DERROTAR TODOS OS MONSTROS PRESENTES <br/>RECOMPENSA: 20 PECAS DE OURO + 1 QUICK DE MORANGO <br/><a href='#' style='float: right;' data-id='missao' id='prox-link-missao'>Aceitar</a>");
				$("#dialogo").show();
				}
			}
        }
        if (direction == 39 && movimenta!=0) {
        	spawn=0;
        	direcao=39;
        	if (tileMap[iP][jP+1]==3){ 
            tileMap[iP][jP]=3;
			tileMap[iP][jP+1]=selecionado;    
			$("#dialogo").hide();
			}
			else if(tileMap[iP+1][jP]==8)//missao
			{
				if(missao!="0"){
				$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/icones/missao.jpg" >');
				$("#conteudo-historia").html("PROCURA-SE ALGUEM PARA EXPLORAR AS MONTANHAS DUN'GOR E DERROTAR TODOS OS MONSTROS PRESENTES <br/>RECOMPENSA: 20 PECAS DE OURO + 1 QUICK DE MORANGO <br/><a href='#' style='float: right;' data-id='missao' id='prox-link-missao'>Aceitar</a>");
				$("#dialogo").show();
				movimenta=0;
				}
			}
        }
        if (direction == 40 && movimenta!=0) {
        	spawn=0;
        	direcao=40;
        	if (tileMap[iP+1][jP]==3){ 
            tileMap[iP][jP]=3;
			tileMap[iP+1][jP]=selecionado;  
			$("#dialogo").hide();
			}
			else if(tileMap[iP+1][jP]==2)
			{
				$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/ladrao.png" >');
				$("#conteudo-historia").html("Olha só o que 'achei' hehe, um instrumento bem legal... você quer ele?<a href='#' style='text-align: right;' data-id='devolver'>Poderia me devolver, e de um amigo meu.</a>&nbsp<a href='#' style='text-align: right;' data-id='roubar'>Você roubou, devolva para seu legitimo dono!</a>");
				$("#dialogo").show();
				movimenta=0;
			}
			else if(tileMap[iP+1][jP]==4)
			{
				$("#conteudo-historia").html("Tem coisa melhor do que ir numa aventura escutando uma boa musica caro companheiro? Permita que eu responda! COM CERTEZA NAO! =D Eu vi que voce esta querendo enfrentar o Lorde das trevas... e eu quero ir junto, porem meu bandolim foi roubado... se voce recuperar ele para mim tenho certeza que posso te ajudar! <br/><a href='#' style='text-align: right;' data-id='ContinuarBardo'>Proximo</a>");
				$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/bardo.png" >');
				$("#dialogo").show();
				movimenta=0;
			}
        }
        imprimeMapa(movimenta,direcao);
    }
}

$("body").on( "click",'a',(function(){
	if ($(this).data("id")=="missao"){ 
		if (missao!="1" && missao!="2"){
			missao="1";
			$("#missao").val("1");
		}
		$("#dialogo").hide();
	}
	
	if ($(this).data("id")=="ContinuarBardo"){ 
		if(selecionado == 2)
		{
			$("#conteudo-historia").html("Achei seu bandolim atrás de um beco... Se tu quiser de volta eu vendo ele pra você por 20 peças de ouro... sabe como e né, achado não e roubado é o que dizem... hehe, se tu não tiver grana posso ir com você nas montanhas fazer o pedido do aviso do vilarejo e pegar a grana pra mim em troca do seu bandolim...<br/><a href='#' style='text-align: right;' data-id='ContinuarBardo2'>Continuar</a>");
			$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/ladrao.png" >');
		}
		else
		{
			if(missao == 2 && ladraoE == 0)
			{
				$("#conteudo-historia").html("Você achou meu bandolim!! Em troca irei lhe ajudar na busca pelo lorde das trevas!!<br/><a href='#' style='text-align: right;' data-id='fim'>Finalizar</a>");
				$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/bardo.png" >');
				movimenta=1;
			}
			else
			{
				$("#conteudo-historia").html("Desculpe mas estou ainda procurando meu bandolim...<br/><a href='#' style='text-align: right;' data-id='fechar'>Finalizar</a>");
				$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/bardo.png" >');
				movimenta=1;
			}
		}
		if (ladraoE == 0 && feiticeiraE == 0)
		{
			$("#conteudo-historia").html("Perfeito então, vamos lá!<br/><a href='#' data-id='falaBardo'>Continuar</a>");
			$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/feiticeira.png" >');	
		}
	}
	
	if ($(this).data("id")=="ContinuarBardo2"){ 
		$("#conteudo-historia").html("Certo irei com você para recuperar o meu bandolim!!<br/><a href='#' style='text-align: right;' data-id='fim'>Finalizar</a>");
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/bardo.png" >');
	}
	
	if ($(this).data("id")=="devolver"){ 
		$("#conteudo-historia").html("Você acha mesmo que vou acreditar numa conversa fiada dessa?<br/><a href='#' style='text-align: right;' data-id='ContinuarLadrao'>Continuar</a>");
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/ladrao.png" >');
	}
	
	if ($(this).data("id")=="roubar"){ 
		$("#conteudo-historia").html("EU ROUBEI ELE? Ta louco cara? Eu só achei ele caído aqui.<br/><a href='#' style='text-align: right;' data-id='ContinuarLadrao'>Continuar</a>");
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/ladrao.png" >');
		movimenta=0;
	}
	
	if ($(this).data("id")=="ContinuarLadrao"){ 
		if(missao == 2)
		{
			$("#conteudo-historia").html("Se tu quiser de volta eu vendo ele pra você por 20 pecas de ouro... sabe como e né, achado não e roubado é o que dizem... hehe<br/><br/><a href='#' style='text-align: right;' data-id='pagar'>Pagar 20 pecas de ouro.</a>&nbsp<a href='#' style='text-align: right;' data-id='naoPagar'>Não pagar.</a>");
			$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/ladrao.png" >');
		}
		else
		{
			$("#conteudo-historia").html("O que? Você não tem nem 20 pecas de ouro... po cara... olha fiquei sabendo que tem um trabalho na cidade que estão oferecendo exatamente as 20 pecas que quero, quem sabe tu não pode conseguir la... hehe<br/><a href='#' style='text-align: right;' data-id='fechar'>Finalizar</a>");
			$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/ladrao.png" >');
		}
	}
	
	if ($(this).data("id")=="pagar"){ 
		$("#conteudo-historia").html("E DISSO QUE EU TO FALANDO hahaha, gostei de você cara, se quiser posso 'te ajudar' em sua aventura contra o lorde das trevas... realmente fiquei com vontade de 'lhe ajudar' hehe... A SIM! Só 1 coisa que esqueci de falar... o tesouro do lorde das trevas será meu ok? hehe<br/><a href='#' style='text-align: right;' data-id='fim-ladrao'>Sem problema. Vamos Lá!!!</a>");
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/ladrao.png" >');
		
	}
	
	if ($(this).data("id")=="naoPagar"){ 
		$("#conteudo-historia").html("Então ta... gostei dele mesmo vou ficar com ele parece ser um instrumento valioso... hehe, se mudar de ideia posso PENSAR em vender pra você... hehe<br/><a href='#' style='text-align: right;' data-id='fechar'>Finalizar</a>");
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/ladrao.png" >');
	}
	
	if ($(this).data("id")=="fim") {
		bardoE = "0";
		$("#bardoE").val(bardoE);
		$("#dialogo").hide();
		movimenta=1;
	}
	
	if ($(this).data("id")=="fim-ladrao") {
		ladraoE = "0";
		$("#ladraoE").val(ladraoE);
		$("#dialogo").hide();
		movimenta=1;
	}
	
	if ($(this).data("id")=="fechar") {
		$("#dialogo").hide();
		movimenta=1;
	}
	
	if ($(this).data("id")=="falaBardo"){
		$("#conteudo-historia").html("Caramba fácil assim? Vamos lá então!<br/><a href='#' data-id='falaGuerreiro'>Continuar</a>");
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/bardo.png" >');	
	}
	
	if ($(this).data("id")=="falaGuerreiro"){
		$("#conteudo-historia").html("Argh... odeio magias, magia de viagem então da ultima vez me deixou mais enjoado que uma viagem comum...<br/><a href='#' data-id='falaLadrao'>Continuar</a>");
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/guerreiro.png" >');	
	}
					
	if ($(this).data("id")=="falaLadrao"){
		$("#conteudo-historia").html("Larga mão de ser fresco cara, e vamos logo com isso que sinto que estamos cada vez mais perto do teso... Lorde das Trevas hehe<br/><a href='#' data-id='teleporteBoss'>Teleportar para o Mapa do Lorde das Trevas</a>");
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/ladrao.png" >');	
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
		//vilarejo
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
		<img id="img-personagem" align="left" src="Imagens/rosto_personagens/bardo.png" >
	</div>
	<p id="conteudo-historia" style="padding: 5px;text-align: justify;"></p>
</div>

</body>


</html>