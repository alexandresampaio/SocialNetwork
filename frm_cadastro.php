<!DOCTYPE HTML>
<HTML LANG="pt-br">
<HEAD>
 <TITLE>Social-Network - Cadastro</TITLE>
 <LINK REL="stylesheet" HREF="css/cadastro.css" TYPE="text/css" />
</HEAD>
<BODY>
      <div id="topo">
           <div class="alinhamento">
                <a href="#"><img SRC="imagens/logo.png" alt="social-network.com" id="logo"/></a>
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

                     <form name="cadastro" method="post" action="" >
                           <div>
                                <div class="inputFloat">
                                     <span>nome</span>
                                     <input type="text" name="nome" class="inputTxt" />
                                </div>
                                
                                <div class="inputFloat">
                                     <span>sobrenome</span>
                                     <input type="text" name="sobrenome" class="inputTxt" />
                                </div>
                           </div>
                           
                           <span class="spanHide">eu sou</span>
                           <select name="sexo">
                                   <option value="">Selecione seu Genero</option>
                                   <option value="feminina">Feminino</option>
                                   <option value="masculino">Masculino</option>
                           </select>
                           
                           <span class="spanHide">Data de nascimento</span>
                           <select name="dia">
                              <?php
                                 for ($dia= 1; $dia<=31; $dia++)
                                 {
                                    $zero = ($dia < 10) ? 0 : '';
                                    echo '<option value="',$zero, $dia,'">',$zero, $dia,'</option>';
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
                                  $zero = ($dia < 10) ? 0 : '';
                                  echo '<option value="',$zero,$m,'">',$meses[$m],'</option>';
                                }
                              ?>
                           </select>
                           <select name="ano">
                              <?php
                                for($a=date('Y'); $a>=date('Y')-50; $a--)
                                {
                                   echo '<option value="',$a,'">',$a,'</option>';
                                }
                              ?>
                           </select>
                           
                           <span class="spanHide">seu e-mail</span>
                           <input type="text" name="email" class="inputTxt" />
                           
                           <span class="spanHide">nova senha</span>
                           <input type="text" name="senha" class="inputTxt" />
                           <span class="spanHide">Verificação contra fraudes</span>
                           <div>
                                <div class="captchaFloat">
                                     <img src="captcha/captcha.php" />
                                </div>
                                
                                <div class="inputFloat">
                                     <span>digite os caracteres</span>
                                     <input type="text" name="palavra" class="inputTxt" />
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
