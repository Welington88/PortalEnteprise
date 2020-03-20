<?php 
ob_start();//inicio da sessao 
session_start();
if((isset($_SESSION['emails'])) && (isset($_SESSION['senhas']))){
    header("Location: usuario.php");exit;
}
?>
<?php require_once "./header.php"; ?>
<?php require_once "./menu.php"; ?>
<?php require_once './_model/UrlDb.php';
        $url = new UrlBD(); ?>
<hgroup class="pagina">
<h3>Enterprise >> Login</h3>
<h1><i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp;Login</h1>
</hgroup>
<div id="texto">
<form method="post" class="formmenu" name="formLogin" action="login.php" onsubmit="return validaLogin();">
<fieldset id="usuario"><legend>Faça o Login Abaixo:</legend>
    <?php if(isset($_REQUEST['nlogin'])){
    echo "<h4>Usuário ou senha inválidos</h4>";}
          if(isset($_REQUEST['acesso'])){
            $acesso = trim(strip_tags($_REQUEST['acesso']));
          echo "<h4>Erro ao acessar, você precisa está logado!</h4>";}
            if(isset($_REQUEST['recupera'])){
            echo "<h5>Seu E-mail cadastrado em nosso banco de dados!"
            . "<br/>Foi enviado um E-mail para você com sua Senha, "
            . "Verifique sua Caixa de Entrada e Lixo Eletrônico.</h5>";
            //header("Refresh: 30, login.php");
            }
            if(isset($_REQUEST['cadastro'])){
            echo "<h4>Cadastro realizado com sucesso, já pode fazer o login!</h4>";
            }
            if(isset($_REQUEST['logar'])){
                echo "<h4>Para fazer Inscrição é Necessário Fazer o Login</h4>";
            }
    ?>
    <p><label for="cMail">E-mail:</label>
        <input type="email" name="login" id="login" size="35" maxlength="40" 
               placeholder="exemplo@gmail.com" 
               <?php if(isset($_COOKIE['email'])){ $email=$_COOKIE['email'];
               $email=str_replace("/","",$email); echo "value=$email";}?>
               <?php if(isset($_REQUEST['nlogin']) || isset($_REQUEST['acesso']) 
                    || isset($_REQUEST['recupera']) || isset($_REQUEST['cadastro'])){
                    echo "style='border-color: red;background-color: yellow;'";}?>
                /> </p>
    <p><label for="cSenha">Senha:</label>
        <input type="password" name="senha" id="senha" size="8" 
               maxlength="20" placeholder="8 dígitos" 
               <?php if(isset($_COOKIE['senha'])){echo "value=".$_COOKIE['senha'];}?>
               <?php if(isset($_REQUEST['nlogin']) || isset($_REQUEST['acesso']) 
                    || isset($_REQUEST['recupera']) || isset($_REQUEST['cadastro'])){
                    echo "style='border-color: red;background-color: yellow;'";}?>
                    /></p>
    <b><a href="cadastro.php"> Novo Usuário || </a></b>
    <b><a href="lembrar.php"> Esqueci Minha Senha</a></b>
</fieldset>
<!--<button name="tEnviar" type="submit" class="enviar radius">Enviar<i class="fas fa-arrow-circle-right"></i></button>-->
<input name="tEnviar" type="submit" class="enviar radius" value="Enviar"/><i class="fas fa-arrow-circle-right"></i>
</form>
</div>
<?php 
if(isset($_REQUEST['login'])){
    $email = trim(strip_tags($_REQUEST['login']));
    $senha = trim(strip_tags($_REQUEST['senha']));
    setcookie("email",$_REQUEST['login'],time()*3600*24*7*4*12);
    setcookie("senha",$_REQUEST['senha'],time()*3600*24*7*4*12);
    //incio do banco de dados
    require_once './_model/classaluno.php';
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
 
    $resultado = $aluno->login($email);
    echo $resultado['nomealuno']."<br/>";
    echo $resultado['email']."<br/>";
    echo $resultado['senha']."<br/>";
    $aluno->setId($resultado['idaluno']);
    $aluno->setNome($resultado['nomealuno']);
    $aluno->setCpf($resultado['cpf']);
    $aluno->setRg($resultado['rg']);
    $aluno->setEmail($resultado['email']);
    $aluno->setNascimento($resultado['nascimento']);
    $aluno->setSexo($resultado['sexo']);
    $aluno->setEscolaridade($resultado['escolaridade']);
    $aluno->setRua($resultado['rua']);
    $aluno->setN($resultado['n']);
    $aluno->setComplemento($resultado['complemento']);
    $aluno->setBairro($resultado['bairro']);
    $aluno->setCidade($resultado['cidade']);
    $aluno->setUf($resultado['uf']);
    $aluno->setTel($resultado['tel']);
    $aluno->setCel($resultado['cel']);
    $aluno->setSenha($resultado['senha']);
    // fim de bando de dados
    if($aluno->getEmail()==$email and (password_verify($senha,$aluno->getSenha()))){
       $_SESSION['logado'] = TRUE;
       $_SESSION['ids'] = $aluno->getId();
       $usuario = explode(" ", $aluno->getNome());
       $_SESSION['nome'] = $usuario[0];
       setcookie('nomeAluno',$aluno->getNome());
       $_SESSION['emails'] = $aluno->getEmail();
       $_SESSION['senhas'] = $aluno->getSenha(); 
       header("location: usuario.php");
    }else {
       header("location: login.php?nlogin='true'");
    }
 }
?>
<?php require_once "./footer.php"; ?>
<?php 
          if(isset($_REQUEST['nlogin'])){
            echo "<script  type='text/javascript' > "
              . "alert('Usuário ou senha inválidos!');</script>";}
          if(isset($_REQUEST['acesso'])){
            echo '<script  type="text/javascript">'
              . 'alert("Erro ao acessar o Sistema!\nVocê precisa está logado!");'
              . '</script>';
            }
            if(isset($_REQUEST['recupera'])){
                    echo "<script  type='text/javascript' > 
                    alert('E-mail enviado para seu e-mail
                    com sua Senha!\n Verifique sua caixa de 
                    Entrada e Lixo Eletrônico!');
                    </script>";
            //header("Refresh: 30, login.php");
            }
            if(isset($_REQUEST['cadastro'])){
            echo '<script  type="text/javascript" >'
              . 'alert("Cadastro realizado com sucesso!\n'
              . 'Já pode fazer o login e acessar o sistema!");</script>';
            }
    ?>