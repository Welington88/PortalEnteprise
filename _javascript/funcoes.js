function preload(){
    for(f=1;f<=6;f++){
        imgs = Array('home'+ f +'.png');
    }
    imgQtde = imgs.length;
    for(i=0;i<imgQtde;i++){
        var preloadimg = new Image();
        preloadimg.src=imgs[i];
    }
}
function mudaFoto (foto) {
/* funcao mudaFoto recebe um parametro foto */
document.getElementById("icone").src = foto;
}
function mudaLink(link){
  document.getElementById("principal").href = link;
}
function iniciaSlider(){
    preload();
    min=1;//inicia o slide
    max=6;//ultimo slide 
    fi=min;
    carregaFoto("_imagens/home1.png");
    tmp=5000;
    tmr=setInterval(trocaFoto,tmp);
}
function carregaFoto(foto){
    document.getElementById("moldura").style.backgroundImage=("URL("+ foto +")");
}
function trocaFoto(){
    fi++;
    if(fi>max){
        fi=min;
    }
    carregaFoto("_imagens/home"+ fi +".png");
    switch (fi){
        case 1:
            mudaLink("combo.php");
            break;
        case 2:
            mudaLink("cursos.php");
            break;
        case 3:
            mudaLink("excelavancado.php");
            break;
        case 4:
            mudaLink("contato.php");
            break;
        case 5:
            mudaLink("excelbasico.php");
            break;
        case 6:
            mudaLink("noticiaqualificacao.php");
            break;
        default:
            mudaLink("cursos.php");
    }
}
function ant(){
    clearInterval(tmr);
    fi--;
    if(fi<min){
        fi=max;
    }
    carregaFoto("_imagens/home"+ fi +".png");
    tmr=setInterval(trocaFoto,tmp);
    switch (fi){
        case 1:
            mudaLink("combo.php");
            break;
        case 2:
            mudaLink("cursos.php");
            break;
        case 3:
            mudaLink("excelavancado.php");
            break;
        case 4:
            mudaLink("contato.php");
            break;
        case 5:
            mudaLink("excelbasico.php");
            break;
        case 6:
            mudaLink("noticiaqualificacao.php");
            break;
        default:
            mudaLink("cursos.php");
    }
}
function prox(){
    clearInterval(tmr);
    fi++;
    if(fi>max){
        fi=min;
    }
    carregaFoto("_imagens/home"+ fi +".png");
    tmr=setInterval(trocaFoto,tmp);
    switch (fi){
        case 1:
            mudaLink("combo.php");
            break;
        case 2:
            mudaLink("cursos.php");
            break;
        case 3:
            mudaLink("excelavancado.php");
            break;
        case 4:
            mudaLink("contato.php");
            break;
        case 5:
            mudaLink("excelbasico.php");
            break;
        case 6:
            mudaLink("noticiaqualificacao.php");
            break;
        default:
            mudaLink("cursos.php");
    }
}
function validaCadastro(){
    if(document.formCadastro.tNome.value == ""){
        alert("Campo Nome não foi preenchido!!!");
        document.formCadastro.tNome.focus();
        return false;
    }
    if(document.formCadastro.tCPF.value == ""){
        alert("Campo CPF não foi preenchido!!!");
        document.formCadastro.tCPF.focus();
        return false;
    }
    var cpf = document.getElementById("cCPF").value;
    if(validaCPF(cpf)){}else{
	alert("CPF Invalido!!!");
        document.formCadastro.cCPF.focus();
	return false;
    }
    if(document.formCadastro.tMail.value == ""){
        alert("Campo E-mail não foi preenchido!!!");
        document.formCadastro.tMail.focus();
        return false;
    }
     if(document.formCadastro.tCMail2.value == ""){
        alert("Campo Confirma E-mail não foi preenchido!!!");
        document.formCadastro.tCMail2.focus();
        return false;
    }
    if(document.formCadastro.tTel.value == "" &&
       document.formCadastro.tCel.value == ""){
        alert("Campo Telefone Fixo ou Móvel Não foi preenchido!!!");
        document.formCadastro.tTel.focus();
        return false;
    }
    var email1,email2;
    email1 = document.getElementById("cMail").value;
    email2 = document.getElementById("cCMail2").value;
    if(email1 != email2) {
        alert("o E-mail's digitados estão diferente um do outro!!!");
        document.formCadastro.tMail.focus();
        return false;
    }
}
function validarAlterarSenha (){
    if(document.formAlterarSenha.tCSenha.value === ""){
        alert("Campo Senha não foi preenchido!!!");
        document.formAlterarSenha.tCSenha.focus();
        return false;
    }
    if(document.formAlterarSenha.tCSenha2.value === ""){
        alert("Campo Confirma Senha não foi preenchido!!!");
        document.formAlterarSenha.tCSenha2.focus();
        return false;
    }
    var senha1,senha2;
    senha1 = document.getElementById("cCSenha").value;
    senha2 = document.getElementById("cCSenha2").value;
    
    if(senha1 !== senha2) {
        alert("Senhas digitadas estão diferente uma do outra!!!");
        document.formAlterarSenha.tCSenha.focus();
        document.formAlterarSenha.tCSenha2.focus();
        return false;
    }
}
function validaCPF(cpf){
    var numeros, digitos, soma, i, resultado, digitos_iguais;
    digitos_iguais = 1;
    if (cpf.length < 11)
          return false;
    for (i = 0; i < cpf.length - 1; i++)
          if (cpf.charAt(i) != cpf.charAt(i + 1)){
                digitos_iguais = 0;
                break;}
    if (!digitos_iguais){
          numeros = cpf.substring(0,9);
          digitos = cpf.substring(9);
          soma = 0;
          for (i = 10; i > 1; i--)
                soma += numeros.charAt(10 - i) * i;
          resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
          if (resultado != digitos.charAt(0))
                return false;
          numeros = cpf.substring(0,10);
          soma = 0;
          for (i = 11; i > 1; i--)
                soma += numeros.charAt(11 - i) * i;
          resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
          if (resultado != digitos.charAt(1))
                return false;
	        return true;
          }
    else
        return false;
  }
  function validaLogin(){
    if(document.formLogin.login.value == ""){
        alert("Campo E-mail não foi preenchido!!!");
        document.formLogin.login.focus();
        return false;
    }
    if(document.formLogin.senha.value == ""){
        alert("Campo Senha não foi preenchido!!!");
        document.formLogin.senha.focus();
        return false;
    }
  }
  function validaAlterar(){
    if(document.formCadastro.tNome.value == ""){
        alert("Campo Nome não foi preenchido!!!");
        document.formCadastro.tNome.focus();
        return false;
    }
    if(document.formCadastro.tNasc.value == ""){
        alert("Campo Nascimento Não foi preenchido!!!");
        document.formCadastro.tNasc.focus();
        return false;
    }
    if(document.formCadastro.tCPF.value == ""){
        alert("Campo CPF não foi preenchido!!!");
        document.formCadastro.tCPF.focus();
        return false;
    }
    var cpf = document.getElementById("cCPF").value;
    if(validaCPF(cpf)){}else{
	alert("CPF Invalido!!!");
        document.formCadastro.cCPF.focus();
	return false;
    }
    if(document.formCadastro.tRG.value == ""){
        alert("Campo RG Não foi preenchido!!!");
        document.formCadastro.tRG.focus();
        return false;
    }
    if(document.formCadastro.tEsc.value == ""){
        alert("Campo Nível Escolaridade Não foi preenchido!!!");
        document.formCadastro.tEsc.focus();
        return false;
    }
    if(document.formCadastro.tProf.value == ""){
        alert("Campo Profissão Não foi preenchido!!!");
        document.formCadastro.tProf.focus();
        return false;
    }
    if(document.formCadastro.tTel.value == "" &&
       document.formCadastro.tCel.value == ""){
        alert("Campo Telefone Fixo ou Móvel Não foi preenchido!!!");
        document.formCadastro.tTel.focus();
        return false;
    }
    if(document.formCadastro.tRua.value == ""){
        alert("Campo Rua(Logradouro) Não foi preenchido!!!");
        document.formCadastro.tRua.focus();
        return false;
    }
    if(document.formCadastro.tBairro.value == ""){
        alert("Campo Bairro Não foi preenchido!!!");
        document.formCadastro.tBairro.focus();
        return false;
    }
    if(document.formCadastro.tNum.value == ""){
        alert("Campo Número Não foi preenchido!!!");
        document.formCadastro.tNum.focus();
        return false;
    }
    if(document.formCadastro.tCid.value == ""){
        alert("Campo Cidade Não foi preenchido!!!");
        document.formCadastro.tCid.focus();
        return false;
    }
    if(document.formCadastro.tCep.value == ""){
        alert("Campo CEP Não foi preenchido!!!");
        document.formCadastro.tCep.focus();
        return false;
    }
    if(document.formCadastro.tMail.value == ""){
        alert("Campo E-mail não foi preenchido!!!");
        document.formCadastro.tMail.focus();
        return false;
    }
     if(document.formCadastro.tCMail2.value == ""){
        alert("Campo Confirma E-mail não foi preenchido!!!");
        document.formCadastro.tCMail2.focus();
        return false;
    }
    if(document.formCadastro.tCSenha.value == ""){
        alert("Campo Senha não foi preenchido!!!");
        document.formCadastro.tCSenha.focus();
        return false;
    }
    if(document.formCadastro.tCSenha2.value == ""){
        alert("Campo Confirma Senha não foi preenchido!!!");
        document.formCadastro.tCSenha2.focus();
        return false;
    }
    var email1,email2;
    email1 = document.getElementById("cMail").value;
    email2 = document.getElementById("cCMail2").value;
    if(email1 != email2) {
        alert("o E-mail's digitados estão diferente um do outro!!!");
        document.formCadastro.tMail.focus();
        return false;
    }
    if(document.formCadastro.tCSenha.value != document.formCadastro.tCSenha2.value) {
        alert("Senhas digitadas estão diferente uma do outra!!!");
        document.formCadastro.tCSenha.focus();
        return false;
    }
}
function validaSenha(){
    if(document.formLogin.tMail.value == "") {
        alert("Campo E-mail Não foi preenchido!!!");
        document.formLogin.tMail.focus();
        return false;
    }
}
function validaContato(){
    var nome = document.getElementById("cNome").value;
    if(nome == ""){
        alert("Campo Nome não foi preenchido!!!");
        document.formContato.tNome.focus();
        return false;
    }
    var email = document.getElementById("cMail").value;
    if (email == ""){
        alert("Compo E-mail Não foi preenchido!");
        document.formContato.tMail.focus();
        return false;
    }
    var tel = document.getElementById("cTel").value;
    if (tel == ""){
        alert("Compo Telefone Não foi preenchido!");
        document.formContato.tTel.focus();
        return false;
    }
    var assunto = document.getElementById("cAssunto").value;
    if (assunto == ""){
        alert("Compo Assunto Não foi preenchido!");
        document.formContato.tAssunto.focus();
        return false;
    }
    var mensagem = document.getElementById("cMsg").value;
    if (mensagem == ""){
        alert("Compo Mensagem Não foi preenchido!");
        document.formContato.tMsg.focus();
        return false;
    }    
}
function validaCurso(){
    if(document.formCurso.tNome.value == ""){
        alert("Campo Nome do Curso não foi preenchido!!!");
        document.formCurso.tNome.focus();
        return false;
    }
    if(document.formCurso.tDescr.value == ""){
        alert("Campo Descrição do Curso não foi preenchido!!!");
        document.formCurso.tDescr.focus();
        return false;
    }
    if(document.formCurso.tInstr.value == ""){
        alert("Campo Instrutor do Curso não foi preenchido!!!");
        document.formCurso.tInstr.focus();
        return false;
    }
    if(document.formCurso.tPrevisao.value == ""){
        alert("Campo Previsão do Curso não foi preenchido!!!");
        document.formCurso.tPrevisao.focus();
        return false;
    }
    if(document.formCurso.tCarga.value == ""){
        alert("Campo Carga Horária do Curso não foi preenchido!!!");
        document.formCurso.tCarga.focus();
        return false;
    }
    if(document.formCurso.tTot.value == ""){
        alert("Campo Total de Aulas Vagas do Curso não foi preenchido!!!");
        document.formCurso.tTot.focus();
        return false;
    }  
    if(document.formCurso.tVagas.value == ""){
        alert("Campo Carga Vagas do Curso não foi preenchido!!!");
        document.formCurso.tVagas.focus();
        return false;
    }  
    if(document.formCurso.tValor.value == ""){
        alert("Campo Carga Valor do Curso não foi preenchido!!!");
        document.formCurso.tValor.focus();
        return false;
    }
    }
