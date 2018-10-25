<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-type" content="text/html charset=utf-8">
	<style type="text/css">
		*{
			box-sizing: border-box;
		}
		html,body{
			height:100%;
			font-family: Roboto,sans-serif;
		}
		.box{
			border:1px solid #000;
			width:400px;
			height:300px;
			margin:auto;
		}
		.text,h3,.link_btn{
			text-align: center;
		}
		h2{
			color:#fff;
			font-weight: bold;
			background: #1396e2;
			text-align: center;
			padding: 5px; 
			margin:0;
		}
		.link_btn{
			text-decoration: none;
			color:#fff;
			background-color: #1396e2;
			display: block;
			margin:40px auto;
			padding:10px;
			font-weight: bold;
			width:220px;
		}

	</style>
</head>
<body>
<div class="box">
	<h2>ZauzmiMesto.com</h2>
	<h3>Zdravo <?=$username?>,</h3>
	<p class="text">
		Klikom na link ispod odvešće vas na stranicu na kojoj možete promeniti zaboravljenu lozinku. 
	</p>
	<div>
		<a href="<?=$target?>" class="link_btn">Promeni lozinku</a>
	</div>
</div>
</body>
</html>