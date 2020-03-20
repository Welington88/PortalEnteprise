<?php 
ob_start();//inicio da sessao 
session_start();//inicio da sessao 
if((isset($_SESSION['emails'])) && isset($_SESSION['senhas'])){//se não exitir
    header("Location: usuario.php");exit;
}
?>
<?php require_once "./header.php"; ?>
<?php require_once "./menu.php"; ?>
<hgroup class="pagina">
<h3>Enterprise >> Login >> Cadastro</h3>
<h1><i class="fas fa-address-card"></i>Formulário de Cadastro<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="login.php" >Voltar<i class="fas fa-arrow-circle-left"></i></a></h1>
</hgroup>
<div class="texto">
<form method="post" class="formmenu" name="formCadastro" action="cadastro.php" onsubmit="return validaCadastro();" >
<fieldset id="usuario"><legend>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Cadastro do Usuário</legend> 
    <?php 
          if(isset($_REQUEST['acesso'])){
            $acesso = trim(strip_tags($_REQUEST['acesso']));
                echo "<h4>Senha ou Email diferentes tem ser cadastrados iguais!</h4>"
            . "<H6>Verifique se os campos  (CPF) &  (E-mail) & (Senha) "
                        . "estão preenchidos corretamente.</h6>";
            }
          if(isset($_REQUEST['inserir'])){
                echo "<h4>E-mail ou CPF já estão cadastrados no nosso sistema!</h4>";
          }
          if(isset($_REQUEST['existe'])){
                echo "<h4>E-mail ou CPF já se encontram cadastro no nosso Sistema</h4>";
          }
    ?>
</fieldset>
    <fieldset id="sexo"><legend>Dados do Usuário</legend>
    <label for="cNome">Nome:</label><input type="text" name="tNome" id="cNome" 
      size="40" maxlength="40" placeholder="Nome Completo"
        <?php if(isset($_COOKIE['nome'])){
                        $nome = $_COOKIE['nome'];
                        echo "value=$nome";}?>            
        <?php if(isset($_REQUEST['acesso']) || isset($_REQUEST['inserir']) 
                    || isset($_REQUEST['existe'])){
                    echo "style='border-color: red;background-color: yellow;'";}?>
                     />
    <br/><label for="cCPF">CPF . .  :</label>
    <input type="number" name="tCPF" id="cCPF" size="20" maxlength="20" placeholder="Somente os Números"
                <?php if(isset($_COOKIE['cpf'])){
                $cpf = $_COOKIE['cpf'];
                $cpf = str_replace("/", "", $cpf);
                echo "value=$cpf";}?>
            <?php if(isset($_REQUEST['acesso']) || isset($_REQUEST['inserir']) 
                    || isset($_REQUEST['existe'])){
                    echo "style='border-color: red;background-color: yellow;'";}?>
                                            />
    <br/><label for="cMail">E-mail.:</label><input type="email" name="tMail" 
           id="cMail" size="30" maxlength="40" placeholder="exemple@gmail.com"
    <?php if(isset($_COOKIE['email1'])){
                        $email1 = $_COOKIE['email1'];
                        $email1 = str_replace("/", "", $email1);  
                        echo "value=$email1";}?>        
    <?php if(isset($_REQUEST['acesso']) || isset($_REQUEST['inserir']) 
                    || isset($_REQUEST['existe'])){
                    echo "style='border-color: red;background-color: yellow;'";}?>
             />
   <br/><label for="cMail2">Confirmar<br/> E-mail:</label>
   <input type="email" name="tCMail2" id="cCMail2" size="30" maxlength="40" placeholder="exemple@gmail.com"
                   <?php if(isset($_COOKIE['email2'])){
                          $email2 = $_COOKIE['email2'];
                          $email2 = str_replace("/", "", $email2);  
                          echo "value=$email2";}?>   
                   <?php if(isset($_REQUEST['acesso']) || isset($_REQUEST['inserir']) 
                    || isset($_REQUEST['existe'])){
                    echo "style='border-color: red;background-color: yellow;'";}?>
                       />
   <br/><label> Telefone .. Fixo . : </label>
   <input type="tel"  name="tTel" id="cTel" size="20" maxlength="20" placeholder="(xx)xxxx-xxxx" 
            <?php if(isset($_COOKIE['tel'])){
                          echo "value=".$_COOKIE['tel'];}?>   
            <?php if(isset($_REQUEST['acesso']) || isset($_REQUEST['inserir']) 
                    || isset($_REQUEST['existe'])){
                    echo "style='border-color: red;background-color: yellow;'";}?> />
   <br/><label> Telefone Celular: </label><input type="tel" name="tCel" id="cCel" size="20" maxlength="20" placeholder="(xx)xxxxx-xxxx" 
                    <?php if(isset($_COOKIE['cel'])){
                          echo "value=".$_COOKIE['cel'];}?>   
                    <?php if(isset($_REQUEST['acesso']) || isset($_REQUEST['inserir']) 
                    || isset($_REQUEST['existe'])){
                    echo "style='border-color: red;background-color: yellow;'";}?> />

