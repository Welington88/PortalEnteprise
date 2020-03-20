<?php session_start();//inicio da sessao ?>
<?php require_once "./header.php"; ?>
<?php require_once "./menu.php"; ?>
<?php if(!isset($_REQUEST['tNome'])):?> 
<hgroup class="pagina">
<h3>Enterprise >> Contato</h3>
<h1><i class="fas fa-at"></i>Formulário de Contato<br/><br/>
    <legend>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     Faça contato com <i>Enterprise&COPY;</i> Orçamentos & Dúvidas.</legend>
</h1>
</hgroup>
<div class="texto">
<form method="post" id="fContato" name="formContato" action="contato.php" onsubmit="return validaContato();">
<!-- <form> = formulario <fieldset> = conjunto de campos -->
<fieldset id="usuario"><legend>Identificação do Usuário</legend>
   <p><label for="cNome">Nome:</label><input type="text" name="tNome" id="cNome" size="40" maxlength="40" placeholder="Nome Completo"/></p>
   <p><label for="cMail">E-mail:</label><input type="email" name="tMail" id="cMail" size="40" maxlength="40" placeholder="exemplo@gmail.com"/></p>
   <p><label for="cNasc">Tel/Cel.:</label><input type="tel" name="tTel" id="cNasc" placeholder="(xx)xxxx-xxxx"/></p>
</fieldset>

<fieldset id="assunto"><legend>Assunto:</legend>
    <p><label for="cAssunto">Assunto:</label><input 
            type="text" name="tAssunto" id="cAssunto" size="40" maxlength="40" placeholder="Assunto"/></p>
    <fieldset id="assunto"><legend>Dúvidas sobre:</legend>
        <input type="radio" name="contato" id="cursos" value="Cursos" />
        <label for="cursos" >Cursos <font size="1"><b>(Excel, Word, HTML, PHP, JAVA, VB, MYSQL)</b></font></label><br/>
        <input type="radio" name="contato" id="treinamentos" value="Treinamentos"/>
        <label for="treinamentos">Treinamentos <font size="1">
            <b>(Líder 360, Relações Interpessoais, Palestras Motivacionais e Empresariais)</b></font></label><br/>
        <input type="radio" name="contato" id="workshop" value="Worshop"/>
        <label for="worshop">Workshop</label><br/>
        <input type="radio" name="contato" id="banco" value="Bando de Candidatos" />
        <label for="banco">Banco de Candidatos</label><br/>
        <input type="radio" name="contato" id="outros" value="Outros"/>
        <label for="outros">Outros Assuntos</label>
    </fieldset>
</fieldset>

<fieldset id="mensagem"><legend>Mensagem do Usuário</legend>
    <label for="cMsg">Mensagem:</label><br/>
        <textarea name="tMsg" id="cMsg" cols="35"rows="5"placeholder="Deixe aqui sua mensagem">
        </textarea></fieldset>
<!--<button name="tEnviar" type="submit" class="enviar radius">Enviar<i class="fas fa-arrow-circle-right"></i></button>-->
<h2><input name="tEnviar" type="submit" class="enviar radius" value="Enviar"/><i class="fas fa-arrow-circle-right"></i></h2>
</form>
<p><font size="2" >
        Obs.:"<i><b>Dúvidas:</b> 
            entre em contato com a <b>ENTERPRISE:</b> Cíntia Paixão e Welington Marquezini" <br/>
            por Contatos OI (32) 98862 -1338 / VIVO (32) 998191306 ou email <a href="contato.php">contato@portal-enterprise.com</a>    .
        </i></font></p>
</div>
<?php else:?>
<div class="texto">
<h2>Mensagem Enviada com Sucesso!!!</h2>
<h4>Aguarde nosso contato!!!</h4>
</div>
<?php 
    $conteudo = "Atendimento On-Line Portal Enterprise\n\n";
    $conteudo.= "Nome: ".trim(strip_tags($_REQUEST['tNome']))."\n";
    $conteudo.= "E-mail: ".trim(strip_tags($_REQUEST['tMail']))."\n";
    $conteudo.= "Tel./Cel.: ".trim(strip_tags($_REQUEST['tTel']))."\n";
    $conteudo.= "Assunto: ".trim(strip_tags($_REQUEST['tAssunto']))."\n";
    $conteudo.= "Assunto: ".trim(strip_tags($_REQUEST['contato']))."\n";
    $conteudo.= "Mensagem: ".trim(strip_tags($_REQUEST['tMsg']))."\n";
    $conteudo.= "Por favor, aguarde nosso Contato\n";
    $email = trim(strip_tags($_REQUEST['tMail']));
    $to = "welington_marquezini88@live.com;cintia@damataleo.com.br";
    $assunto = "Atendimento On-Line Portal Enterprise";
    $mensagem = $conteudo;
    $header = "from:contatoenterprise@hotmail.com";
    mail($to,$assunto,$mensagem,$header);
    mail($email,$assunto,$mensagem,$header);
    //mail("contatoenterprise@hotmail.com",$assunto,$mensagem,$header);
    //@ faz ignorar o email caso de erro
?>
<a href="index.php" >Voltar</a>
<?php header("Refresh: 10, index.php");?>
<?php endif;?>   
<?php require_once "./footer.php"; ?>


