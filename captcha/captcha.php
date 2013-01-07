<?php
    /*
      ###############################
      #   ARQUIVO PHP RESPONSAVEL   	#
      #  POR EMBARALHAR AS LETRAS    #
      #        			DO CAPTCHA          	 		#
      ###############################
    */

    session_start();
    header('Content-type: image/jpeg');
	function geraCaptcha($_largura, $_altura, $_tFonte, $_qtLetras)
	{
			$canvas = imagecreate($_largura, $_altura) or die("Impossivel carregar a imagem");
			$corFundo = imagecolorallocate($canvas, 255,255, 255);
			$corLetra = imagecolorallocate($canvas, 155, 48, 255);
			
			$fonte=  "MICKEY.ttf"; 
			$palavras= substr(str_shuffle("AaBbCcDdEeFfGgHhIiJjKkLlMmNnPpQqRrSsTtUuVvYyXxWwZz23456789"),0, $_qtLetras );

			$_SESSION['captchaCadastro'] = $palavras;
			for($i=1;$i <= $_qtLetras; $i++)
			{
				imagettftext($canvas, $_tFonte, rand(0,0), ( ($_tFonte*$i)/1.5 ), $_tFonte+5, $corLetra, $fonte, substr($palavras, ($i-1), 1) ) or die ("[4]:".$i);
			}
			imagejpeg($canvas);
			imagedestroy($canvas);
	}
	$_largura = 300;
	$_altura = 90;
	$_tFonte = '50';
	$_qtLetras= 4;
	return geraCaptcha($_largura, $_altura, $_tFonte, $_qtLetras);
?>