<fieldset id="senha"><legend>Senha</legend>
<label for="cSenha">Criar .. Senha .:</label>
  <input type="password" name="tSenha" id="cSenha" size="8" maxlength="20" required placeholder="8 dígitos" 
            <?php if(isset($_REQUEST['acesso']) || isset($_REQUEST['inserir']) 
                    || isset($_REQUEST['existe'])){
                    echo "style='border-color: red;background-color: yellow;'";}?>  />
<br/><label for="cSenha2">Confirmar Senha:</label>
<input type="password" name="tCSenha2" id="cCSenha2" size="8" maxlength="20" required placeholder="8 dígitos"
                    <?php if(isset($_REQUEST['acesso']) || isset($_REQUEST['inserir']) 
                    || isset($_REQUEST['existe'])){
                    echo "style='border-color: red;background-color: yellow;'";}?>  />
</fieldset>
<!--<input type="submit" value="Enviar" onsubmit="return validarSenha();"/>-->
<!--<button name="tEnviar" type="submit" class="enviar radius" onsubmit="return validarSenha();" >Enviar<i class="fas fa-arrow-circle-right"></i></button>-->
<input name="tEnviar" type="submit" class="enviar radius" value="Enviar" onsubmit="return validarSenha();" /><i class="fas fa-arrow-circle-right"></i>
<br/>
<br/>
</fieldset> 
</form>
</div>
<?php 
  if(isset($_REQUEST['tMail'])){
    //incio do banco de dados
    $email = trim(strip_tags($_REQUEST['tMail']));
    $email2 = trim(strip_tags($_REQUEST['tCMail2']));
    $senha = trim(strip_tags($_REQUEST['tSenha']));
    $senha2 = trim(strip_tags($_REQUEST['tCSenha2']));
    $cpf = trim(strip_tags($_REQUEST['tCPF']));
    
    setcookie("nome",$_REQUEST['tNome']);
    setcookie("email1",$_REQUEST['tMail']);
    setcookie("email2",$_REQUEST['tCMail2']);
    setcookie("cpf",$_REQUEST['tCPF']);
    setcookie("tel",$_REQUEST['tTel']);
    setcookie("cel",$_REQUEST['tCel']);
    
    require_once './_model/classaluno.php';
    require_once './_model/UrlDb.php';
        $url = new UrlBD();
		$dsn = $url->getDsn();
        $username = $url->getUsername();
        $passwd = $url->getPasswd();
    try {
        $conexao= new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    
    $aluno = new aluno($conexao);
    $aluno->setNome(ucwords(strtolower(trim(strip_tags($_REQUEST['tNome'])))));//ucwords primeira maiuscula
    $aluno->setCpf($aluno->arrumarCPF(trim(strip_tags($_REQUEST['tCPF']))));
    $aluno->setEmail(strtolower(trim(strip_tags($_REQUEST['tMail']))));//strtolower tudo minusculo
    $aluno->setTel(trim(strip_tags($_REQUEST['tTel'])));
    $aluno->setCel(trim(strip_tags($_REQUEST['tCel'])));
    $aluno->setSenha(trim(strip_tags( password_hash($_REQUEST['tSenha'],PASSWORD_DEFAULT))));
    $resultado = $aluno->login($email);
    $contarEmail = $aluno->contarEmail($email);
    $contarCpf = $aluno->contarCPF($cpf);
    if($contarEmail>0 || $contarCpf>0){
        header("location: cadastro.php?existe=true");exit;}  
    // fim de bando de dados
    if($senha==$senha2 and 
       $email==$email2 and (!empty($cpf)) and (!empty($email)) and (!empty($email2)) 
       and (!empty($senha)) and (!empty($senha2))){
       $aluno->inserir();
       $resultado = $aluno->login($email);
       $_SESSION['cadastro'] = $resultado['idaluno'];
       echo $nome = $aluno->getId()."<br/>";
       echo $email = $aluno->getEmail()."<br/>";
       echo $senha = $aluno->getSenha();
        $conteudo = "Bem Vindo ao Portal Enterprise\n\n";
        $conteudo.= "Complete seu cadastro no Site\n";
        $conteudo.= "Fazendo no login com seus Dados\n";
        $conteudo.= "Login.: ". $email ."\n";
        $conteudo.= "Senha.: ". $senha ."\n";
        $to = $email.";welington_marquezini88@live.com;cintia@damataleo.com.br";
        $assunto = "Cadastro Portal Enterprise";
        $mensagem = $conteudo;
        $header = "header: from:welington_marquezini88@live.com";
        //@mail($to,$assunto,$mensagem,$header);//@ faz ignorar o email caso de erro
        mail($to,$assunto,$mensagem,$header);
        header("location: login.php?cadastro='ok'");
       //header("Refresh: 5, usuario.php");
    if(isset($_REQUEST['tMail'])){   
       $resultado = $aluno->login(trim(strip_tags($_REQUEST['tMail'])));
       $aluno->setId($resultado['idaluno']);
       echo $nome = $aluno->getId()."<br/>";
       echo $email = $aluno->getEmail()."<br/>";
       echo $senha = $aluno->getSenha();
        $conteudo = "Bem Vindo ao Portal Enterprise\n\n";
        $conteudo.= "Complete seu cadastro no Site\n";
        $conteudo.= "Fazendo no login com seus Dados\n";
        $conteudo.= "Login.: ". $email ."\n";
        $conteudo.= "Senha.: ". $senha ."\n";
        $to = $email;
        $assunto = "Cadastro Portal Enterprise";
        $mensagem = $conteudo;
        $header = "header: from:contatoenterprise@hotmail.com";
        //@mail($to,$assunto,$mensagem,$header);//@ faz ignorar o email caso de erro
        @mail($to,$assunto,$mensagem,$header);
        header("location: login.php?cadastro='ok'");
       //header("Refresh: 5, usuario.php");
    }else {
       
       header("location: login.php?nlogin='true'");
    }
 }  else {
     header("location: cadastro.php?acesso='errosenhaemail'");
 }
 }
?>
 <?php require_once "./footer.php"; ?> 
<?php 
          if(isset($_REQUEST['acesso'])){
            $acesso = trim(strip_tags($_REQUEST['acesso']));
                echo '<script  type="text/javascript" >'
            . 'alert("Senha ou Email diferentes tem ser cadastrados iguais!\n'
            . 'Verifique se os campos  (CPF) &  (E-mail) & (Senha) estão preenchidos corretamente.");</script>';
            }
          if(isset($_REQUEST['inserir'])){
                echo '<script  type="text/javascript" >'
              . 'alert("E-mail ou CPF\njá estão cadastrados no nosso sistema!");</script>';
          }
          if(isset($_REQUEST['existe'])){
                echo '<script  type="text/javascript" >alert("E-mail ou CPF\n'
              . 'já se encontram cadastro no nosso Sistema!");</script>';
          }
    ?>