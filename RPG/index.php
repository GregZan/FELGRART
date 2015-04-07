<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
  	<script type='text/javascript' src='jquery.js'></script>
	<title>Escolha de Personagem</title>
	<style type="text/css">


	li{	
		display: inline;
	}

	#topo{
		position: absolute;
     left: 60px;
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
 top: 130px;
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
 	left: 260px;

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
var opcao=5;

</script>

<div id="topo">
	<ul>
		<li><img class="pers" data-id="5" src="Imagens/icones/feiticeira_icon.jpg" width="100px" ></li>
		<li><img class="pers" data-id="2" src="Imagens/icones/thief_icon.png" width="100px" ></li>
		<li><img class="pers" data-id="4" id="bardicon" src="Imagens/icones/bardicon.jpg" width="100px" ></li>
		<li><img class="pers" data-id="0" src="Imagens/icones/guerreiro_icon.ico" width="100px" ></li>
	</ul>
</div>

<div id="historia">
	<h3 id="title-hist">Feiticeira</h3>
	<div id="personagem" >
		<img id="img-personagem" align="left" src="Imagens/rosto_personagens/feiticeira.png" >
	</div>
	<p id="conteudo-historia">Arcania, a sabia, e uma estudiosa de tudo que e magico e misterioso, sua curiosidade e tamanha que ela decide descobrir qual a fonte de poder do lorde das trevas... ou quem sabe tomar para si?</p>

	<div id="prosseguir">
	<form id="form" action="mapaFloresta.php" method="POST">	
	<input id="opcao" name="escolha" value="5" style="display:none" >
	<input id="guerreE" name="guerreiroE" value="1" style="display:none;" >
	<input id="ladraoE" name="ladraoEE" value="1" style="display:none;" >
	<input id="feitiE" name="feiticeiraE" value="0" style="display:none;" >
	<input id="bardoE" name="bardoE" value="1" style="display:none;" >
	<input id="vilaId" name="vila" value="0" style="display:none;" >
	<input id="montanhaId" name="montanha" value="0" style="display:none;" >
	<input id="florestaId" name="floresta" value="0" style="display:none;" >
	<input id="spawnId" name="spawn" value="1" style="display:none;" >
	<input id="missao" name="missao" value="0" style="display:none;" >
	<input type="submit" id="btn" value="Confirmar">
	</div> 
</div>


<script type="text/javascript">
$(".pers").click(function(){

	if ($(this).data("id")=="0") {
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/guerreiro.png" >');
		$("#conteudo-historia").html('Davion, o duelista possui um único objetivo: Ser o mais forte do mundo, por isso esta sempre em busca de novos desafiantes para testar sua forca, com os ultimos acontecimentos ele decide que o lorde das trevas e o teste perfeito para provar que ele e o mais poderoso do mundo!');
		$("#title-hist").html('Guerreiro');
		$('form').get(0).setAttribute('action', 'mapaMontanha.php');
		$("#guerreE").val("0");
		$("#feitiE").val("1");
		$("#ladraoE").val("1");
		$("#bardoE").val("1");
		$("#opcao").val("0");
		$("#missao").val("2");
		$("#spawn").val("1");
	}
	else if ($(this).data("id")=="2") {
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/ladrao.png" >');
		$("#conteudo-historia").html('Trepi, o pilantra tem como lema de vida: "Tudo por dinheiro!" e ele realmente leva isso bem a serio, desde pequenos furtos ate grandes golpes ele aceita qualquer servico que paguem ele, e essa crise e a oportunidade perfeita para trabalhar como mercenario ou ate encontrar alguns tesouros...');
		$("#title-hist").html('Ladrão');
		$("#ladraoE").val("0");
		$("#feitiE").val("1");
		$("#guerreE").val("1");
		$("#bardoE").val("1");
		$("#opcao").val("2");
		$("#missao").val("0");
		$("#spawn").val("1");
		$('form').get(0).setAttribute('action', 'mapaVila.php');
		
	}
	else if ($(this).data("id")=="4") {
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/bardo.png" >');
		$("#conteudo-historia").html('Gnis, um humilde musico tem como sonho simplesmente espalhar sua musica para todo o mundo em uma aventura, pois o melhor e se divertir, e tem algo melhor do que se divertir transmitindo alegria para todos a sua volta? Porem com a crise atual as pessoas estao se esquecendo o que e se divertir e o que e uma boa musica. Quem melhor do que Gnis para lembra-las disso?');
		$("#title-hist").html('Bardo');
		$("#ladraoE").val("1");
		$("#guerreE").val("1");
		$("#bardoE").val("0");
		$("#feitiE").val("1");
		$("#opcao").val("4");
		$("#missao").val("0");
		$("#spawn").val("1");
		$('form').get(0).setAttribute('action', 'mapaVila.php');
	}
	else {
		$("#personagem").html('<img id="img-personagem" align="left" src="Imagens/rosto_personagens/feiticeira.png" >');
		$("#conteudo-historia").html('Arcania, a sabia, e uma estudiosa de tudo que e magico e misterioso, sua curiosidade e tamanha que ela decide descobrir qual a fonte de poder do lorde das trevas... ou quem sabe tomar para si?');
		$("#title-hist").html('Feiticeira');
		$("#feitiE").val("0");
		$("#ladraoE").val("1");
		$("#guerreE").val("1");
		$("#bardoE").val("1");
		$("#opcao").val("5");
		$("#spawn").val("1");
		$("#missao").val("0");
		$('form').get(0).setAttribute('action', 'mapaFloresta.php');
	};
});


</script

</body>
</html>