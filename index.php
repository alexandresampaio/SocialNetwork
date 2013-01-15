<?php
		include('controllers/db/db.class.php');
		include('controllers/login.class.php');
	
		$objLogin = new Login;
		
		if(!$objLogin->logado())
		{
			include('login.php');
			exit();	
		}
		
		if(isset($_GET['sair']) AND $_GET['sair']==true)
		{
			$objLogin->sair();
			header('Location: ./');
		}
?>


<html LANG="pt-br">
<head>
<meta charset="utf-8" />
<title>SOCIAL-NETWORK - HOME</title>
</head>

<body>
	Logado:<a href="?sair=true">Sair</a>
</body>
</html>