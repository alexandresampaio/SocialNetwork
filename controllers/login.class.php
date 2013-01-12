<?php
	/*
		Classe responsavel por fazer todo 
		o processo de authenticação via cookies
		e criptografia de usuario.
	*/
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

		//Esta função valida os  campos usuario e senha		
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
		
		//Esta função usa a função validate para validar os campos
		//e criar uma sessão, utilizando cookies para armazenar a
		//sessao
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
				
				if($remember)
				{
					$this->remember_me($usuario, $senha);
				}
				return true;
			}
			else
			{
				$this->erro[] = 'Usu&aacute;ario n&atilde;o encontrado';
				return false;
			}
		}
		
		
		//Esta função verifica se ja existe uma sessao aberta
		//caso contrario ele inicia um nova sessao
		//em outras palavras ela verifica se o usuario esta logado
		// e sua sessao armazenada nos cookies
		private function signed_in($_COOKIE=true)
		{
			if(!$_SESSION)
			{
				session_start();	
			}
			
			if(!isset($_SESSION[$this->prefix.'logado']) AND !$_SESSION[$this->prefix.'logado'])
			{
				if($_COOKIE)
				{
					return $this->data_recorded();
				}
				else
				{
					$this->erro[]='voce nao esta logado';
					return false;	
				}
			}
			
			if($this->cookie)
			{
				if(!isset($_COOKIE[$this->prefix.'token']))
				{
					$this->erro[]='voce nao esta logado';
					return false;
				}
				else
				{
					$valor = join('#',array($_SESSION[$this->prefix.'usuario'],
											$_SERVER['REMOTE_ADDR'],
											$_SERVER['HTTP_USER_AGENT']));
					$valor = sha1($valor);
					
					if($_COOKIE[$this->prefix.'token'] !== $valor)
					{
						$this->erro[]='voce nao esta logado';
					}	
				}
			}
			return true;
		}
		
		//Esta  função fecha a sessao e limpa os dados
		// armazenados na sessao e seta valores 
		// negativos ou falsos para apagar os cookies
		
		function log_out($cookie=true)
		{
			if(!$_SESSION)
			{
				session_start();
			}	
			
			unset($_SESSION[$this->prefix.'usuario']);
			$_SESSION[$this->prefix.'logado'] = false;
			
			if($this->cookie AND isset($_COOKIE[$this->prefix.'token']))
			{
				setcookie($this->prefix.'token',false,(time()-3600),'/');
				unset($_COOKIE[$this->prefix.'token']);
			}
			
			if($cookie)
			{
				$this->clean_data_recorded();	
			}
			
			return !$this->signed_in(false);
		}
		
		//Esta  função limpa os dados armazenados
		//na sessao e seta valores negativos ou falsos
		//para apagar os cookies
		
		private function clean_data_recorded()
		{
			if(isset($_COOKIE[$this->prefix.'login_user']))
			{
				setcookie($this->prefix.'login_user',false, (time()-3600),'/');
				unset($_COOKIE[$this->prefix.'login_user']);	
			}
			
			if(isset($_COOKIE[$this->prefix.'login_key_pass']))
			{
				setcookie($this->prefix.'login_key_pass',false, (time()-3600),'/');
				unset($_COOKIE[$this->prefix.'login_key_pass']);	
			}
		}
		
		
		private function data_recorded()
		{
			if(isset($_COOKIE[$this->prefix.'login_user']) AND isset($_COOKIE[$this->prefix.'login_key_pass']))
			{
				$usuario =base64_decode(substr($_COOKIE[$this->prefix.'login_user'],1));
				$senha	 = base64_decode(substr($_COOKIE[$this->prefix.'login_key_pass'],1));
				
				return $this->sign_in($usuario, $senha, true);
			}
			return false;
		}
		
		// essa função é a função que irá armazenar 
		//os dados da session nos cookies		
		private function remember_me($usuario, $senha)
		{
			$time = strtotime('+',7,'day',time());
			
			$usuario = rand(1,9).base64_encode($usuario);
			$senha = rand(1,9).base64_encode($senha); 
			
			setcookie($this->prefix.'login_user',$usuario, $time, '/');
			setcookie($this->prefix.'login_key_pass',$senha, $time, '/');
		}
	}
?>