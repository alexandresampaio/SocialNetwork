<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<title>SOCIAL-NETWORK - HOME</title>
</head>

<body>
	<div id='login'>
    	<?php
        	if(isset($_POST['logar']))
			{
				$usuario = strip_tags($_POST['email']);
				$senha = strip_tags($_POST['senha']);
				$lembrar = isset($_POST['lembrar']);
				
				if($objLogin->logar($usuario, $senha , $lembrar))
				{
					header('Location: ./');
				}
				else
				{
					echo $objLogin->erro;	
				}
			}
		?>
    
    	<form name='login' method='post' enctype='multipart/form-data' action='' >
        	<input type='text' name='email'  />
            <input type='password' name='senha'   />
            <input type='checkbox' name='lembrar' />Continuar concectado
            <input type='submit' name='logar' value="logar"  />
        </form>
    </div>
</body>
</html>
