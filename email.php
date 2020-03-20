<?php 
// Destinatário
$para = "welington_marquezini88@live.com";

// Assunto do e-mail
$assunto = "Teste Email PHP";

// Campos do formulário de contato
$nome = "Welington Marquezini";
$email = "welington_marquezini88@live.com";
$telefone = "32 98862 1338";
$mensagem = "Teste <br/> Teste";

// Monta o corpo da mensagem com os campos
$corpo = "<html><body>";
$corpo .= "Nome: $nome ";
$corpo .= "Email: $email Telefone: $telefone Mensagem: $mensagem";
$corpo .= "</body></html>";

// Cabeçalho do e-mail
$email_headers = implode("\n", array("From: $nome", "Reply-To: $email", "Subject: $assunto", "Return-Path: $email", "MIME-Version: 1.0", "X-Priority: 3", "Content-Type: text/html; charset=UTF-8"));

//Verifica se os campos estão preenchidos para enviar então o email
if (!empty($nome) && !empty($email) && !empty($mensagem)) {
    mail($para, $assunto, $corpo, $email_headers);
    $msg = "Sua mensagem foi enviada com sucesso.";
    echo "<script>alert('$msg');window.location.assign('http://www.portal-enterprise.com');</script>";
} else {
    $msg = "Erro ao enviar a mensagem.";
    echo "<script>alert('$msg');window.location.assign('http://www.portal-enterprise.com');</script>";
}