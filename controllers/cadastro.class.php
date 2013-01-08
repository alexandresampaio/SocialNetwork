<?php
    include('db/db.class.php');
    class Cadastro extends DB
    {
        public $erro;
        private $dados;
        private $_tabela;
        
        function __construct(array $dados, $table="usuarios")
        {}
        
        private function chech ($email)
        {
            $check = self::getConn()->prepare('SELECT `id` FROM `'.$this->_tabela.'` WHERE `email`=? LIMIT 1');
            $check->execute(array($dados['email']));
            /*$check->execute(array($email));*/
            
            return $check->rowCount();
        }
        
        private function validar()
        {
            foreach($this->dados as $column-> $value)
            {
                if($value == '')
                {
                    $this->erro[] = 'O Campo <STRONG>'.$column.'</STRONG> é obrigatoacute;rio.';
                }
                elseif(!preg_match("/^[a-z0-9_\.\-]+@[a-z0-9_\.\-]+\.[a-z]{2,4}$/i", $value ))
                {
                   $this->erro[] = 'O email informado n&atilde;o &eacute; v&aacute;lido!';
                }
            }
        }
        
        function register()
        {
            $this->validar();
            if(!$this->check($this->dados['email']))
            {
                if(empty($this->erro))
                {
                   $INSERIR = DB::getConn() -> prepare('INSERT INTO '.$this->tabela.' SET `email`=?, `senha`=?, `nome`=?, `sobrenome`=?, `sexo`=?, `nascimento`=?, `cadastro`=NOW()');
                }
            }
            else
            {
               $this->erro[] = 'O email informado ja&eacute esta&eacute cadastrado!';
            }
        }

    }
?>
