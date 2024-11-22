<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo SweetAlert</title>
<!-- Include the Bulma theme -->
<link rel="stylesheet" href="@sweetalert2/theme-bulma/bulma.css">

<script src="sweetalert2/dist/sweetalert2.min.js"></script>
</head>
<body>
    <h1>Formulário de Contato</h1>
    <form method="POST" action="">
        <input type="text" name="nome" placeholder="Seu nome" required><br><br>
        <input type="email" name="email" placeholder="Seu e-mail" required><br><br>
        <button type="submit">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lógica do processamento (como salvar dados, enviar e-mail, etc.)
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: 'Formulário enviado com sucesso!',
            });
        </script>";
    }
    ?>


</body>
</html>
