<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Sabberworm\CSS\Property\Charset;

//Load Composer's autoloader
require 'vendor/autoload.php';

if(isset($_POST['enviar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    $mail->CharSet = "UTF-8";

    try {
        
        $mail->isSMTP();
        $mail->Host = 'genovez@sunioweb.com.br';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '675bb3ce4de643';
        $mail->Password = '8428fc52b6cf56';

        //Recipients
        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress('joe@example.net', 'Joe User');     
        //Add a recipient
        $mail->addAddress('ellen@example.com');               
        //Name is optional
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');


        //Content
        $mail->isHTML(true);                                  
        //Set email format to HTML
        $mail->Subject = "Contato Site -".$assunto;
        //Corpo da mensagem em formato HTML

        $mail->Body    = "<b>Nome:</b> $nome <br> <b>E-mail:</b> $email <br> <b>Assunto $assunto</b> <br> <b>Mensagem:<b> $mensagem";

        //Corpo da mensagem em formato texto puro
        $mail->AltBody = "Nome: $nome \n E-mail: $email \n Assunto: $assunto \n Mensagem: $mensagem";

        $mail->send();
        echo 'Mensagem foi enviada com sucesso';
    } catch (Exception $e) {
        echo "Mensagem não enviada, tente novamente: {$mail->ErrorInfo}";
    }
} // final do if enviar
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Contato usando phpmailer</h1>
    <hr>
    <form action="" method="post">
        <p>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required>
        </p>

        <p>
            <label for="email">E-mail:</label>
            <input type="text" name="email" id="email" required>
        </p>

        <p>
            <label for="assunto">Assunto:</label>
            <select name="assunto" id="assunto" required>
                <option value=""></option>
                <option value="duvidas">Dúvidas</option>
                <option value="reclamacoes">Reclamações</option>
                <option value="elogios">Elogios</option>
            </select>
        </p>

        <p>
            <label for="mensagem">Mensagem:</label><br>
            <textarea name="mensagem" id="mensagem" cols="30" rows="5"></textarea>
        </p>

        <button type="submit" name="enviar">Enviar</button>
    </form>

    <p><a href="index.php">Voltar</a></p>
</body>
</html>