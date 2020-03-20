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
}else{
    header("Location: login.php?acesso='negado'");exit;
}
if(isset($_SESSION['cadastro'])){
    unset($_SESSION['cadastro']);
    header("location: usuario.php?pricadastro=true");exit;
}
?>
<?php require_once "./header.php"; 
      require_once "./menu.php"; 
      require_once './_model/UrlDb.php';
        $url = new UrlBD();
      require_once './_model/classinscricao.php';
        $dsn = $url->getDsn();
        $username = $url->getUsername();
        $passwd = $url->getPasswd();
    try {
        $conexao= new \PDO($dsn, $username, $passwd);//cria conexão com banco de dados 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
     $inscricao = new Inscricao($conexao);
    //$resultado = $inscricao->find($_REQUEST['id']);
    //$idcurso = $_SESSION['curso'];
    $idaluno = $_SESSION['ids'];
    $resultado = $inscricao->findinscricoes($idaluno);
    $inscrAluno = $inscricao->inscrAluno($idaluno);
    //$inscricao->setIdcurso($_SESSION['curso']);
    $inscricao->setIdaluno($_SESSION['ids']);
    $consultaid = $resultado['idaluno'];
    //$inscricao->find($consultaid,$idcurso);
    $statuspgto = $resultado['statuspgto'];
    $inscricao->setStatuspgto($statuspgto);
    $inscricao->setNomeCurso($resultado['nomecurso']);
    $inscricao->setDescricao($resultado['descricao']);
    $inscricao->setInstrutor($resultado['instrutor']);
    $inscricao->setPrevisao($resultado['previsao']);
    $inscricao->setCarga($resultado['carga']);
    $inscricao->setTotaula($resultado['totaulas']);
    $inscricao->setValor($resultado['valor']); 
    //incio do banco de dados
    require_once './_model/classaluno.php';
    //$resultado = $inscricao->find($_REQUEST['id']);
    $inscricao->setId($resultado['idaluno']);
    $inscricao->setNome($resultado['nomealuno']);
    $inscricao->setCpf($resultado['cpf']);
    $inscricao->setRg($resultado['rg']);
    $inscricao->setEmail($resultado['email']);
    $inscricao->setNascimento($resultado['nascimento']);
    $inscricao->setSexo($resultado['sexo']);
    $inscricao->setEscolaridade($resultado['escolaridade']);
    $inscricao->setProfissao($resultado['profissao']);
    $inscricao->setRua($resultado['rua']);
    $inscricao->setN($resultado['n']);
    $inscricao->setComplemento($resultado['complemento']);
    $inscricao->setBairro($resultado['bairro']);
    $inscricao->setCidade($resultado['cidade']);
    $inscricao->setUf($resultado['uf']);
    $inscricao->setCep($resultado['cep']);
    $inscricao->setTel($resultado['tel']);
    $inscricao->setCel($resultado['cel']);
    $inscricao->setSenha($resultado['senha']);
    $inscricao->setDatainscricao($resultado['datainscricao']);
    $inscricao->setInscricao($resultado['idinscricao']);
    $inscricao->setDesconto($resultado['desconto']);
    $inscricao->setChave($resultado['chave']); 
    
    $aluno = new aluno($conexao);
    //$resultadoalunoaluno = $aluno->find($_REQUEST['id']);
    $resultadoaluno = $aluno->find($_SESSION['ids']);
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
    
    //if(!$resultado['email']==""){
    $nome = $resultadoaluno['nomealuno'];
    $cpf = $resultadoaluno['cpf'];
    $rg = $resultadoaluno['rg'];
    $mail = $resultadoaluno['email'];
    $nascimento = $resultadoaluno['nascimento'];
    //$data = $resultadoaluno['nascimento'];
    /*if ($data==""){$data="0000-00-00";}
    $nascimento = $data;
    $vetor = explode("-", $nascimento);
    $ano = $vetor[0];
    $mes = $vetor[1];
    $dia = $vetor[2];
    $nascimento = $dia."/".$mes."/".$ano;*/
    //$nascimento = substr($nascimento, 9 , 2)."/".substr($nascimento, 9 , 2);
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
    //}else {  header("location: _controller/logout.php?inserir='nao'");exit();}
    // fim de bando de dados
?>
<hgroup class="pagina">
<h3>Enterprise >> Login >> Usuário</h3>
<h1><i class="fas fa-user"></i> &nbsp;&nbsp;Usuário<br/><br/>
 &nbsp;&nbsp; &nbsp;&nbsp;<a href="usuario.php">
 <i class="fas fa-arrow-circle-left"></i>Voltar</a></h1>
</hgroup>
<?php if((!isset($_REQUEST['alterar']))&&(!isset($_REQUEST['alterarSenha']))):?>
<div class="texto">
    <ul class="formmenu"> <?php if($resultado['idinscricao']>0)  ?>
        <li><a href="usuario.php?alterar=true" > <?php if($resultado['idinscricao']>0) 
        echo ""; ?> <i class="fas fa-address-card"></i>Meu Cadastro</a></li>
<?php 
        //login direto
        $idaluno = $_SESSION['ids'];
        $nCursos = $inscricao->inscrAluno($idaluno);
        
        foreach ($nCursos as $keyc1 => $dados){
            $matriz [] = $dados['idcurso'];
        }
    
        if($resultado['idinscricao']>0){
            echo "<li><a href='consulta.php?curso=" . $matriz[count($matriz)-1] //parei aqui
            . "'><i class='fas fa-graduation-cap'></i>Área do Aluno</a></li>";
        }
                //Root
		require_once './_model/UrlDb.php';
                $url = new UrlBD();
                $exect = false;
                $w = $url->getRoot();
                foreach ($w as $e){
                    if($e == $_SESSION['emails']){
                        $exect = true;
                    }
                }
                //echo $exect;
		if($exect){
                    echo '<li><a href="root.php" ><i class="fas fa-info-circle"></i> Acessar Intranet</a></li>';
		}
		//Root
        ?></ul>
    
    <h2 class="newsletter tituloform">Dados do Usuário</h2>            
    <table id="tabelaspec">
        <tr>
            <td colspan="3">Nome:<b><?php if(isset($_SESSION['emails'])){ echo $aluno->getNome();} ?></b></td>
        </tr>
        <tr>
            <td colspan="3">CPF:<b><?php if(isset($_SESSION['emails'])){ echo $aluno->getCpf();} ?></b></td>
        </tr>
        <tr>
            <td>End: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getRua();} ?></b> </td>
            <td>Nº: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getN();} ?></b></td>
            <td>Complemento <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getComplemento();} ?></b></td>
        </tr>
        <tr>
            <td>Bairro: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getBairro();} ?></b> </td>
            <td colspan="2">Cidade: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getCidade();} ?></b> </td>
        </tr>
        <tr>
            <td>CEP: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getCep();} ?></b> </td>
            <td colspan="2">Estado: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getUf();} ?></b> </td>
        </tr>  
        <tr>
            <td>Telefone: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getTel();} ?></b> </td>
            <td colspan="2">Celular: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getCel();} ?></b> </td>
        </tr>
        <tr>
            <td>E-mail: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getEmail();} ?></b></td>
            <td colspan="2">Cargo: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getProfissao();} ?></b></td>
        </tr>
    </table>