function validaDesconto(){
    if(document.formInscr.tDesconto.value <=0) {
        alert("Desconto não pode ser menor do Zero %!!!");
        document.formInscr.tDesconto.focus();
        return false;
    }
    if(document.formInscr.tDesconto.value > 100) {
        alert("Desconto não pode ser Maior do 100% !!!");
        document.formInscr.tDesconto.focus();
        return false;
    }
}
function validaCusto(){
    if(document.formCusto.tCurso.value =="") {
        alert("Curso não pode está vazio!!!");
        document.formCusto.tCurso.focus();
        return false;
    }
    if(document.formCusto.tProd.value == "") {
        alert("Campo produto não pode está vazio!!!");
        document.formInscr.tProd.focus();
        return false;
    }
    if(document.formCusto.tQtd.value == "") {
        alert("Campo Quantidade não pode está vazio!!!");
        document.formInscr.tQtd.focus();
        return false;
    }
    if(document.formCusto.tUn.value == "") {
        alert("Campo U.N não pode está vazio!!!");
        document.formInscr.tUn.focus();
        return false;
    }
    
    if(document.formCusto.tPr.value == "") {
        alert("Campo Preço Unitário não pode está vazio!!!");
        document.formInscr.tPr.focus();
        return false;
    }
    if(document.formCusto.tTt.value == "") {
        alert("Campo Valor Total não pode está vazio!!!");
        document.formInscr.tTt.focus();
        return false;
    }
}
function calc_total(){
    var qtdtxt = document.getElementById('cQtd').value;
    var valortxt = document.getElementById('cPr').value;
    var qtd = qtdtxt.replace(",",".");
    var valor = valortxt.replace(",",".");
    tot = qtd * valor;
    tottxt = tot.toFixed(2);
    tottxt = tottxt + "";
    tottxt = tottxt.replace(".",",");
    document.getElementById('cTt').value = tottxt;
}