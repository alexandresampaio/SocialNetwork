<?php
    class Cadastro extends DB
    {
        public $erro;
        private $dados;
        private $_tabela;
        
        function __construct(array $dados, $table="usuarios")
        {
            $this->_tabela= $table;
            $this->dados = $dados;
            
            $this->register();
        }
        
        private function encrypt($senha)
        {
            return sha1($senha);
        }
        
        private function check ($email)
        {
            $check = self::getConn()->prepare('SELECT `id` FROM `'.$this->_tabela.'` WHERE `email`=? LIMIT 1');
            /*
            Dessa forma ou da forma abaixo
            
            $check->execute(array($email));
            return $check->rowCount() ==0 ? true : false;

            -> Seguindo essa forma retirar o !$this da
            condição do register.

            */
            $check->execute(array($this->dados['email']));
            return $check->rowCount();
        }
        
        private function validar()
        {
            if(strtolower($this->dados['captcha']) <> strtolower($_SESSION['captchaCadastro']))
            {
                $this->erro[] = 'O c&oacute;digo informado n&atilde;o &eacute; v&aacute;lido!';
            }
            
            foreach($this->dados as $column=>$value)
            {
                if($column=='senha')
                {
                    $this->dados[$column] = $this->encrypt($value);
                }

                if($value == '')
                {
                    $this->erro[] = 'O Campo <STRONG>'.$column.'</STRONG> é obrigat&oacute;rio!';
                }

            }

            if($column=='email' AND !preg_match("/^[a-z0-9_\.\-]+@[a-z0-9_\.\-]+\.[a-z]{2,4}$/i", $value ))
            {
               $this->erro[] = 'O email informado n&atilde;o &eacute; v&aacute;lido!';
            }
		}
        
        private function setCampos()
        {
            return '`'.implode('`=?, `',array_keys($this->dados)).'`=?';
        }
        
        
        function register()
        {
            $this->validar();
            if(!$this->check($this->dados['email']))
            {
                if(empty($this->erro))
                {
                   unset($this->dados['captcha']);

                   $INSERIR = DB::getConn() -> prepare('INSERT INTO '.$this->tabela.' SET '.$this->setCampos().'`cadastro`=NOW()');
                   if($INSERIR->execute(array_values($this->dados)))
                   {
                        header('Location: ./');
                        exit();
                   }
                   else
                   {
                        $this->erro[] = 'N&atilde;o foi posssivel realizar seu cadastro, tente mais tarde!';
                   }
                }
            }
            else
            {
               $this->erro[] = 'O email informado j&aacute est&aacute cadastrado!';
            }
        }
        
        function getErros()
        {
            return implode('<br />',$this->erro);
        }

    }
?>
