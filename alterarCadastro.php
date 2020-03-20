<?php 
ob_start();//inicio da sessao 
session_start();//inicio da sessao 
if((isset($_SESSION['emails'])) && isset($_SESSION['senhas'])){//se não exitir
    if(isset($_SESSION['redirecionar'])){
        switch ($_SESSION['redirecionar']){
        case 1:    
            unset($_SESSION['redirecionar']);
            header("location: inscricao.php");exit;
            break;
    }}
    	//Root
		require_once './_model/UrlDb.php';
			$url = new UrlBD();
			$dsn = $url->getDsn();
			$username = $url->getUsername();
			$passwd = $url->getPasswd();
			$exect = false;
			$w = $url->getRoot();
			foreach ($w as $e){
				if($e == $_SESSION['emails']){
					$exect = true;
				}
			}
		if(!$exect){
			header("Location: usuario.php?acesso='negado'");exit;
		}
		//Root
}else{
    header("Location: login.php?acesso='negado'");exit;
}
?>
<?php require_once "./header.php"; ?>
<?php require_once "./menu.php"; ?>
<?php     
    //incio do banco de dados        
    require_once './_model/classaluno.php';
	//conexão
    try {
        $conexao = new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    
    $aluno = new aluno($conexao);
    $resultadoaluno = $aluno->find($_REQUEST['id']);
    $aluno->setId($resultadoaluno['idaluno']);
    $aluno->setNome($resultadoaluno['nomealuno']);
    $aluno->setCpf($resultadoaluno['cpf']);
    $aluno->setRg($resultadoaluno['rg']);
    $aluno->setEmail($resultadoaluno['email']);
    $aluno->setNascimento($resultadoaluno['nascimento']);
    $aluno->setSexo($resultadoaluno['sexo']);
    $aluno->setEscolaridade($resultadoaluno['escolaridade']);
    $aluno->setRua($resultadoaluno['rua']);
    $aluno->setN($resultadoaluno['n']);
    $aluno->setComplemento($resultadoaluno['complemento']);
    $aluno->setBairro($resultadoaluno['bairro']);
    $aluno->setCidade($resultadoaluno['cidade']);
    $aluno->setUf($resultadoaluno['uf']);
    $aluno->setTel($resultadoaluno['tel']);
    $aluno->setCel($resultadoaluno['cel']);
    $aluno->setSenha($resultadoaluno['senha']);
    $aluno->setCep($resultadoaluno['cep']);
    $aluno->setProfissao($resultadoaluno['profissao']);
    
    $id = $resultadoaluno['idaluno'];
    $nome = $resultadoaluno['nomealuno'];
    $cpf = $resultadoaluno['cpf'];
    $rg = $resultadoaluno['rg'];
    $mail = $resultadoaluno['email'];
    $nascimento = $resultadoaluno['nascimento'];
    $sexo = $resultadoaluno['sexo'];
    $escolaridade = $resultadoaluno['escolaridade'];
    $profissao = $resultadoaluno['profissao'];
    $rua = $resultadoaluno['rua'];
    $n = $resultadoaluno['n'];
    $complemento = $resultadoaluno['complemento'];
    $bairro = $resultadoaluno['bairro'];
    $cidade = $resultadoaluno['cidade'];
    $uf = $resultadoaluno['uf'];
    $cep = $resultadoaluno['cep'];
    $tel =  $resultadoaluno['tel'];
    $cel = $resultadoaluno['cel'];
    $senha = $resultadoaluno['senha'];
?>
<hgroup class="pagina">
<h3>Enterprise >> Login >> Usuário >> Root >> Lista de Alunos Cadastrados >> Alterar Cadastro</h3>
<h1>Intranet Enterprise Usuário Root</h1>
<h5><a href="_controller/logout.php" >Sair(logout)</a></h5>
</hgroup>
<div class="texto">
    <h3><p>Alterar Dados do Cadastro do Aluno</p></h3> 
    <h5 ><a href="listaAlunos.php">Voltar</a></h5>
    <form method="post" id="fusuario" class="formmenu" action="_controller/alterar.php?root='true'" name="formCadastro" onsubmit="return validaAlterar();" >
<!-- <form> = formulario <fieldset> = conjunto de campos -->
<fieldset id="usuario"><legend>Cadastro do Usuário</legend>
    <fieldset id="sexo"><legend>Dados do Usuário</legend>
        <label for="cId"> ID: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="number" name="tId" id="cId" size="5" maxlength="11" placeholder="Id" 
                <?php echo "value='".$id ."'"; ?> readonly="readonly" /><br/>
        <label for="cNome"> Nome: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" name="tNome" id="cNome" size="50" maxlength="40" placeholder="Nome Completo" <?php echo "value='$nome'"; ?> />
            <br/><label for="cNasc">Nascimento: &nbsp;&nbsp;&nbsp;</label><input type="date" name="tNasc" id="cNasc" <?php echo "value='$nascimento'"; ?>/>
    <label for="cCPF"> CPF. : </label>
	<input type="text" name="tCPF" id="cCPF" size="20" maxlength="20" placeholder="000.000.000-00" 
            <?php $numCpf = $aluno->numCPF($cpf); echo "value='$numCpf'"; ?> /> <br/>
    <label for="cRG"> RG.: </label><input type="text" name="tRG" id="cRG" size="20" maxlength="20" placeholder="MG-00.000.000" <?php echo "value='$rg'"; ?>/>
    <label> Escolaridade. : </label>
               <select id="iEsc" name="tEsc" >
                   <optgroup label="Escolaridade">
                       <option value="">----------------------</option>
                       <option value="Fundamental" <?php if($escolaridade=='Fundamental'){ echo 'selected';} ?> >Fundamental</option>
                       <option value="Medio" <?php if($escolaridade=='Medio'){ echo 'selected';} ?> >Médio</option>
                       <option value="Tecnico" <?php if($escolaridade=='Tecnico'){ echo 'selected';} ?>>Técnico</option>
                       <option value="Superior" <?php if($escolaridade=='Superior') echo 'selected'; ?>>Superior</option>
                       <option value="Pos-Graduado" <?php if($escolaridade=='Pos-graduado'){ echo 'selected';} ?>>Pós-Graduado</option>
                       <option value="Mestrado" <?php if($escolaridade=='Mestrado'){ echo 'selected';} ?>>Mestrado</option>
                       <option value="Doutorado" <?php if($escolaridade=='Doutorado'){ echo 'selected';} ?> >Doutorado</option>
                   </optgroup>
               </select><br/>
    <label for="cProf"> &nbsp;&nbsp;&nbsp;&nbsp; Profissão.: </label>
    <input type="text" name="tProf" id="cProf" size="20" maxlength="20" placeholder="Profissão" <?php echo "value='$profissao'"; ?> />
    <label for="cMail">E-mail: </label><input type="email" name="tMail" id="cMail" size="35" maxlength="40" placeholder="exemple@gmail.com" <?php echo "value='$mail'"; ?>/>
   <label for="cMail2">Confirme E-mail: </label><input type="email" name="tCMail2" id="cCMail2" size="35" maxlength="40" placeholder="exemple@gmail.com"/ <?php echo "value='$mail'"; ?>></p>
   <label>Telefone Fixo : </label><input type="tel"  name="tTel" id="cTel" size="20" maxlength="20" placeholder="(xx)xxxx-xxxx" <?php echo "value='$tel'"; ?> />
   <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Telefone Celular : </label><input type="tel" name="tCel" id="cCel" size="20" maxlength="20" placeholder="(xx)xxxxx-xxxx" <?php echo "value='$cel'"; ?>/>
   <br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <fieldset><legend>Sexo</legend>
       <input type="radio" name="tSexo" id="cMasc" value="M" <?php if($sexo=='M'){ echo 'checked';} ?> /><label for="cMasc"> Masculino </label>
       <input type="radio" name="tSexo" id="cFem" value="F" <?php if($sexo=='F'){ echo 'checked';} ?> /><label for="cFem">Feminino</label></fieldset> </fieldset>
<fieldset id="endereco"><legend>Endereço do Usuário</legend><br/>
    <label for="cRua">Logradouro: &nbsp;</label><input type="text" name="tRua" id="cRua" size="40" maxlength="80" placeholder="Rua, AV, Travessa... " <?php echo"value='$rua'"; ?>/>
    <label for="cBairro"> Bairro : </label><input type="text" name="tBairro" id="cBairro" size="20" maxlength="20" placeholder="Seu Bairro" <?php echo "value='$bairro'"; ?>/>
    <br/><label for="cNum"> Número : &nbsp;</label><input type="text" name="tNum" id="cNum" min="0" max="99999" <?php echo "value='$n'"; ?>/>
    <label for="cComp"> Complemento : </label><input type="text" name="tComp" id="cComp" size="10" maxlength="10" placeholder="2º andar" <?php echo "value='$complemento'"; ?> />
    <label for="cCid"> Cidade : &nbsp;&nbsp;&nbsp;</label>
            <input type="text" name="tCid" id="cCid" maxlength="40" size="25" placeholder="Sua Cidade" <?php echo "value='$cidade'"; ?> list="cidades"/>
            <datalist id="cidades">
                <option>Leopoldina</option>
                <option>Cataguases</option>
                <option>Ubá</option>
                <option>Muriaé</option>
                <option>Recreio</option>
                <option>Laranjal</option>
                <option>Argirita</option>
            </datalist>
        <label for="cEst">Estado : &nbsp;&nbsp;&nbsp;</label><select name="tEst" id="cEst" <?php echo "value='$uf'"; ?>>
	<optgroup label="Região Sudeste">
        <option value="MG" <?php if($uf=='MG'){ echo 'selected';} ?>>Minas Gerais</option>
	<option value="SP" <?php if($uf=='SP'){ echo 'selected';} ?>>São Paulo</option>
	<option value="RJ" <?php if($uf=='RJ'){ echo 'selected';} ?>>Rio de Janeiro</option>
	<option value="ES" <?php if($uf=='ES'){ echo 'selected';} ?>>Espirito Santo</option></optgroup>
	<optgroup label="Região Sul"><option value="PR" <?php if($uf=='PR'){ echo 'selected';} ?>>Parana</option>
	<option value="SC" <?php if($uf=='SC'){ echo 'selected';} ?>>Santa Catarina</option>
	<option value="RS" <?php if($uf=='RS'){ echo 'selected';} ?>>Rio Grande Sul</option></optgroup>
        <optgroup label="Região Centro Oeste">
            <option value="DF" <?php if($uf=='DF'){ echo 'selected';} ?>>Distrito Federal</option>
            <option value="MT" <?php if($uf=='MT'){ echo 'selected';} ?>>Mato Grosso</option>
            <option value="MS" <?php if($uf=='MS'){ echo 'selected';} ?>>Mato Grosso do Sul</option>
            <option value="GO"<?php if($uf=='GO'){ echo 'selected';} ?>>Goiás</option>
        <optgroup label="Região Norte">
            <option value="AP"<?php if($uf=='AP'){ echo 'selected';} ?>>Amapá</option>
            <option value="AM"<?php if($uf=='AM'){ echo 'selected';} ?>>Amazonas</option>
            <option value="AC"<?php if($uf=='AC'){ echo 'selected';} ?>>Acre</option>
            <option value="PA"<?php if($uf=='PA'){ echo 'selected';} ?>>Pará</option>
            <option value="RO"<?php if($uf=='RO'){ echo 'selected';} ?>>Rondônia</option>
            <option value="RR"<?php if($uf=='RR'){ echo 'selected';} ?>>Roraima</option>
            <option value="TO"<?php if($uf=='TO'){ echo 'selected';} ?>>Tocantins</option></optgroup>
        <optgroup label="Região Nordeste">
            <option value="AL"<?php if($uf=='AL'){ echo 'selected';} ?>>Alagoas</option>
            <option value="BA"<?php if($uf=='BA'){ echo 'selected';} ?>>Bahia</option>
            <option value="CE"<?php if($uf=='CE'){ echo 'selected';} ?>>Ceará</option>
            <option value="PE"<?php if($uf=='PE'){ echo 'selected';} ?>>Pernambuco</option>
            <option value="MA"<?php if($uf=='MA'){ echo 'selected';} ?>>Maranhão</option>
            <option value="RN"<?php if($uf=='RN'){ echo 'selected';} ?>>Rio Grande do Norte</option>
            <option value="PI"<?php if($uf=='PI'){ echo 'selected';} ?>>Piauí</option>
            <option value="PB"<?php if($uf=='PB'){ echo 'selected';} ?>>Paraíba</option>
            <option value="SE"<?php if($uf=='SE'){ echo 'selected';} ?>>Sergipe</option>
        </optgroup>
	</select>
            <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                CEP.: &nbsp;&nbsp;&nbsp;</label>
            <input placeholder="00.000-000" type="text" size="25" maxlength="20" id="cCep" name="tCep" <?php echo "value='$cep'"; ?>/>
<br/></fieldset>
<!--<input type="image" name="tEnviar" src="_imagens/botao-enviar.png"/>-->
<input name="tEnviar" type="submit" class="enviar radius" value="Enviar" onsubmit="return validarSenha();" /><i class="fas fa-arrow-circle-right"></i>
</fieldset> 
</form>
</div>
<?php require_once "./footer.php"; ?>