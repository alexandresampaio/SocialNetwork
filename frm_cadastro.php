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
                <H1>Cadastre-se,<span>&nbsp é gratis</span></H1>
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
                           </select>
                           
                           <span class="spanHide">Data de nascimento</span>
                                 <select name="dia">
                                   <option value="">Dia</option>
                                 </select>
                                 <select name="mes">
                                   <option value="">Mes</option>
                                 </select>
                                 <select name="ano">
                                   <option value="">Ano</option>
                                 </select>
                           
                           <span class="spanHide">seu e-mail</span>
                           <input type="text" name="email" class="inputTxt" />
                           
                           <span class="spanHide">nova senha</span>
                           <input type="text" name="senha" class="inputTxt" />
                           <span class="spanHide">Verificação contra fraudes</span>
                           <div>
                                <div class="captchaFloat">
                                     <img SRC="#" width="200" height="60" alt="captcha" />
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
