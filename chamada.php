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
    require_once './_model/classchamada.php';
	//conexao
    try {
        $conexao = new \PDO($dsn, $username, $passwd);//cria conexão com banco de dadosX 
    } catch (\PDOException $ex) {
        die('Não foi possível estabelecer '
        . 'conexão com Banco de dados<br/>Erro Nº=> ' . $ex->getCode());
    }
    $chamada = new Chamada($conexao);
    $resultado = $chamada->findCursos(); //chamada para o banco de dados ?>
<?php require_once "./header.php"; ?>
<?php require_once "./menu.php"; ?>
<hgroup class="pagina">
<h3>Enterprise >> Login >> Usuário >> Chamada</h3>
<h1><i class="fas fa-user"></i> &nbsp;&nbsp; Intranet<br/><br/>
   &nbsp;&nbsp; &nbsp;&nbsp;<a href="usuario.php"><i class="fas fa-arrow-circle-left"></i>Voltar</a></h1>
<div class="texto">
<?php if(isset($_REQUEST['fazerchamada'])): ?>
<h5><a href="root.php" >Voltar</a></h5>
    <h1>&nbsp;&nbsp;&nbsp;&nbsp; Chamada de Aula Presencial</h1><br/><br/> <!-- Formulaio 1-->
    <form method="post" id="fusuario" name="formAula" class="formmenu" action="chamada.php" 
          onsubmit="return validaCurso();" >
    <?php $listaAlunos = $chamada->listaChamada($_REQUEST['fazerchamada']) ;
        $qtdcurso = $listaAlunos[0]['totaulas'];
        echo 'Aula : <select name="aula">';
        for ($i=1; $i <= $qtdcurso ; $i++){
            if (isset($_REQUEST['aula']) && $_REQUEST['aula'] == $i) {
                echo '<option selected value="' . $i .  '">' . $i . 'ª Aula</option>'; 
            }else {
                echo '<option value="' . $i .  '">' . $i . 'ª Aula</option>'; 
            }
        } 
        echo '</select>';
        if (isset($_REQUEST['fazerchamada'])) {
            echo 'Curso: <input type="text" size="2" value="'. $_REQUEST['fazerchamada'] . '" name="fazerchamada" readonly="readonly" />';
        } 
    ?>
     <br/><br/><input name="tEnviar" type="submit" class="enviar radius" value="Consultar"/><i class="fas fa-arrow-circle-right"></i>
    </form>
    <?php echo '<a href="chamada.php?rel=' . $listaAlunos[0]['idcurso'] . '&qtd=' . $qtdcurso . '">Relatório Completo</a>'; ?>
    <!-- Formulaio 2 -->
    <form method="post" id="fusuario" name="formChamada" class="formmenu" action="_controller/incluirChamada.php" 
          onsubmit="return validaCurso();" >
    <fieldset id="usuario"><legend>Chamada Curso</legend>
    <table id='tabelaspec' ><tr><td><b>Inscrição&nbsp;&nbsp;&nbsp;</b></td>
        <td><b>Aluno&nbsp;&nbsp;&nbsp;</b><td><b>Nome</b></td>
        <td><b>Nome Aluno</b></td><td><b>Presença&nbsp;&nbsp;&nbsp;</b></td></tr>      
        <?php $n = count($listaAlunos); 
            echo 'Quantidade Alunos: <input type="text" size="2" value="'. $n . '" name="qtd" readonly="readonly" />';
            echo ' - Código do Curso: <input type="text" size="2" value="' . $curso = $listaAlunos[0]['idcurso'] . '" name="curso" readonly="readonly" />';
            if (isset($_REQUEST['aula'])) {
                $aula = $_REQUEST['aula'];
            } else {
                $aula = 1;
            }
            if ($aula>1) {
                echo ' - Aula Nº: <input type="text" size="2" value="' .  $aula . '" name="aula" readonly="readonly" /><br/>';
            }else {
                echo ' - Aula Nº: <input type="text" size="2" value="1" name="aula" readonly="readonly" /><br/>';
            }
            $consulta = $chamada->statusAula($listaAlunos[0]['idcurso'],$aula); //se tem presenca
            $elementos = count($consulta);            
            echo 'Total de Aulas: <input type="text" size="2" value="' . $qtdcurso  . '" name="tt" readonly="readonly" />';
            echo ' -  Data da Aula: <input type="date" readonly="readonly" value="'. $consulta[0]['data'] .'" />';
            foreach ($listaAlunos as $key => $value) { 
                echo "<tr>";
                foreach ($value as $key2 => $value2) { // curso - aluno - inscricao  
                    if ($key2=="idinscricao") {
                        echo '<td> <input type="text" readonly="readonly" name="inscr'. $key .'" id="inscri" size="3" value="'. $value2. '"/></td>';
                    }elseif ($key2=="idaluno") {
                        echo '<td> <input type="text" readonly="readonly" name="id'. $key .'" id="id" size="3" value="'. $value2. '"/></td>';
                    } 
                    else if($key2<>"idcurso" && $key2<>"totaulas"){
                        echo '<td>'. $value2. '</td>';
                    } 
                }
                for ($i=0; $i < count($consulta) ; $i++) { //consulta no banco de dados
                    if ($listaAlunos[$key]['idaluno'] == $consulta[$i]['idaluno']) {
                        if ($consulta[$i]['tipo']=="P") {
                            echo '<td><select name="status' . $key . '"> <option selected value="P">P</option><option value="F">F</option></select> </td>';
                        }else {
                            echo '<td><select name="status' . $key . '"> <option value="P">P</option><option selected value="F">F</option></select> </td>';
                        }
                    }
                }
                if($elementos == 0) { //caso for = zero na consulta
                    echo '<td><select name="status' . $key . '"> <option selected value="P">P</option><option value="F">F</option></select> </td>';
                }
                echo "</tr>";
            } ?>
    </table>
    </fieldset>
    <input name="tEnviar" type="submit" class="enviar radius" value="Enviar"/><i class="fas fa-arrow-circle-right"></i>
    </form>
