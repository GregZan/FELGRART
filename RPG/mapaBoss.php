
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title> - Teste - </title>
  
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
	background-image: url("finalboss.png");
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
var tileMap = [
 [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
 [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
 [1,3,3,3,3,3,3,3,1,1,1,1,1,1,1,1,1,1,1,1],
 [1,3,1,1,1,1,3,3,1,1,1,1,1,1,1,1,1,1,1,1],
 [1,3,1,1,1,1,3,3,1,1,1,1,1,1,1,1,1,1,1,1],
 [1,3,3,1,3,1,3,3,1,1,1,1,1,3,8,3,1,1,1,1],
 [1,3,1,1,1,1,3,3,1,1,1,1,1,1,3,1,1,1,1,1],
 [1,3,1,1,1,1,3,3,1,1,1,1,1,1,3,1,1,1,1,1],
 [1,3,1,1,1,1,3,3,1,1,1,1,1,1,6,1,1,1,1,1],
 [1,3,1,1,1,1,3,3,3,3,1,1,1,1,3,1,1,1,1,1],
 [1,3,3,1,1,1,3,3,3,3,1,1,1,1,3,1,1,1,1,1],
 [1,1,3,1,1,1,1,1,1,3,1,1,1,1,3,1,1,1,1,1],
 [1,1,3,1,1,1,1,1,1,3,1,1,1,1,3,1,1,1,1,1],
 [1,1,3,1,1,1,1,1,1,3,1,1,1,1,3,1,1,1,1,1],
 [1,1,3,1,1,1,1,1,1,3,3,3,3,3,3,1,1,1,1,1],
 [1,3,3,3,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
 [1,3,3,3,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
 [1,3,3,3,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
 [1,3,3,3,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
 [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1]
];

if(selecionado == 4)
{
	tileMap[17][2] = 4;
}
else if(selecionado == 0)
{
	tileMap[17][2] = 0;
}
else if(selecionado == 2)
{
	tileMap[17][2] = 2;
}
else if(selecionado == 5)
{
	tileMap[17][2] = 5;
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
			if (tileMap[i][j]==3)
			$("#conteudo").append("<span style='background-color:rgba(0,0,0,0.0); width: 30px; height: 30px; display: inline-block;'></span>");
			else if (tileMap[i][j]==1)
			$("#conteudo").append("<span style='background-color:rgba(0,0,0,0.0); width: 30px; height: 30px; display: inline-block;'></span>");
			else if (tileMap[i][j]==6)
			$("#conteudo").append("<span style='background-color:rgba(0,0,0,0.0); width: 30px; height: 30px; display: inline-block;'></span>");
			else if (tileMap[i][j]==8)
			$("#conteudo").append("<img src='Imagens/personagens/boss.png' width='30px' >");
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
        	direcao=37;
            if (tileMap[iP][jP-1]==3){ 
            tileMap[iP][jP]=3;
			tileMap[iP][jP-1]=selecionado;   
			}
        }
        if (direction == 38 && movimenta!=0) {
        	direcao=38;
          	if (tileMap[iP-1][jP]==3){ 
            tileMap[iP][jP]=3;
			tileMap[iP-1][jP]=selecionado;
			}
			else if(tileMap[iP-1][jP]==6)//boss
			{	
				$("#conteudo-historia").html("MUA HUA HUA O QUE MEROS MORTAIS VIERAM FAZER EM MINHA FORTALEZA IMPENETRAVEL?<br/><a href='#' style='text-align: right;' data-id='ContinuarBoss'>Continuar</a>");
				$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/boss.png" >');
				$("#dialogo").show();
				movimenta=0;
			}
        }
        if (direction == 39 && movimenta!=0) {
        	direcao=39;
        	if (tileMap[iP][jP+1]==3){ 
            tileMap[iP][jP]=3;
			tileMap[iP][jP+1]=selecionado;    
			}
        }
        if (direction == 40 && movimenta!=0) {
        	direcao=40;
        	if (tileMap[iP+1][jP]==3){ 
            tileMap[iP][jP]=3;
			tileMap[iP+1][jP]=selecionado;     
			}
        }
        imprimeMapa(movimenta,direcao);
    }
}

$("body").on( "click",'a',(function(){
	if ($(this).data("id")=="ContinuarBoss"){ 
		if(selecionado == 0){
			$("#conteudo-historia").html("Se sua fortaleza e impenetravel parece meio duvidoso mas... com certeza MORTAL EU SOU PARA SUA VIDA! Lute comigo se tu se acha tao poderoso assim!<br/><a href='#' style='text-align: right;' data-id='boss1'>Continuar</a>");
			$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/guerreiro.png" >');
		}
		else if(selecionado == 2){
			$("#conteudo-historia").html("Impenetravel? Acho que tem algo errado na sua fortaleza entao se estamos aqui...hehehehe<br/><a href='#' style='text-align: right;' data-id='boss1'>Continuar</a>");
			$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/ladrao.png" >');
		}
		else if(selecionado == 4){
			$("#conteudo-historia").html("Para aventureiros nada e impossivel! E viemos aqui acabar com o mal que voce propaga! Exceto se voce decidir parar, dai podemos conversar as coisas...<br/><a href='#' style='text-align: right;' data-id='boss1'>Continuar</a>");
			$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/bardo.png" >');
		}
		else if(selecionado == 5){
			$("#conteudo-historia").html("hahaahah, pra mim nada e impossivel garoto <br/><a href='#' style='text-align: right;' data-id='boss1'>Continuar</a>");
			$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/feiticeira.png" >');
		}

	}
	if ($(this).data("id")=="boss1"){ 
		$("#conteudo-historia").html("Voce e digno de minha atencao, se acha mesmo que pode falar assim comigo, vamos la entao me mostre do que e capaz! <br/><a href='#' style='text-align: right;' data-id='boss2'>Continuar</a>");
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/boss.png" >');
	}
	if ($(this).data("id")=="boss2"){ 
		$("#conteudo-historia").html("Lorde das Trevas invoca uma horda de zumbis! Qual personagem deve enfrenta-los? <br/><a href='#' style='text-align: right;' data-id='opcao11'>Feiticeira</a><br/><a href='#' style='text-align: right;' data-id='opcao12'>Ladrao</a><br/><a href='#' style='text-align: right;' data-id='opcao13'>Bardo</a><br/><a href='#' style='text-align: right;' data-id='opcao14'>Guerreiro</a>");
		$("#personagem").html("");
		}
	if ($(this).data("id")=="opcao11") {
		$("#conteudo-historia").html("Feiticeira usou explosao arcana e destruiu todos os zumbis! <br/><a href='#' style='text-align: right;' data-id='turno2'>Continuar</a>");
	}
	else if ($(this).data("id")=="opcao12") {
		$("#conteudo-historia").html("O ladrao passa despercebido e apunhala o Lorde das Trevas, interrompendo sua concentracao para manter os zumbis sobre controle.<br/><a href='#' style='text-align: right;' data-id='turno2'>Continuar</a>");
	}
	else if ($(this).data("id")=="opcao13" || $(this).data("id")=="opcao14")
	{
		$("#conteudo-historia").html("Infelizmente o aventureiro escolhido nao foi pareo para a horda de zumbis...<br/><a href='#' style='text-align: right;' data-id='gameover'>fim</a>");
	}
	if ($(this).data("id")=="gameover") {
		$("#dialogo").hide();
		alert("Game Over");
		window.location = "index.php";
	}
	if ($(this).data("id")=="turno2"){ 
		$("#conteudo-historia").html("Lorde das Trevas invoca um Golem de lava! Qual personagem deve enfrenta-lo?<br/><a href='#' style='text-align: right;' data-id='opcao21'>Feiticeira</a><br/><a href='#' style='text-align: right;' data-id='opcao22'>Ladrao</a><br/><a href='#' style='text-align: right;' data-id='opcao23'>Bardo</a><br/><a href='#' style='text-align: right;' data-id='opcao24'>Guerreiro</a>");
	}
	if ($(this).data("id")=="opcao24") {
		$("#conteudo-historia").html("Luta contra o Golem enquanto o grupo distrai o Lorde das Trevas e acaba com o golem! <br/><a href='#' style='text-align: right;' data-id='turno3'>Continuar</a>");
	}
	else if ($(this).data("id")=="opcao21" || $(this).data("id")=="opcao22" || $(this).data("id")=="opcao23")
	{
		$("#conteudo-historia").html("Infelizmente o aventureiro escolhido nao foi pareo para o golem de lava...<br/><a href='#' style='text-align: right;' data-id='gameover'>fim</a>");
	}
	if ($(this).data("id")=="turno3"){ 
		$("#conteudo-historia").html("Lorde das Trevas cria um enorme orbe de energia negra e lanca sobre o grupo! Quem podera bloquear esse ataque?<br/><a href='#' style='text-align: right;' data-id='opcao31'>Feiticeira</a><br/><a href='#' style='text-align: right;' data-id='opcao32'>Ladrao</a><br/><a href='#' style='text-align: right;' data-id='opcao33'>Bardo</a><br/><a href='#' style='text-align: right;' data-id='opcao34'>Guerreiro</a>");
	}
	if ($(this).data("id")=="opcao31") {
		$("#conteudo-historia").html("Cria um escudo de luz em volta do grupo anulando a orbe de energia negra! <br/><a href='#' style='text-align: right;' data-id='turno4'>Continuar</a>");
	}
	else if ($(this).data("id")=="opcao32" || $(this).data("id")=="opcao33" || $(this).data("id")=="opcao34")
	{
		$("#conteudo-historia").html("Infelizmente o aventureiro escolhido nao conseguiu repelir ou anular a orbe de energia negra...<br/><a href='#' style='text-align: right;' data-id='gameover'>fim</a>");
	}
	if ($(this).data("id")=="turno4"){ 
		$("#conteudo-historia").html("Lorde das Trevas da um grito estridente e a cabeca de todos comeca a doer como se estivesse explodindo! Quem podera nos salvar?<br/><a href='#' style='text-align: right;' data-id='opcao41'>Feiticeira</a><br/><a href='#' style='text-align: right;' data-id='opcao42'>Ladrao</a><br/><a href='#' style='text-align: right;' data-id='opcao43'>Bardo</a><br/><a href='#' style='text-align: right;' data-id='opcao44'>Guerreiro</a>");
	}
	if ($(this).data("id")=="opcao43") {
		$("#conteudo-historia").html("O bardo repele o grito com uma melodia serene ao mesmo tempo acalmando todo o grupo! Todos estao mais motivados agora! <br/><a href='#' style='text-align: right;' data-id='turno5'>Continuar</a>");
	}
	if ($(this).data("id")=="opcao44") {
		$("#conteudo-historia").html("O guerreiro da outro grito e anula o do Lorde das Trevas, aumentando a moral do grupo ao mesmo tempo! <br/><a href='#' style='text-align: right;' data-id='turno5'>Continuar</a>");
	}
	else if ($(this).data("id")=="opcao41" || $(this).data("id")=="opcao42")
	{
		$("#conteudo-historia").html("Infelizmente o aventureiro escolhido nao conseguiu dar um jeito no grito insano do Lorde das Trevas...<br/><a href='#' style='text-align: right;' data-id='gameover'>fim</a>");
	}
	if ($(this).data("id")=="turno5"){ 
		$("#conteudo-historia").html("Lorde das trevas esta atordoado por ter usado muita energia!<br/><a href='#' style='text-align: right;' data-id='finalcont'>Continuar</a>");
	}
	if ($(this).data("id")=="finalcont"){ 
		if(selecionado == 0){
			$("#conteudo-historia").html("Essa e nossa chance! Vamos!<br/><br/><br/><br/><a href='#' style='text-align: right;' data-id='final1'>1- Eliminar o Lorde das Trevas e clamar o titulo para si.</a><br/><a href='#' style='text-align: right;' data-id='final2'>2- Eliminar o Lorde das Trevas e somente isso.</a>");
			$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/guerreiro.png" >');
		}
		else if(selecionado == 2){
			$("#conteudo-historia").html("HAHA olha so que patetico ele agora! VAMOS ACABAR COM ISSO LOGO!<br/><br/><br/><br/><a href='#' style='text-align: right;' data-id='propostaboss'>Continuar</a>");
			$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/ladrao.png" >');
		}
		else if(selecionado == 4){
			$("#conteudo-historia").html("VAMOS PESSOAL! Essa pode ser nossa unica chance de acabar com ele!<br/><br/><br/><br/><a href='#' style='text-align: right;' data-id='final1'>1- Matar o Lorde das Trevas.</a><br/><a href='#' style='text-align: right;' data-id='final2'>2- Imobilizar o Lorde das Trevas.</a>");
			$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/bardo.png" >');
		}
		else if(selecionado == 5){
			$("#conteudo-historia").html("Nossa oportunidade e agora, sinto que ele enfraqueceu!<br/><br/><br/><br/><a href='#' style='text-align: right;' data-id='final1'>1- Eliminar o Lorde das Trevas e tomar a fonte de seu poder para si.</a><br/><a href='#' style='text-align: right;' data-id='final2'>2- Eliminar o Lorde das Trevas e selar a fonte de seus poderes.</a>");
			$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/feiticeira.png" >');
		}
	}
	if($(this).data("id")=="propostaboss"){
		$("#conteudo-historia").html("Se voce ficar do meu lado agora e me ajudar lhe prometo todos os tesouros de minha fortaleza!<br/><br/><br/><br/><a href='#' style='text-align: right;' data-id='final1'>1- Aceitar a proposta e ficar ao lado do Lorde das Trevas.</a><br/><a href='#' style='text-align: right;' data-id='final2'>2- Negar a proposta e ajudar o grupo de aventureiros.</a>");
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/boss.png" >');
	}

	if ($(this).data("id")=="final1"){
	$("#escolhafinal").val("1");
	$("#selecionado").val(selecionado);
	$('#formulario').submit();
	}

	if ($(this).data("id")=="final2"){
	$("#selecionado").val(selecionado);
	$("#escolhafinal").val("2");
	$('#formulario').submit();
	}
}));

});

</script>
</head>
<body>

<form id="formulario" action="telaFinal.php" method="POST">
	<input id="escolhafinal" name="finalhist" value="0" style="display:none" >
	<input id="selecionado" name="escolha" value="0" style="display:none" >
	<input type="submit" id="btn" style="display:none;">
</form>


<div id="conteudo"></div>

<div id="dialogo" style="display:none">
	<div id="personagem" style="padding: 5px;" >
		<img id="img-personagem" align="left" src="Imagens/rosto_personagens/feiticeira.png" >
	</div>
	<p id="conteudo-historia" style="padding: 5px;text-align: justify;"></p>
</div>



</body>


</html>