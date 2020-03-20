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
<?php
    require_once './_model/classcursos.php';
	//conexao
    try {
        $conexaoCurso = new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $curso = new Cursos($conexaoCurso);
    $resultadoCurso = $curso->consult();
    if (isset($_REQUEST['curso'])){
        $resultadoCurso = $curso->find($_REQUEST['curso']);
    }else {
        $resultadoCurso = $curso->consult();
    }
    //incio do banco de dados
    require_once './_model/classinscricao.php';
    try {
        $conexao= new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $inscricao = new Inscricao($conexao);
    //$resultado = $inscricao->inscrAluno($idaluno);
    if(isset($_REQUEST['alterarcurso'])){
        $id = $curso->setId(trim(strip_tags($_REQUEST['tId'])));
        $nomeCurso = $curso->setNomeCurso(ucwords(strtolower(trim(strip_tags($_REQUEST['tNome'])))));
        $descricao = $curso->setDescricao(ucwords(strtolower(trim(strip_tags($_REQUEST['tDescr'])))));
        $intrutor = $curso->setInstrutor(ucwords(strtolower(trim(strip_tags($_REQUEST['tInstr'])))));
        $previsao = $curso->setPrevisao(trim(strip_tags($_REQUEST['tPrevisao'])));
        $vagas = $curso->setVagas(trim(strip_tags($_REQUEST['tVagas'])));
        $valor = $curso->setValor(trim(strip_tags($_REQUEST['tValor'])));
        if($nomeCurso != "" && $descricao != "" && $intrutor != "" && 
           $previsao != ""  &&  $vagas != "" && $valor != ""){
           $curso->alterar($curso->getId());}
    }
    if(isset($_REQUEST['inscricoes'])){
        $resultado = $inscricao->findcurso($_REQUEST['inscricoes']);
        $numIncricoes = $inscricao->contarinscritos($_REQUEST['inscricoes']);
    }
    if(isset($_REQUEST['inscricao'])){
       $consultarInscricao = $inscricao->inscrNum($_REQUEST['inscricao']);
    }
    if(isset($_REQUEST['inscricoes'])){//somente na lista de incrições
        //incio do banco de dados
        require_once './_model/classcustos.php';
        try {
            $conexaocusto = new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
        } catch (\PDOException $ex) {
            die('Não foi possível estabelecer '
            . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
        }
        $custos = new Custos($conexaocusto);
        $resultadoCusto = $custos->find($_REQUEST['inscricoes']);
    }
?>
<?php require_once "./header.php"; ?>
<?php require_once "./menu.php"; ?>
<hgroup class="pagina">
<h3>Enterprise >> Login >> Usuário >> Root</h3>
<h1><i class="fas fa-user"></i> &nbsp;&nbsp; Intranet<br/><br/>
   &nbsp;&nbsp; &nbsp;&nbsp;<a href="usuario.php"><i class="fas fa-arrow-circle-left"></i>Voltar</a></h1>
<div class="texto">
<?php if(isset($_REQUEST['incluircurso'])): ?> <!-- Formulário 1 -->
    <h5><a href="root.php" >Voltar</a></h5>
    <h1>&nbsp;&nbsp;&nbsp;&nbsp; Incluir Novo Curso </h1>
    <form method="post" id="fusuario" name="formCurso" class="formmenu" action="_controller/incluirCurso.php" 
          onsubmit="return validaCurso();" >
    <fieldset id="usuario"><legend>Incluir Curso</legend>
        <label for="cNome">Nome do Curso: </label><input type="text" name="tNome" 
            id="cNome" size="30" maxlength="30" placeholder="Nome do Curso" />
        <br/>
        <label for="cDescr">Descrição Curso:</label> <br/>
        <textarea name="tDescr" id="cDescr" cols="30" rows="2" placeholder="Descrição do Curso" ></textarea>
       <br/>
        <label for="cInstr">Instrutor(a) . : . </label> &nbsp;&nbsp; 
       <input type="text" name="tInstr" 
            id="cInstr" size="30" maxlength="30" placeholder="Instrutor" /> 
            <br/>
            <label for="cPrevisao">Previsão do Início : </label><input type="text" name="tPrevisao" 
            id="cPrevisao" size="20" maxlength="40" placeholder="Previsão" /><br/> 
            <label for="cCarga"> Carga Horária do Curso : </label><input type="text" name="tCarga" 
            id="cCarga" size="10" maxlength="5" placeholder="Carga" /> <br/>
       
            <label for="cTot"> Total Aulas Curso . : </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" name="tTot" id="cTot" size="10" maxlength="5" placeholder="Aulas" /> <br/>
            <label for="cVagas">Vagas Abertas para Curso: </label><input type="text" name="tVagas" 
            id="cVagas" size="10" maxlength="6" placeholder="Vagas" /> <br/>
       
            <label for="cValor">Valor Integral Curso: </label><input type="text" name="tValor" 
            id="cValor" size="10" maxlength="6" placeholder="Valor" /> 
            
    </fieldset>
    <!--<input type="image" name="cadastrocurso" src="_imagens/botao-enviar.png" onsubmit="return validarSenha();" />-->
    <!--<button name="tEnviar" type="submit" class="enviar radius" onsubmit="return validarSenha();">Enviar<i class="fas fa-arrow-circle-right"></i></button>-->
	<input name="tEnviar" type="submit" class="enviar radius" value="Enviar"/><i class="fas fa-arrow-circle-right"></i>
    </form>
<?php elseif(isset($_REQUEST['curso'])): ?> <!-- Formulário 2 -->
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo ucwords($resultadoCurso['nomecurso']); ?> </h1>
<form method="post" id="fCurso" name="formCurso" class="formmenu" action="_controller/alterarCurso.php" 
          onsubmit="return validaCurso();" >
    <fieldset id="usuario"><legend>Alterar Curso</legend>
        
            <label for="cId">ID Curso . : . </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="number" name="tId" 
            id="cId" min="0" max="9999" placeholder="ID Curso"  readonly="readonly"
            value=<?php echo "'" .$resultadoCurso['idcurso'] . "'"; ?> />
        <br/>
        <label for="cNome">Nome do Curso: </label><input type="text" name="tNome" 
            id="cNome" size="30" maxlength="30" placeholder="Nome do Curso"  
            value=<?php echo "'" .$resultadoCurso['nomecurso'] . "'"; ?> />
        <br/>
        
            <label for="cDescr">Descrição Curso:</label><br/>
            <textarea name="tDescr" id="cDescr" cols="30"rows="2" placeholder="Descrição" 
            ><?php echo $resultadoCurso['descricao']; ?></textarea>
        <br/>
            <label for="cInstr">Instrutor(a) . : . </label> &nbsp;&nbsp;&nbsp;
            <input type="text" name="tInstr" 
            id="cInstr" size="30" maxlength="40" placeholder="Instrutor"  
            value=<?php echo "'" .$resultadoCurso['instrutor'] . "'"; ?> /> 
        <br/>
            <label for="cPrevisao">Previsão de Início: </label><input type="text" name="tPrevisao" 
            id="cPrevisao" size="12" maxlength="40" placeholder="Previsão"  
            value=<?php echo "'" .$resultadoCurso['previsao'] . "'"; ?> /> 
        <br/>    
            <label for="cCarga"> Carga Horária do Curso . : </label><input type="text" name="tCarga" 
            id="cCarga" size="4" maxlength="5" placeholder="Carga"  
            value=<?php echo "'" .$resultadoCurso['carga'] . "'"; ?> /> 
        <br/>    
            <label for="cTot"> Total Aulas do Curso: </label><input type="text" name="tTot" 
            id="cTot" size="1" maxlength="5" placeholder="Aulas"  
            value=<?php echo "'" .$resultadoCurso['totaulas'] . "'"; ?> /> 
        <br/>
        <label for="cVagas">Vagas Abertas para Curso: </label><input type="text" name="tVagas" 
            id="cVagas" size="6" maxlength="6" placeholder="Vagas"  
            value=<?php echo "'" .$resultadoCurso['vagas'] . "'"; ?> /> 
        <br/>    
        <label for="cValor">Valor Integral do Curso: </label><input type="text" name="tValor" 
            id="cValor" size="6" maxlength="6" placeholder="Valor"  
            value=<?php echo "'" . number_format($resultadoCurso['valor'],2,",",".") . "'"; ?> /> 
    </fieldset>
    <!--<button name="tEnviar" type="submit" class="enviar radius" onsubmit="return validarSenha();">Enviar 
    <i class="fas fa-arrow-circle-right"></i></button>-->
	<input name="tEnviar" type="submit" class="enviar radius" value="Enviar"/><i class="fas fa-arrow-circle-right"></i>
    <h2 class="direita"><a <?php $url = new UrlBD(); $exect = false; $w = $url->getRoot();
        if($_SESSION['emails']==$w[0]) 
        echo 'href="_controller/excluirCurso.php?id='. $resultadoCurso['idcurso'] .'"'; ?> 
            class="direita" > Excluir Curso</a></h2>
    </form>
<?php elseif(isset($_REQUEST['listacurso'])): ?><!-- Lista de Cursos -->
    <h5><a href="root.php" >Voltar</a></h5>
    <h1><b>Lista de Todos os Cursos:</b></h1><br/><br/><br/>
    <table id='tabelaspec' ><tr><td><b>Nome do Curso</b></td>
        <td><b>Instrutor</b><td><b>Previsão</b></td><!--<td><b>Carga</b></td>-->
        <td><b>Total Aulas</b></td><td><b>Vagas</b></td><!--<td><b>Valor</b></td></tr>-->
        <?php        
            foreach ($resultadoCurso as $curso){
                echo '<tr><td class="cc"><b><a href="root.php?curso='.$curso['idcurso'].'"> '. $curso['nomecurso'] . '</a></b></td>';
                //echo '<td >'. $curso['descricao'] . '</td>';
                echo '<td class="cc">'. $curso['instrutor'] . '</td>';
                echo '<td>'. $curso['previsao'] . '</td>';
                //echo '<td class="cc">'. $curso['carga'] . '</td>';
                echo '<td>'. $curso['totaulas'] . '</td>';
                echo '<td class="cc">'. $curso['vagas'] . '</td>';
                //echo '<td class="valor"><b>R$'. number_format($curso['valor'],2,",",".") . '</b></td></tr>';
            }
        ?>
    </table>
<?php elseif(isset($_REQUEST['listacursoinscricao'])): ?> <!-- Lista de Inscrição -->
    <h5><a href="root.php" >Voltar</a></h5>
    <h1><b>Lista de Cursos:</b></h1><br/><br/><br/>
    <table id='tabelaspec' ><tr><td><b>Nome do Curso</b></td>
        <td><b>Instrutor</b><td><b>Previsão</b></td><!--<td><b>Carga</b></td>-->
        <td><b>Total Aulas</b></td><td><b>Vagas</b></td><!--<td><td><b>Valor</b></td></tr></td>-->
        <?php        
            foreach ($resultadoCurso as $curso){
                echo '<tr><td><b><a href="root.php?inscricoes='.$curso['idcurso'].'"> '. $curso['nomecurso'] . '</a></b></td>';
                //echo '<td>'. $curso['descricao'] . '</td>';
                echo '<td class="cc">'. $curso['instrutor'] . '</td>';
                echo '<td>'. $curso['previsao'] . '</td>';
                //echo '<td class="cc">'. $curso['carga'] . '</td>';
                echo '<td>'. $curso['totaulas'] . '</td>';
                echo '<td class="cc">'. $curso['vagas'] . '</td>';
                //echo '<td class="valor"><b>R$'. number_format($curso['valor'],2,",",".") . '</b></td></tr>';
            }
        ?>
    </table>
<?php elseif(isset($_REQUEST['inscricoes'])): ?> <!-- Lista 3 Inscrições -->
    <h5><a href="root.php?listacursoinscricao=true" >Voltar</a></h5>
    <h1><b> Lista de Inscritos <i> <?php $n = $numIncricoes[0]['count(*)'];
        if($n>0) { echo $resultado[0]['nomecurso'];} ?>:</i></b></h1><br/>
    <?php 
        $pago=0;$pendente=0;$gratis=0;$professor=0;$ipago=0;$ipendente=0;
        foreach ($resultado as $i){
            if($i['idaluno']!=1){
            if($i['statuspgto']=='PAGO'){
                $pago+=($i['valor']*$i['desconto']);
                $ipago++;
            }elseif ($i['statuspgto']=='PENDENTE') {
                $pendente+=($i['valor']*$i['desconto']);
                $ipendente++;
            }elseif ($i['statuspgto']=='GRATUITO') {
                $gratis++;
            }
        }  else {
            $professor++;
        }   
        }
    ?>
    <h4> <?php 
        $inscritos = $numIncricoes[0]['count(*)'];
        $valor = $resultado[0]['valor'];
        echo '<h4>Valor da Inscrição: <span class="valor"> R$'. number_format($valor,2,",",".").'</span></h4>';
        echo '<h5>'.$ipago.' -- Alunos Efetuaram Pagamento <br/>';
        echo $ipendente.' -- Alunos Pagamento Pendentes <br/>';
        if ($gratis>0){
        echo $gratis.' -- Gratuito <h5/>';}
        else{echo '<h5/>';
        };
        $total = ($pago+$pendente); 
        $desc = ($total*0.2);
        $valorPago = $pago;
        $valorPendente = $pendente;
        ?> <br/> </h4>
    <h4> <?php echo $inscritos-$gratis-$professor;  ?> Alunos -- Inscritos Nesse Curso.</h4>
    <br/><br/>
    <?php $custo = 0;
        foreach ($resultadoCusto as $c){
            $custo+= $c['total'];
        }
    ?>
    <table id='tabelaspec' ><tr><td><b>Nº Inscrição:</b></td><td><b>Nome do Aluno:</b></td>
         <!--<td><b>Contato:</b></td>--><td><b>Data da Inscrição:</b></td><td><b>Status Pgto:</b></td>
         <td><b>Valor:</b></td></tr>
        <?php
            foreach ($resultado as $i){
            if ($i['idaluno']!=1){//para nunca pegar minha inscrição welington
                echo '<tr><td class="cc"><b><a href="root.php?inscricao='.$i['idinscricao'].'"> '. $i['idinscricao'] . '</a></b></td>';
                echo '<td>'. $i['nomealuno'] .'</td>';
                //echo '<td class="cc">'. $i['cpf'] .'</td>';
                //echo '<td>'. $i['email'] .'</td>';
                /*if ($i['tel'] != "" && $i['cel'] != "" ) {
                    echo '<td class="cc">'. $i['tel'] . " / " . $i['cel'] .'</td>';
                    echo '<td class="cc">'. substr($i['cel'],3);
                }else if ($i['tel'] != ""){
                    echo '<td class="cc">'. substr($i['tel'],3);
                }else if ($i['cel'] != "") {
                    echo '<td class="cc">'. substr($i['cel'],3);
                }*/
                echo '<td>'. substr($i['datainscricao'],0,5) .'</td>';
                if($i['statuspgto']=='PAGO'){
                    echo '<td class="pago">'. $i['statuspgto'] .'</td>';
                }elseif ($i['statuspgto']=='GRATUITO') {
                    echo '<td class="gratis">'. $i['statuspgto'] .'</td>';
                }  else {
                    echo '<td class="pendente">'. substr($i['statuspgto'],0,4) .'</td>';
                }
                if($i['statuspgto']!='GRATUITO'){
                    echo '<td class="valor"> R$'. number_format(($i['valor']*$i['desconto']),2,",",".") .'</td>';
                }  else {
                    echo '<td class="valor">  ----- </td>';
                }
                echo '</tr>';
            }
            }
        ?>
        <tr><td class="ce" colspan="3"><b>Faturamento Total do Curso:</b></td>
            <td class="valor" colspan="2"> <?php         
            echo 'R$' . number_format($total,2,",",".");?>  </td></tr>
    
        <tr><td class="ce" colspan="3"><b>Valor Aluguel do Laboratório:</b></td>
            <td class="valor" colspan="2"> 
                <?php echo 'R$' . number_format($desc,2,",",".");?>  </td></tr>
        <tr><td class="ce" colspan="3"><b>Descontos(-Impostos-Taxas-Descontos) :</b></td>
            <td class="valor" colspan="2"> 
                <?php echo 'R$' . number_format($custo,2,",",".");?>  </td></tr>
        
        <tr><td  class="ce" colspan="3"><b>Valor Recebido do Curso:</b></td>
            <td class="valor" colspan="2"> <?php         
            echo 'R$' . number_format($valorPago,2,",",".");?>  </td></tr>
        
        <tr><td class="ce" colspan="3"><b>Valor Pendente do Curso:</b></td>
            <td class="valor" colspan="2"> <?php         
            echo 'R$' . number_format($valorPendente,2,",",".");?>  </td></tr>
        
        <tr><td class="ce" colspan="3"><b>Lucro Previsto do Curso:</b></td>
            <td class="valor" colspan="2"> <?php $lucro = ($total-$desc-$custo)/2;        
            echo 'R$' . number_format($lucro,2,",",".");?>  </td></tr>
        
    </table>
<?php elseif(isset($_REQUEST['inscricao'])): ?> <!-- Formulário 3 Inscrição -->
<form method="post" id="fInscr" class="formmenu" name="formInscr" action="_controller/alterarInscricao.php" onsubmit="return validaDesconto();">
    <?php echo "<h2><a href='upload.php?aluno=" . $consultarInscricao[0]['idaluno']
           . "&curso=" . $consultarInscricao[0]['idcurso'] . "&inscricao="
           . $consultarInscricao[0]['idinscricao'] ."&nome=" . $consultarInscricao[0]['nomealuno'] . 
            "'>Inserir Arquivos para o Aluno</a></h2>";?>
    <h1><b>Status de Inscrição:</b></h1><br/><br/><br/>
    
    <table id='tabelaspec' ><tr><td><b>Campo</b></td><td><b>Dados</b></td></tr>
        <tr><td><b>Nº Inscrição:</b></td> <td> <b> <input type="text" size="5" name="tInscricao" id="cInscricao" readonly="readonly"
           value="<?php echo $consultarInscricao[0]['idinscricao']; ?>" /></b></td></tr>
        <tr><td><b>Nome do Aluno:</b></td> <td> <?php echo $consultarInscricao[0]['nomealuno']; ?></td></tr>
        <tr><td><b>CPF:</b></td><td> <b> <?php echo $consultarInscricao[0]['cpf']; ?> </b> </td> </tr>
    <tr><td><b>E-mail:</b> </td><td> <?php echo $consultarInscricao[0]['email']; ?> </td> </tr>
    <tr><td><b>Contato:</b> </td><td> <?php echo $consultarInscricao[0]['tel'] . "||" . $consultarInscricao[0]['cel'] ; ?> </td> </tr>
    <tr><td><b>Data da Inscrição:</b> </td><td> <b> <?php echo $consultarInscricao[0]['datainscricao']; ?> </b></td> </tr>
    <tr><td><b>Curso:</b> </td><td> <b>  <!--Início Formulário de busca curso-->
            <select name="curso" id="curso">
                <optgroup label="curso">
                <?php  
                    //var_dump($resultadoCurso)
                    $curso = $consultarInscricao[0]['idcurso'];
                    foreach ($resultadoCurso as $key => $value) {
                        foreach ($value as $key2 => $dados) {
                            //var_dump($key2);
                            if ($key2=="idcurso") {
                                if ($dados['idcurso']==$curso) {
                                    $r = "selected";  
                                } else {
                                    $r = "";  
                                }
                                echo "<option value='" . $dados['idcurso']
                                . "' $r >" . $value['nomecurso'] . " - "  . $value['previsao']  . "</option>"; 
                                }
                            }
                        }
                ?>
                </optgroup>
            </select> <!--Fim Formulário de busca de curso-->
    </b></td> </tr>
    <tr><td><b>% Desconto:</b> </td><td> <input type="text" name="tDesconto" id="cDesconto" 
        <?php $desconto =$consultarInscricao[0]['desconto'];
        $desconto = 1-$desconto;
        $desconto*=100;
        if ($desconto!=0){
           echo 'value="'.number_format($desconto,2,",",".").'"'; 
        } else {
           echo 'value="-"'; 
        }
         ?> size="6"/> </td> </tr>
    <tr><td><b>Valor:</b> </td><td class="valor"> <b> <span class="valor" > 
        <?php if($consultarInscricao[0]['statuspgto']!="GRATUITO"){
            $valor = $consultarInscricao[0]['valor'];
            $valor *= $consultarInscricao[0]['desconto'];
        echo 'R$'.number_format($valor,2,",",".");}
        else { echo 'R$ -';} ?> </span> </b></td> </tr>
    <tr><td><b>Status Pgto:</b> </td><td> <?php $valor = $consultarInscricao[0]['statuspgto']; ?> 
            <select name="tPg" id="cPg" class="valor">
                <optgroup label="Status">
                    <option value="PAGO" <?php if($valor=='PAGO'){ echo 'selected';} ?> >PAGO</option>
                    <option value="PENDENTE" <?php if($valor=='PENDENTE'){ echo 'selected';} ?> >PENDENTE</option>
                    <option value="GRATUITO" <?php if($valor=='GRATUITO'){ echo 'selected';} ?> >GRATUITO</option>
                </optgroup>
            </select>
            </td> </tr>
    </table>
    <br/><br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <!--<button name="tEnviar" type="submit" class="enviar radius" onsubmit="return validarSenha();">Enviar 
    <i class="fas fa-arrow-circle-right"></i></button>-->
    <input name="tEnviar" type="submit" class="enviar radius" value="Enviar"/><i class="fas fa-arrow-circle-right"></i>
    <h2 class="direita"><a <?php $url = new UrlBD(); $exect = false; $w = $url->getRoot();
        if($_SESSION['emails']==$w[0]) 
        echo 'href="_controller/excluirInscricao.php?inscricao='. $consultarInscricao[0]['idinscricao'] .'"'; ?> 
            class="direita" > Excluir Inscrição</a></h2>
    </form>
<?php else:?> <!-- Menu -->
    <h1>Menu Intranet</h1>
    <ol>
        <b><li><h4><a href="root.php?incluircurso=true">Incluir Novo Curso</a></h4></li></b>
        <b><li><h4><a href="root.php?listacurso=true">Listar Todos os Cursos</a></h4></li></b>
        <b><li><h4><a href="root.php?listacursoinscricao=true">Inscrições por Curso</a></h4></li></b>
        <b><li><h4><a href="listaAlunos.php">Listar todos Alunos Cadastrados</a></h4></li></b>
        <b><li><h4><a href="custos.php">Lançar Custos</a></h4></li></b>
        <b><li><h4><a href="chamada.php">Chamada</a></h4></li></b>
    </ol>
<?php endif;?>
</div>
</hgroup>
<?php require_once "./footer.php"; ?>