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
<h3>Enterprise >> Login >> Recuperar Senha</h3>
<h1><i class="fas fa-key"></i> &nbsp;&nbsp;Recuperar Senha<br/>
<a href="login.php" ><i class="fas fa-arrow-circle-left"></i>Voltar</a></h1>
</hgroup>
<?php
    if(isset($_REQUEST['tMail']) && (!isset($_REQUEST['chave']))):{
    //incio do banco de dados
        $emailUrl = trim(strip_tags($_REQUEST['tMail']));
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
        $aluno->setEmail(trim(strip_tags($_REQUEST['tMail'])));
        $resultado = $aluno->consultarSenha($emailUrl);
        //var_dump($resultado);
        $id = $resultado['idaluno'];
        $nome = $resultado['nomealuno'];
        $cpf = $resultado['cpf'];
        $email = $resultado['email'];
        $data = $resultado['nascimento'];
        $cel = $resultado['cel'];
        $tel = $resultado['tel'];
        $senha = $resultado['senha'];
        $numCpf = strlen($cpf);
        $finalCPF = substr($cpf, $numCpf-2,$numCpf);
        $numTel  = strlen($tel);
        $numCel  = strlen($cel);
        $finalTel = substr($tel, $numTel-2,$numTel);
        $finalCel = substr($cel, $numCel-2,$numCel);    
        if($resultado['email'] == "" && (!isset($_REQUEST['chave']))) {
            header("location: lembrar.php?emailnegado=true");exit;
        }
    }
    //-----------------------------------------------------------------------
    if(isset($_REQUEST['tMail']) && (!isset($_REQUEST['chave']))) {
        //data 
        $data = str_replace("-","/",$data);
        $vetor = explode("/",$data);
        if (strlen($vetor[0])>=4){
                $ano = $vetor[0];
                $mes = $vetor[1];
        }else {
                $ano = $vetor[0];
                $mes = $vetor[1];
        }
        //cpf
        $cpf = str_replace(".","",$cpf);
        $cpf = str_replace("-","",$cpf);
        $cpf = substr($cpf,0,3);
        //cel
        if($cel != "") {
          $num = strlen($cel);
          $telfone =  substr($cel,($num-4),$num);
        }else {
          $num = strlen($tel);
          $telfone = substr($tel,($num-4),$num);
        }
        //aqui executa o comando
    if($emailUrl==$email){
        $chaveDeAcesso = base64_encode($id . "-". $email . "-" .  time());
        setcookie("chave",$chaveDeAcesso,time()+3600);//em uma hora
        echo $conteudo = "Recuperar Senha Portal Enterprise\n\n";
        echo $conteudo.= "Nome: ". $nome  ."\n";
        echo $conteudo.= "E-mail: ". $email ."\n";
        echo $conteudo.= "Click Aqui=> .: https://www.portal-enterprise.com/lembrar.php?chave=" . $chaveDeAcesso . "\n";
        echo $to = $email.";welington_marquezini88@live.com";
        echo $assunto = "Recuperar Senha Portal Enterprise";
        echo $mensagem = $conteudo;
        echo $header = "from:welington_marquezini88@live.com";
        mail($to,$assunto,$conteudo);//,$header);//@ faz ignorar o email caso de erro
        mail($email,$assunto,$mensagem,$header);
	    @mail($email,$assunto,$mensagem,$header);
        header("location: login.php?recupera='enviado'");exit();
        //header("Refresh: 30, login.php?recupera='enviado'");exit();
    }else {
        eader("location: lembrar.php?negado=true");exit;
    }
    //-----------------------------------------------------------------------
    }
 ?>
</div>
<?php elseif(isset($_REQUEST['mostrar'])):?>
    <div class="texto">
    <h1>Recuperação de Senha !!! </h1>
    <h3>Senha Alterada com Sucesso!!!</h3>
    </div>