<?php elseif(isset($_REQUEST['rel'])): ?> <!-- relatorio -->
<h5><a href="chamada.php" >Voltar</a></h5>
    <h1><b>Relatório de Presença:</b></h1><br/><br/><br/>
    <table id='tabelaspec' ><tr><td><b>Inscrição</b></td>
        <td><b>Nome</b>
        <?php $qtd = $_REQUEST['qtd']; $n_curso = $_REQUEST['rel'];
              $consulta = $chamada->listaChamada($n_curso);
              //colocar colunas
              for ($i=1; $i <= $qtd ; $i++) { 
                  echo "<td>$i ª Aula</td>";
              } echo "</tr>";
            foreach ($consulta as $key => $value) {
                echo "<tr>";
                foreach ($value as $key2 => $value2) {
                    if ($key2<>"idcurso" && $key2<>"idaluno" && $key2<>"totaulas" && $key2<>"nomecurso") {
                        echo "<td>" . $value2 . "</td>";
                    }
                }
                $aluno = $consulta[$key]['idinscricao'];
                for ($i=1; $i <= count($consulta) ; $i++) { // até o final numeros de alunos
                    $statusPF = $chamada->statusAula($n_curso,$i); //faz consulta no banco de dados curso e aula 1, 2 ,3 e 4 aulas
                    foreach ($statusPF as $key3 => $value3) { //1 for da matriz
                        foreach ($value3 as $key4 => $value4) { // 2 for da matriz
                            if ($key4=="Inscricao") { // se for inscricao 
                                if(substr($value4,1,10) == $aluno){ // se incricao for = aluno 
                                    echo "<td>" . $statusPF[$key3]['tipo']  . "</td>";
                                }
                            }
                        }
                    }
                } echo "</tr>";
            }
            for ($x=1; $x <= $qtd; $x++) { 
                $statusPF = $chamada->statusAula($n_curso,$x);
                if (count($statusPF) > 0) {
                    $data =  date("d/m/Y", strtotime($statusPF[0]['data']));
                    echo  $x . "ª Aula - $data <br/>";
                }
            }   
        ?>
    </table>

<?php else:?> <!-- Menu -->
    <h5><a href="root.php" >Voltar</a></h5>
    <h1><b>Lista de Cursos:</b></h1><br/><br/><br/>
    <table id='tabelaspec' ><tr><td><b>Nome do Curso</b></td>
        <td><b>Instrutor</b><td><b>Previsão</b></td><!--<td><b>Carga</b></td>-->
        <td><b>Total Aulas</b></td><td><b>Vagas</b></td><!--<td><td><b>Valor</b></td></tr></td>-->
        <?php        
            foreach ($resultado as $curso){
                echo '<tr><td><b><a href="chamada.php?fazerchamada='.$curso['idcurso'].'"> '. $curso['nomecurso'] . '</a></b></td>';
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
<?php endif;?>
</div>
</hgroup>
<?php require_once "./footer.php"; ?>