<?php
     class DB
     {
      private static $conn;
      static function getConn()
      {
       if(is_null(self::$conn))
       {
        self::$conn = new PDO('mysql:host=127.0.0.1; dbname=aularedesocial', 'root', '');
		self::$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
       }
       return self::$conn;
      }
	 }
	 
	 function  logErros($errno)
	 {
		if (error_reporting() == 0) return;
		
		$exec = func_get_arg(0);
		$errno = $exec -> getCode();
		$errstr = $exec -> getMessage();
		$errfile = $exec -> getFile();
		$errline = $exec -> getLine();
		
		$err = 'CAUGHT_EXCEPTION';
		
		if(ini_get('log_errors')) error_log(sprintf("PHP %s: %s in %s on the line %d", $err, $errstr, $errfile, $errline ));
		
		$strERRO =  'erro: 	'.$err.'	no arquivo:	'.$errfile.'	 ( linha: 	'.$errline.' )	::	IP( '.$_SERVER['REMOTE_ADDR'].'	)	data: '.date('d/m/Y 	H:i:s')."\n";
		
		$arquivo = fopen('logErro.bin', 'a');
		fwrite($arquivo, $strERRO);
		fclose($arquivo);
		
		set_error_handler('logErros');
	 }
?>