<?php elseif((isset($_REQUEST['chave'])) && isset($_COOKIE['chave'])):?>
<div id="texto">
<?php   require_once './_model/classaluno.php';
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
        $cookie = $_COOKIE['chave'];
        if ($_COOKIE['chave']==$_REQUEST['chave']){
            $aluno = new aluno($conexao);
            $chave =  $_REQUEST['chave'];
            $string = base64_decode($chave);
            $matriz = explode("-", $string);
            $matriz[0];
            $n = $matriz[0];
            $resultadoChave = $aluno->find($n);
        }  else {
            header("location: lembrar.php?negado=true");exit;
        }
 ?>
    <h2 class="newsletter tituloform">Dados do Usuário</h2>
    <form method="post" class="formmenu" action="_controller/alterarSenha.php" name="formAlterarSenha" onsubmit="return validarAlterarSenha();" >  
    <fieldset id="senha"><legend>Nova Senha</legend>
            <p><label for="cNome">Nome:</label><input type="text" name="tNome" id="cNome" size="50" maxlength="50"  
                <?php if(isset($_REQUEST['chave'])){ echo "value='" . $resultadoChave['nomealuno']."'";} ?> readonly="readonly" />
            <p><label for="cEmail">E-mail:</label><input type="email" name="tEmail" id="cEmail" size="50" maxlength="50" 
                    <?php if(isset($_REQUEST['chave'])){ echo "value='" . $resultadoChave['email']."'";} ?> readonly="readonly"/>
            <p><label for="cCSenha">Nova Senha:</label><input type="password" name="tCSenha" id="cCSenha " size="8" maxlength="20" placeholder="8 dígitos" />
            <label for="cCSenha2">Confirmar Senha:</label><input type="password" name="tCSenha2" id="cCSenha2" size="8" maxlength="20" placeholder="8 dígitos" /></p>
    </fieldset>
    <!--<button name="tEnviar" type="submit" class="enviar radius">Enviar<i class="fas fa-arrow-circle-right"></i></button>-->
    <input name="tEnviar" type="submit" class="enviar radius" value="Alterar Senha"/><i class="fas fa-arrow-circle-right"></i>
</form>
</div>
<?php elseif(isset($_REQUEST['negado'])):?>
        <div class="texto">
    <h1>Recuperação de Senha !!! </h1>
    <h3>Dados Não foram Confirmados !!!</h3>
    <h4> Seu email Não foi encontrado!!! <br/>
        Ou sua chave de acesso expirou!!! <br/>
        Tente outra vez ou mande um E-mail com a solicitação alteção de senha para <br/>
        <i><b><a href="contato.php">Click Aqui!!! envie um email para<br/>contato@portal-enterprise.com</a></b></i> </h4>
        </div>
<?php elseif(isset($_REQUEST['emailnegado'])):?>
        <div class="texto">
    <h1>Recuperação de Senha !!! </h1>
    <h3>Seu E-mail não está cadastrado em nosso sitema!!!</h3>
    <h4> Verifique seu E-mail digitado ou entre em contato 
        <i><b><a href="contato.php">Click Aqui!!!</a></b></i> </h4>
        </div>
<?php else:?>
<div class="texto">
    <form method="post" class="formmenu" name="formLogin" action="lembrar.php" onsubmit="return validaSenha();">
    <fieldset id="usuario"><legend>Recuperar Senha</legend></fieldset>
    <fieldset id="email"><legend>E-mail: seu email de cadastrado</legend><br/>
    <label for="cMail">E-mail:</label>
        <input type="email" name="tMail" id="cMail" size="35" 
               maxlength="40" placeholder="exemplo@gmail.com" 
               <?php if(isset($_COOKIE['email'])){ $email=$_COOKIE['email'];
               $email=str_replace("/","",$email); echo "value=$email";}?> />
    
    </fieldset>    
    <!--<button name="tEnviar" type="submit" class="enviar radius">Enviar<i class="fas fa-arrow-circle-right"></i></button>-->
	<input name="tEnviar" type="submit" class="enviar radius" value="Enviar"/><i class="fas fa-arrow-circle-right"></i>
</form>
<br/>
</div>
<?php endif; ?>
<?php require_once "./footer.php"; ?>