</div>
<?php elseif(isset($_REQUEST['alterarSenha'])):?>
<div id="texto">
    
    <h2 class="newsletter tituloform">Dados do Usuário</h2>
        <table id="tabelaspec">
            <tr>
                <td colspan="3">Nome:<b><?php if(isset($_SESSION['emails'])){ echo $aluno->getNome();} ?></b></td>
            </tr>
            <tr>
                <td colspan="3">CPF:<b><?php if(isset($_SESSION['emails'])){ echo $aluno->getCpf();} ?></b></td>
            </tr>
            <tr>
                <td>Telefone: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getTel();} ?></b> </td>
                <td colspan="2">Celular: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getCel();} ?></b> </td>
            </tr>
            <tr>
                <td>E-mail: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getEmail();} ?></b></td>
                <td colspan="2">Cargo: <b><?php if(isset($_SESSION['emails'])){ echo $aluno->getProfissao();} ?></b></td>
            </tr>
        </table>
    <form method="post" class="formmenu" action="_controller/alterar.php" name="formAlterarSenha" onsubmit="return validarAlterarSenha();" >  
    <fieldset id="senha"><legend>Senha</legend>
            <p><label for="cSenha">Senha:</label><input type="password" name="tCSenha" id="cCSenha " size="8" maxlength="20" placeholder="8 dígitos" />
            <label for="cSenha2">Confirmar Senha:</label><input type="password" name="tCSenha2" id="cCSenha2" size="8" maxlength="20" placeholder="8 dígitos" /></p>
    </fieldset>
    <!--<button name="tEnviar" type="submit" class="enviar radius">Enviar<i class="fas fa-arrow-circle-right"></i></button>-->
    <input name="tEnviar" type="submit" class="enviar radius" value="Enviar"/><i class="fas fa-arrow-circle-right"></i>
