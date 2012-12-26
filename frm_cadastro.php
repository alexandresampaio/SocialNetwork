<!DOCTYPE HTML>
<HTML LANG="pt-br">
<HEAD>
 <TITLE>Social-Network - Cadastro</TITLE>
 <LINK REL="stylesheet" HREF="css/cadastro.css" TYPE="text/css" />
</HEAD>
<BODY>
      <DIV ID="topo">
           <DIV ID="cAlign">
                <A HREF="#">
                   <IMG SRC="images/logo.png" ALT="social-network.com" />
                   <SPAN>
                         <A HREF="#">Portal</A> | <A HREF="#">Forum</A>
                   </SPAN>
                </A>
           </DIV><!-- cAlign -->
      </DIV><!-- topo -->
      <DIV ID="cAlign">
           <DIV ID="content">
                <DIV ID="left">
                     <UL>
                         <li>eu sou</li>
                         <li>data de nascimento</li>
                         <li>meu e-mail</li>
                         <li>nova senha</li>
                         <li>verificação contra fraudes</li>
                     </UL>
                </DIV><!-- left -->
           
                <DIV ID="formulario">
                     <FORM NAME="cadastro" METHOD="post" ACTION="" >
                           <div>
                                <div class="inputFloat">
                                     <span>nome</span>
                                     <input type="text" name="nome" class="inputText" />
                                </div>
                                
                                <div class="inputFloat">
                                     <span>sobrenome</span>
                                     <input type="text" name="sobrenome" class="inputText" />
                                </div>
                           </div>
                           
                           <SPAN class="spanHide">eu sou</SPAN>
                           <select name="sexo">
                                   <option value="">Selecione seu Genero</option>
                           </select>
                           
                           <SPAN class="spanHide">Data de nascimento</SPAN>
                           <select name="dia">
                                   <option value="">Dia</option>
                           </select>
                           <select name="mes">
                                   <option value="">Mes</option>
                           </select>
                           <select name="ano">
                                   <option value="">ano</option>
                           </select>
                           
                           <span>seu e-mail</span>
                           <input type="text" name="email" class="inputText" />
                           
                           <span>nova senha</span>
                           <input type="text" name="senha" class="inputText" />
                           
                           <div>
                                <div class="captchaFloat">
                                     <IMG SRC="#" width="200" height="60" alt="captcha" />
                                </div>
                                
                                <div class="captchaFloat">
                                     <SPAN>digite os caracteres</SPAN>
                                     <input type="text" name="palavra" class="inputText" />
                                </div>
                           </div>
                           <SPAN>&nbsp</SPAN>
                           <input type="submit" name="cadastrar" />

                     </FORM>
                </DIV><!-- formulario -->
           </DIV><!-- content -->
       </DIV><!-- cAlign -->

</BODY>
</HTML>
