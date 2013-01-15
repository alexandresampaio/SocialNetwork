<?php
	//inicializa a session_cache
	session_start();
?>
<!DOCTYPE HTML>
<HTML LANG="pt-br">
<HEAD>
 <TITLE>Social-Network - Cadastro</TITLE>
 <LINK REL="stylesheet" HREF="assets/css/cadastro.css" TYPE="text/css" />
 <script type="text/javascript" src="assets/js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="assets/js/efeitos.js"></script>
</HEAD>
<BODY>
      <div id="topo">
           <div class="alinhamento">
                <a href="#"><img SRC="assets/imagens/logo.png" alt="social-network.com" id="logo"/></a>
                <span><span>&nbsp&nbsp</span><a href="#">Portal</a><a href="#">Forum</a></span>
           </div><!-- cAlign -->
      </div><!-- topo -->
      <div class="alinhamento">
           <div id="content">
                <div id="left">
                     <ul>
                         <li>eu sou</li>
                         <li>data de nascimento</li>
                         <li>meu e-mail</li>
                         <li>nova senha</li>
                         <li>verificação contra fraudes</li>
                     </ul>
                </div><!-- left -->
                <div id="cadastro_title">
                     <h1>Cadastre-se,<span>&nbsp é gratis</span></h1>
                </div>
                <div id="formulario">

                     <?php
                         if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD']== 'POST')
                         {
                           extract($_POST);
                           /*var_dump($_POST); */
                           foreach($_POST as $key=>$val)
                           {
                             $_POST[$key] = strip_tags(trim($val));
                           }

                           include('../config/db/db.class.php');
                           include('../controllers/cadastro.class.php');

                           $nascimento= "$ano-$mes-$dia";
                           $cadastro = new Cadastro(
                                array(
                                    'captcha'=>$captcha,
                                    'nome'=>$nome,
                                    'sobrenome'=>$sobrenome,
                                    'sexo'=>$sexo,
                                    'nascimento'=>$nascimento,
                                    'email'=>$email,
                                    'senha'=>$senha
                                )
                           );
                           if(!empty($cadastro->erro))
                           {
                                echo '<h3>'.$cadastro->getErros().'</h3>';
                           }

						}
                     ?>
                     <form name="cadastro" method="post" action="" >
							
                           <div>
                                <div class="inputFloat">
                                     <span>nome</span>
                                     <input type="text" name="nome"  class="inputTxt" value='<?php if(isset($_POST["nome"]))  echo $nome ;?>'  />
                                </div>
                                
                                <div class="inputFloat">
                                     <span>sobrenome</span>
                                     <input type="text" name="sobrenome"  class="inputTxt" value='<?php if(isset($_POST["sobrenome"]))  echo $sobrenome ;?>'  />
                                </div>
                           </div>
                           
                           <span class="spanHide">eu sou</span>
                           <select name="sexo">
                                   <option value="">Selecione seu Genero</option>
                                   <option   value="feminino">Feminino</option>
                                   <option   value="masculino">Masculino</option>
                           </select>
                           
                           <span class="spanHide">Data de nascimento</span>
                           <select name="dia">
                              <?php
                                 for ($d= 1; $d<=31; $d++)
                                 {
                                    $zero = ($d < 10) ? 0 : '';
                                    if($dia == $zero.$d)
                                    {
                                      echo '<option selected="selected" value="',$zero, $d,'">',$zero, $d,'</option>';
                                    }
                                    else
                                    {
                                      echo '<option value="',$zero, $d,'">',$zero, $d,'</option>';
                                    }
                                 }
                              ?>
                           </select>
                           <select name="mes">
                              <?php
                                $meses = array('','Janeiro', 'Fevereiro', 'Março', 'Abril',
                                'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro',
                                'Novembro', 'Dezembro');
                                for ($m=1; $m<=12; $m++)
                                {
                                  $zero = ($m < 10) ? 0 : '';
                                  if($zero.$m == $mes)
                                  {
                                    echo '<option selected="selected "value="',$zero,$m,'">',$meses[$m],'</option>';
                                  }
                                  else
                                  {
                                    echo '<option value="',$zero,$m,'">',$meses[$m],'</option>';
                                  }

                                }
                              ?>
                           </select>
                           <select name="ano">
                              <?php
                                for($a=date('Y'); $a>=date('Y')-50; $a--)
                                {
                                   if($a == $ano)
                                   {
                                     echo '<option selected="selected" value="',$a,'">',$a,'</option>';
                                   }
                                   else
                                   {
                                     echo '<option value="',$a,'">',$a,'</option>';
                                   }
                                }
                              ?>
                           </select>
                           
                           <span class="spanHide">seu e-mail</span>
                           <input type="text" name="email"  class="inputTxt"  value='<?php if(isset($_POST["email"]))  echo $email ;?>'/>
                           
                           <span class="spanHide">nova senha</span>
                           <input type="password" name="senha" class="inputTxt" />
                           <span class="spanHide">Verificação contra fraudes</span>
                          
						  <div>
                               <?php
									echo '<div class="captchaFloat">';
									echo '<img src="../resource/captcha/captcha.php" />';
									echo '</div>';
								?>
								<div class="inputFloat">
                                     <span>digite os caracteres</span>
                                     <input type="text" name="captcha" class="inputTxt" />
                                </div>
                           </div>
						   
						   <span>&nbsp</span>
                           <input type="submit" value="" class="submitCadastro" name="cadastrar" />

                     </form>
                </div><!-- formulario -->
           </div><!-- content -->
       </div><!-- cAlign -->

       <div id="footer">
            <p>&copy Copyright 2012 - allexonrails.com - Todos os direitos reservados</p>
       </div>
</BODY>
</HTML>
