<?php
	class Login extends DB
	{
		public  $erro = '';
		private $cookie = true;
		private $_tabela = 'usuarios';
		private $prefix = 'SOCIALPHP_';

		private function ENCRYPT($senha)
		{
			return sha1($senha);	
		}
		
		private function validar($usuario, $senha)
		{
			$senha = $this->ENCRYPT($senha);
			try
			{
				$validar = self::getConn()->prepare('SELECT `id` FROM `'.$this->_tabela.'` WHERE `email`=? AND `senha`=? LIMIT 1');
				$validar->execute(array($usuario,$senha));
				return ($validar->rowCount()>0) ? true : false;
			}
			catch(PDOException $e)
			{
				$this->erro = "OH nao! Um Erro aconteceu."."<BR />Sistema Indisponivel";
				logErros($e);
				return false;
			}
		}
		
		function logar($usuario, $senha,$lembrar=false)
		{
			if($this->validar($usuario, $senha))
			{
				if(!isset($_SESSION))
				{
					session_start();	
				}
				
				$_SESSION[$this->prefix.'usuario'] = $usuario;
				$_SESSION[$this->prefix.'logado'] = true;
				
				if($lembrar)
				{
					$this->lembrardados($usuario, $senha);	
				}
				
				if($this->cookie)
				{
					$valor=join('#',array(
											$usuario,
											$_SERVER['REMOTE_ADDR'],
											$_SERVER['HTTP_USER_AGENT']
										  )
								);
					$valor = md5($valor);
					setcookie($this->prefix.'token',$valor,0,'/');
				}
				return true;
			}
			else
			{
				$this->erro = 'usuario invalido';
				return false;	
			}
		}
		
		function logado($cookei=true)
		{
			if(!isset($_SESSION))
			{
				session_start();	
			}
			
			if(isset($_SESSION[$this->prefix.'logado']))
			{
				if($cookei)
				{
					return $this->dadoslembrados();	
				}
				else
				{
					$this->erro='Voce nao esta logado';
					return false;	
				}	
			}
			
			if($this->cookie)
			{
				if(isset($_COOKIE[$this->prefix.'token']))
				{
					$this->erro='voce nao esta logado';
					return false;
				}
				else
				{
					$valor=join('#',array($_SESSION[$this->prefix.'usuario'],$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT']));
					$valor=sha1($valor);
					
					if($_COOKIE[$this->prefix.'token'] !== $valor)
					{
						$this->erro='voce nao esta logado';
						return false;
					}		
				}
			}
			return true;
		}
		
		public function sair($cookei=true)
		{
			if(!isset($_SESSION))
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
			
			if($cookei)
			{
				$this->limparlembrados();	
			}
			return !$this->logado(false);
		}
		
		private function limparlembrados()
		{
			if(isset($_COOKIE[$this->prefix.'login_user']))
			{
				setcookie($this->prefix.'login_user',false,(time()-3600),'/');
				unset($_COOKIE[$this->prefix.'login_user']);
			}
			
			if(isset($_COOKIE[$this->prefix.'login_pass']))
			{
				setcookie($this->prefix.'login_pass',false,(time()-3600),'/');
				unset($_COOKIE[$this->prefix.'login_pass']);
			}
		}
		
		
		private function dadoslembrados()
		{
			if(isset($_COOKIE[$this->prefix.'login_user']) AND $_COOKIE[$this->prefix.'login_pass'])
			{
				$usuario = base64_decode(substr($_COOKIE[$this->prefix.'login_user'],1));	
				$senha = base64_decode(substr($_COOKIE[$this->prefix.'login_pass'],1));
				
				return $this->logar($usuario, $senha);
			}
			return false;
		}
		
		private function lembrardados($usuario, $senha)
		{
			$tempo = strtotime('+7 day',time());
			$usuario = rand(1,9).base64_encode($usuario);
			$senha = rand(1,9).base64_encode($senha);
			
			setcookie($this->prefix.'login_user',$usuario,$tempo,'/');
			setcookie($this->prefix.'login_pass',$senha,$tempo,'/');			
		}	
	
	}
?>