<?php
   


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sua chave secreta
    $secretKey = "6LcZHF4qAAAAAB8x_VRiQoivWpb5kzz_SOy8EwIT"; // Substitua pela sua chave secreta

    // O token enviado pelo reCAPTCHA v2
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Verifique se o token foi recebido
    if (!empty($recaptchaResponse)) {
        // Verifique o reCAPTCHA fazendo uma solicitação à API do Google
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptchaResponse}");
        $responseKeys = json_decode($response, true);

        // Verifique o sucesso da validação
        if ($responseKeys["success"]) {

            // Obter os dados do formulário
            $name = htmlspecialchars($_POST['nome']);
            $emailCli = htmlspecialchars($_POST['email']);
            $phone = htmlspecialchars($_POST['telefone']);
            $service = htmlspecialchars($_POST['service']);
            $message = htmlspecialchars($_POST['mensagem']);

            // Configurações do e-mail
            $to = "faleconosco@codemaze.com.br"; 
            $subject = "ATENÇÃO: Contato pelo site da Codemaze";
            $body = "Nome: $name\n";
            $body .= "E-mail: $emailCli\n";
            $body .= "Telefone: $phone\n";
            $body .= "Serviço: $service\n";
            $body .= "Mensagem: $message\n";

            // Adiciona cabeçalhos para o e-mail
            $headers = "From: no-reply@codemaze.com.br\r\n";
            $headers .= "Reply-To: no-reply@codemaze.com.br\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n"; // Define a codificação como UTF-8
            $headers .= "MIME-Version: 1.0\r\n";


            // Enviar o e-mail
            if (mail($to, $subject, $body, $headers)) {
                echo "Formulário enviado com sucesso!";
            } else {
                echo "Falha ao enviar o e-mail. Por favor, tente novamente.";
            }
        } 
        else 
            {
                // Validação falhou
                echo "Falha na verificação do reCAPTCHA. Por favor, tente novamente.";
            }
    } 
    else 
        {
            // reCAPTCHA não foi resolvido
            echo "Por favor, complete o reCAPTCHA.";
        }
}
?>
