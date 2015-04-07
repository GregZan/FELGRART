<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
  	<script type='text/javascript' src='jquery.js'></script>
	<title>Fim de Jogo</title>
	<link href="http://fonts.googleapis.com/css?family=Aclonica:regular" rel="stylesheet" type="text/css" >
	<style type="text/css">

/*
h1{
font-family: 'Aclonica', serif;
color: #980000;
text-shadow: 0px 1px 0px #999, 0px 2px 0px #888, 0px 3px 0px #777, 0px 4px 0px #666, 0px 5px 0px #555, 0px 6px 0px #444, 0px 7px 0px #333, 0px 8px 7px #001135;
}*/

h1{
font-family: 'Aclonica', serif;
color:#333;
text-shadow: -5px 5px 5px rgba(0,0,0, 0.3);
}
	li{	
		display: inline;
	}

	#topo{
		position: absolute;
     left: 220px;
	}

	#img-personagem{
		left;
		width:100px;
		height:100px;
		border: 10px  groove  #c1bebe;
	}
#historia{
 position: absolute;
 font-family:Monotype Corsiva, Times, serif;
 font-size: 20px;
 text-align: justify;
 top: 90px;
 padding: 15px;
 padding-bottom: 20px;
    left: 1%;
    /*background-image: url('borda.png');*/
    width: 570px;
    height:300px;
    border: 10px  groove  #c1bebe;
background: rgb(238,238,238); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(238,238,238,1) 0%, rgba(204,204,204,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(238,238,238,1)), color-stop(100%,rgba(204,204,204,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */
}

#prosseguir{
	position: absolute;
 	top: 280px;
 	left: 240px;

}

.pers:hover{

	opacity: 0.7;
}

#btn {
  background: #2e2e2e;
  background-image: -webkit-linear-gradient(top, #2e2e2e, #06466e);
  background-image: -moz-linear-gradient(top, #2e2e2e, #06466e);
  background-image: -ms-linear-gradient(top, #2e2e2e, #06466e);
  background-image: -o-linear-gradient(top, #2e2e2e, #06466e);
  background-image: linear-gradient(to bottom, #2e2e2e, #06466e);
  -webkit-border-radius: 9;
  -moz-border-radius: 9;
  border-radius: 9px;
  font-family: Arial;
  color: #ffffff;
  font-size: 10px;
  padding: 10px 20px 10px 20px;
  text-decoration: none;
}

#btn:hover {
  background: #084a73;
  background-image: -webkit-linear-gradient(top, #084a73, #616c73);
  background-image: -moz-linear-gradient(top, #084a73, #616c73);
  background-image: -ms-linear-gradient(top, #084a73, #616c73);
  background-image: -o-linear-gradient(top, #084a73, #616c73);
  background-image: linear-gradient(to bottom, #084a73, #616c73);
  text-decoration: none;
}

#bardicon{
border-radius: 50px;

}

h3{
	text-align: center;
}

	</style>
</head>

<body>

<script type="text/javascript">


var finalPersonagem = "<?php echo $_POST['finalhist']; ?>";
var selecionado = "<?php echo $_POST['escolha']; ?>";

$(window).load(function(){

if (finalPersonagem==2){
	$("#fim-de-jogo").html("Fim de Jogo?");
}

if (selecionado == 0) {
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/guerreiro.png" >');
		$("#title-hist").html('Guerreiro');
		if(finalPersonagem==1){
			$("#conteudo-historia").html('Apesar de Davion ter clamado o titulo de Lorde das Trevas com o tempo as pessoas passaram a idolatra-lo como grande herói salvador, por simplesmente nunca usar sua força para o mal, e todo dia algum novo desafiante aparece dando um novo desafio a ele...');
		}
		else{
			$("#conteudo-historia").html('Depois desse grande feito Davion acabou esquecido com o tempo, voltando a sua vida monótona se tornou um lenhador para conseguir sobreviver e desistiu de se tornar o guerreiro mais forte do mundo.');
		}
}
if (selecionado == 2) {
	$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/ladrao.png" >');
	$("#title-hist").html('Ladrão');
	if(finalPersonagem==1){
		$("#conteudo-historia").html('Após aceitar a proposta do Lorde das Trevas Trepi aproveita a oportunidade de ficar ao lado dele e apunha-la ele desprevenido, após tal evento o grupo pergunta a Trepi por que ele não aceitou e ele responde: A qualé, mesmo ele me oferecendo todo o ouro eu iria conseguir a grana depois mesmo se matássemos ele e... acho que até conseguiria mais do lado dele porém de que adianta todo o dinheiro do mundo se esse imbecil tava destruindo o nosso mundo? Vou gastar como dai? haha');
	}
	else{
		$("#conteudo-historia").html('Ao parar pra refletir o lorde das trevas aproveita esse momento de fraqueza do Trepi e passa a controlar seu corpo usando ele contra o grupo, após todos serem mortos e Trepi ter se ferido gravemente na luta o Lorde das Trevas decide torna-lo em um serviçal morto vivo e passa a eternidade agora servindo o Lorde das Trevas como um cadáver ambulante...');
	}
}
if (selecionado == 4) {
	$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/bardo.png" >');
	$("#title-hist").html('Bardo');
	if(finalPersonagem==1){
		$("#conteudo-historia").html('Após a morte do Lorde das Trevas todos passaram a parar de se preocupar com seu mal e passaram a viver mais relaxados, e Gnis pode voltar a tocar suas músicas despreocupado pelo mundo.');
	}
	else{
		$("#conteudo-historia").html('Após prenderem o Lorde das Trevas e leva-lo para julgamento, o mesmo acaba escapando e recuperando seus poderes... porém dessa vez ele foi atrás de cada 1 dos aventureiros e eliminou 1 por 1 e hoje em dia domina o mundo sem ninguém para impedi-lo.');
	}
}
if (selecionado == 5) {
	$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/feiticeira.png" >');
	$("#title-hist").html('Feiticeira');
	if(finalPersonagem==1){
		$("#conteudo-historia").html('Após absorver o poder do Lorde das Trevas, Arcania lutava para não ser dominada pelo mesmo, para tal ela usou seus poderes da luz para neutralizar e se tornou a mais poderosa criatura do universo por dominar todas as artes da magia e seus elementos e mantêm a ordem para que nunca mais exista algum ser maligno controlando as pessoas.');
	}
	else{
		$("#conteudo-historia").html('Arcania após selar a fonte do poder do Lorde das Trevas guarda a mesma na floresta em que reside, porém depois de um tempo Trepi consegue rouba-la para tentar vender e acaba sendo possuído pela fonte de poder se tornando o novo Lorde das Trevas...');
	}
}

});

</script>

<div id="topo">
<h1 id="fim-de-jogo">FIM DE JOGO</h1>
</div>

<div id="historia">
	<h3 id="title-hist">Feiticeira</h3>
	<div id="personagem" >
		<img id="img-personagem" align="left" src="Imagens/rosto_personagens/feiticeira.png" >
	</div>
	<p id="conteudo-historia"></p>

	<div id="prosseguir">
	<form id="form" action="index.php" method="POST">	
	<input type="submit" id="btn" value="Jogar Novamente">
	</div> 
</div>

</body>
</html>