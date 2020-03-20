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
}else{
    header("Location: login.php?acesso='negado'");exit;
}
?>
<?php
    require_once './_model/classcursos.php';
    try {
        $conexaoCurso = new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $curso = new Cursos($conexaoCurso);
    $resultadoCurso = $curso->listar();
    
    //incio do banco de dados
    require_once './_model/classcustos.php';
    try {
        $conexao= new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $custos = new Custos($conexao);
    if(isset($_REQUEST['lancamento'])){
        $resultadoCusto = $custos->findCusto($_REQUEST['idcusto']);
    }elseif(isset($_REQUEST['alterar'])){
        $resultadoCusto = $custos->find($_REQUEST['idcurso']);
    }
?>
<?php require_once "./header.php"; ?>
<?php require_once "./menu.php"; ?>
<hgroup class="pagina">
<h3>Enterprise >> Login >> Usuário >> Root >> Custos</h3>
<h1>Intranet</h1>
   <h5><a href="usuario.php" >Lougout(Sair da Intranet)</a></h5>
   <div class="texto">
    <?php if(isset($_REQUEST['incluir'])): ?> <!-- Lançar Valores -->
    <h5><a href="custos.php" >Voltar</a></h5>
    <h1>&nbsp;&nbsp;&nbsp;&nbsp; Lançamentos de Custos</h1>
    <form method="get" id="fCusto" name="formCusto" class="formmenu" action="_controller/incluirCusto.php" 
          onsubmit="return validaCusto();"  oninput="calc_total();" >
    <fieldset id="usuario"><legend>Lançamentos Custos</legend>
        <fieldset id="usuario"><legend>Curso</legend>
        <label> Curso. : </label>
               <select id="iCurso" name="tCurso" >
                   <optgroup label="Curso">
                       <option value="">----------------------</option>
                       <?php 
                            foreach ($resultadoCurso as $c){
                                echo '<option value="' . $c['idcurso']
                                . '" >'. $c['nomecurso'] . " " . $c['previsao'] .'</option>';
                            };
                       ?>
                   </optgroup>
               </select>
        <br/>
        </fieldset>
        <fieldset id="usuario"><legend>Itens</legend>
            <label for="cProd">Descrição Prod.: </label><input type="text" name="tProd" 
            id="cProd" size="30" maxlength="30" placeholder="Descrição do Produto" />
        <br/>    
            <label for="cQtd">Quantidade:</label><input type="number" name="tQtd" id="cQtd" min="0" max="99999" value="0"
             placeholder="Quantidade" /> 
    
            <label for="cUn"> U.N. </label> 
            <input type="text" name="tUn" 
            id="cUn" size="5" maxlength="2" placeholder="U.N." /> 
        <br/>
            <label for="cPr">Preço Unitário :</label><input type="text" size="12"
                name="tPr" id="cPr" placeholder="Preço Unitário" /> 
            
            <label for="cTt">Valor Total:</label><input type="text" id="cTt" size="5"
                name="tTt" placeholder="Total" />        
    </fieldset>
    </fieldset>
    <!--<button name="tEnviar" type="submit" class="enviar radius" onsubmit="return validarSenha();">Enviar<i class="fas fa-arrow-circle-right"></i></button>-->
	<input name="tEnviar" type="submit" class="enviar radius" value="Enviar"/><i class="fas fa-arrow-circle-right"></i>
    </form>
    <?php elseif(isset($_REQUEST['alterar'])): ?> <!-- Lista Alterar Lançamentos -->
    <h5><a href="custos.php" >Voltar</a></h5>
    <h1> Lançamento do Curso de <?php echo $resultadoCusto[0]['nomecurso']; ?> </h1>
    <br/><br/><br/> 
    <table id='tabelaspec' ><tr><td><b>Produto:</b></td><td><b>Qtd:</b></td>
        <td><b>UN:</b><td><b>Data:</b></td><td><b>Preço Unit:</b></td>
        <td><b>Valor Total:</b></td><!--<td><b>Curso:</b></td>-->
        <?php
            foreach ($resultadoCusto as $i){
                echo '<tr><td class="cc"><b><a href="custos.php?lancamento=true&idcusto='.
                        $i['idcusto'].'"> '. $i['produto'] . '</a></b></td>';
                echo '<td>'. $i['qtd'] .'</td>';
                echo '<td>'. $i['un'] .'</td>';
                echo '<td class="cc">'. substr($i['datalancamento'],0,5) .'</td>';
                echo '<td class="valor">R$'.number_format($i['valorunit'],1,",",".") .'</td>';
                echo '<td class="valor">R$'. number_format($i['total'],1,",",".") .'</td>';
                //echo '<td class="cc">'. $i['nomecurso'] .'</td>';
                //echo '<td>'. $i['previsao'] .'</td>';
                //echo '<td class="valor">R$'. number_format($i['valor'],2,",",".") .'</td>';
                echo '</tr>';
            }
        ?>
    </table>
    <?php elseif(isset($_REQUEST['lancamento'])): ?> <!-- Formulário para Alterar Lançamentos -->
    <h5><a href="custos.php" >Voltar</a></h5>
    <h1>&nbsp;&nbsp;&nbsp;&nbsp; Alterar Lançamentos de Custos</h1>
    <form method="get" id="fCusto" name="formCusto" class="formmenu" action="_controller/alterarCusto.php " 
          onsubmit="return validaCusto();" oninput="calc_total();" >
    <fieldset id="usuario"><legend>Alterar Lançamentos Custos</legend>
        <fieldset id="usuario"><legend>Curso</legend>
        <label> Curso. : </label>
               <select id="iCurso" name="tCurso" >
                   <optgroup label="Curso">
                       <option value="">----------------------</option>
                       <?php 
                            foreach ($resultadoCurso as $c){
                                echo '<option value="' . $c['idcurso'].'"';
                                if($c['idcurso'] == $resultadoCusto['idcurso']){
                                    echo 'selected';
                                }
                                echo ' >'. $c['nomecurso'] . " - " . $c['previsao'] .'</option>';
                            };
                       ?>
                   </optgroup>
               </select>
        
        </fieldset>
        <br/>
        <fieldset id="usuario"><legend>Itens</legend> 
            <label for="cCusto">ID: </label><input type="text" name="tCusto" 
               <?php echo 'value="'.$resultadoCusto['idcusto'].'"'; ?> size="3"
                   id="cCusto" placeholder="ID" readonly="readonly" />
        <br/>
            <label for="cNome">Descrição Prod.: </label><input type="text" name="tProd" 
            <?php echo 'value="'.$resultadoCusto['produto'].'"'; ?>
            id="cProd" size="30" maxlength="30" placeholder="Descrição do Produto" />
        <br/>    
            <label for="cQtd">Quantidade:</label><input type="number" name="tQtd" id="cQtd" min="0" max="99999"
            <?php echo 'value="'.$resultadoCusto['qtd'].'"'; ?> 
            placeholder="Quantidade" /> 
        <br/>
            <label for="cUn"> U.N. </label> 
            <input type="text" name="tUn" 
            <?php echo 'value="'.$resultadoCusto['un'].'"'; ?>
            id="cUn" size="2" maxlength="2" placeholder="U.N." /> 
        <br/>
            <label for="cPr">Preço Unitário :</label><input type="text" size="5"
            <?php echo 'value="'.number_format($resultadoCusto['valorunit'],2,",",".").'"'; ?>
                name="tPr" id="cPr" placeholder="Preço Unitário" /> 
        <br/>    
            <label for="cTt">Valor Total:</label><input type="text" id="cTt" size="5"
            <?php echo 'value="'.number_format($resultadoCusto['total'],2,",",".").'"'; ?>
                name="tTt" placeholder="Total" /> 
    </fieldset>
    </fieldset>
    <!--<button name="tEnviar" type="submit" class="enviar radius" onsubmit="return validarSenha();">Enviar 
    <i class="fas fa-arrow-circle-right"></i></button>-->
	<input name="tEnviar" type="submit" class="enviar radius" value="Enviar"/><i class="fas fa-arrow-circle-right"></i>
    </form>
    <br/><br/>
    <h2 class="direita"><a <?php $url = new UrlBD(); $exect = false; $w = $url->getRoot();
		if($_SESSION['emails']==$w[0]) 
        echo 'href="_controller/excluirCusto.php?tCusto='. $resultadoCusto['idcusto'] .'"'; ?> 
            class="direita" > Excluir Lançamento</a></h2>
    <?php elseif(isset($_REQUEST['lista'])): ?><!--Lista -->
    <h5><a href="custos.php" >Voltar</a></h5>
    <h1><b>Lista Todos os Cursos:</b></h1><br/><br/><br/>
    <table id='tabelaspec' ><tr><td><b>Nome do Curso</b></td>
        <td><b>Instrutor</b><td><b>Previsão</b></td><!--<td><b>Carga</b></td>-->
        <!--<td><b>Total Aulas</b></td><td><b>Vagas</b></td>--><td><b>Valor</b></td></tr>
        <?php        
            foreach ($resultadoCurso as $curso){
                echo '<tr><td><b><a href="custos.php?alterar=true&idcurso='.$curso['idcurso'].'"> '. $curso['nomecurso'] . '</a></b></td>';
                //echo '<td>'. $curso['descricao'] . '</td>';
                echo '<td>'. $curso['instrutor'] . '</td>';
                echo '<td>'. $curso['previsao'] . '</td>';
                //echo '<td>'. $curso['carga'] . '</td>';
                //echo '<td>'. $curso['totaulas'] . '</td>';
                //echo '<td>'. $curso['vagas'] . '</td>';
                echo '<td class="valor"><b>R$'. number_format($curso['valor'],2,",",".") . '</b></td></tr>';
            }
        ?>
    </table>
    <?php else: ?>
    <h5><a href="root.php" >Voltar</a></h5>
    <h1>Menu Intranet</h1>
    <ol>
        <b><li><h4><a href="custos.php?incluir=true">Lançar Custo</a></h4></li></b>
        <b><li><h4><a href="custos.php?lista=true">Alterar Lançamentos</a></h4></li></b>
    </ol>
    <?php endif;?>
</div>
</hgroup>
<?php require_once "./footer.php"; ?>