<?php
	include('db/db.class.php');
	class Login extends DB
	{
		private $tabela='usuarios';
		private $prefix='socialnetwork_';
		private $cookie=true;
		public $erro='';
		
		private function encrypt($senha)
		{
			return sha1($senha);
		}
		
		private function validate($usuario, $senha)
		{
			$this->encrypt($senha);
			
			try
			{
				$validar = self::getConn()->prepare('SELECT `id` FROM `'.$this->tabela.'` WHERE `email`=? AND `senha`=? LIMIT 1');
				$validar->execute(array($usuario, $senha));
				return ($validar->rowCount()==1) ? true : false;
			}
			catch(PDOException $e)
			{
				$this->erro[] = 'Ah n&atilde;o um erro ocorreu, dados indispon&iacute;veis';
				logErros($e);
				return false;
			}
		}
		
		private function sign_in($usuario, $senha, $remember=false)
		{
			if($this->validate($usuario, $senha))
			{
				if(!$_SESSION)
				{
					session_start();
				}
				$_SESSION[$this->prefix.'usuario'] = $usuario;
				$_SESSION[$this->prefix.'logado']  = true;
				
				if($this->cookie)
				{
					$valor = join('#',array($usuario, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']));
					$valor = sha1($valor);
					setcookie($this->prefix.'token', $valor, 0, '/');
				}
			}
		}
		
		private function remember_me($usuario, $senha)
		{
			
		}	
	}
?>