</form>
</div>
<?php else:?>
<div id="texto"> 
    <form method="post" class="formmenu" action="_controller/alterar.php" name="formCadastro" onsubmit="return validaAlterar();" >
    <ul><li><a href="usuario.php?alterarSenha=true"><i class="fas fa-key"></i>Alterar Senha</a></li> 
    <fieldset id="usuario"><legend>Cadastro do Usuário</legend>
    <fieldset id="sexo"><legend><i class="fas fa-address-card"></i>Dados do Usuário</legend><br/>
        <p><label for="cNome"> Nome: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" name="tNome" id="cNome" size="50" maxlength="40" placeholder="Nome Completo" <?php echo "value='".utf8_encode($nome) ."'"; ?> /></p>
            <p><label for="cNasc">Nascimento: &nbsp;&nbsp;&nbsp;</label><input type="date" name="tNasc" id="cNasc" <?php echo "value='$nascimento'"; ?>/>
    <label for="cCPF"> CPF. : </label>
	<input type="text" name="tCPF" id="cCPF" size="20" maxlength="20" placeholder="000.000.000-00" 
            <?php $numCpf = $aluno->numCPF($cpf); echo "value='$numCpf'"; ?> />
    <label for="cRG"> RG.: </label><input type="text" name="tRG" id="cRG" size="20" maxlength="20" placeholder="MG-00.000.000" <?php echo "value='$rg'"; ?>/></p>
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
               </select>
    <label for="cProf"> Profissão.: </label>
    <input type="text" name="tProf" id="cProf" size="20" maxlength="20" placeholder="Profissão" <?php echo "value='$profissao'"; ?> />
    <br/><label for="cMail">E-mail: </label><input type="email" name="tMail" id="cMail" size="35" maxlength="40" placeholder="exemple@gmail.com" <?php echo "value='$mail'"; ?>/>
    <br/><label for="cMail2">Confirme E-mail: </label><input type="email" name="tCMail2" id="cCMail2" size="35" maxlength="40" placeholder="exemple@gmail.com"/ <?php echo "value='$mail'"; ?>>
    <br/><label>Telefone Fixo : </label><input type="tel"  name="tTel" id="cTel" size="20" maxlength="20" placeholder="(xx)xxxx-xxxx" <?php echo "value='$tel'"; ?> />
   <label>Telefone Celular : </label><input type="tel" name="tCel" id="cCel" size="20" maxlength="20" placeholder="(xx)xxxxx-xxxx" <?php echo "value='$cel'"; ?>/>
  
   <fieldset><legend>Sexo</legend>
       <input type="radio" name="tSexo" id="cMasc" value="M" <?php if($sexo=='M'){ echo 'checked';} ?> /><label for="cMasc"> Masculino </label>
       <input type="radio" name="tSexo" id="cFem" value="F" <?php if($sexo=='F'){ echo 'checked';} ?> /><label for="cFem">Feminino</label></fieldset> </fieldset>
    <fieldset id="endereco"><legend>Endereço do Usuário</legend><br/>
    <label for="cRua">Logradouro: </label><input type="text" name="tRua" id="cRua" size="40" maxlength="80" placeholder="Rua, AV, Travessa... " <?php echo"value='$rua'"; ?>/>
    <label for="cBairro"> Bairro : </label><input type="text" name="tBairro" id="cBairro" size="20" maxlength="20" placeholder="Seu Bairro" <?php echo "value='$bairro'"; ?>/></p>
    <label for="cNum"> Número : &nbsp;</label><input type="text" name="tNum" id="cNum" min="0" max="99999" <?php echo "value='$n'"; ?>/>
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
        <br/><label for="cEst">Estado : &nbsp;&nbsp;&nbsp;</label><select name="tEst" id="cEst" <?php echo "value='$uf'"; ?>>
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
            <label>CEP.: </label>
            <input placeholder="00.000-000" type="text" size="25" maxlength="20" id="cCep" name="tCep" <?php echo "value='$cep'"; ?>/>
</fieldset>
<!--<button name="tEnviar" type="submit" class="enviar radius">Enviar<i class="fas fa-arrow-circle-right"></i></button>-->
<input name="tEnviar" type="submit" class="enviar radius" value="Enviar"/><i class="fas fa-arrow-circle-right"></i>
</fieldset> 
</form>
</div>
<?php endif;?>
<?php require_once "./footer.php"; ?>
<?php 
if(isset($_REQUEST['alterado'])) {
    echo "<script  type='text/javascript' >"
    . "alert('Dados alterados com sucesso!!!');</script>";
}
if(isset($_REQUEST['pricadastro'])){
  echo "<script  type='text/javascript' > 
          alert('Complete Seu Cadastro!');
         </script>";}
if(isset($_REQUEST['completarcadastro'])){
  echo '<script  type="text/javascript" > '
    . 'alert("Para Confirmar sua inscrição!\nÉ preciso completar seu cadastro!");'
    . '</script>';}
if(isset($_REQUEST['acesso'])){
    echo '<script  type="text/javascript">'
         . 'alert("Erro ao acessar o Sistema!\nSeu Usuário não possui permissão '
         . 'para acessar essa página!!!!");'
         . '</script>';
 }?>  