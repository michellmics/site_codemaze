<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo SweetAlert</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css">
</head>
<body>
    <h1>Formulário de Contato</h1>
    <form method="POST" action="">
        <input type="text" name="nome" placeholder="Seu nome" required><br><br>
        <input type="email" name="email" placeholder="Seu e-mail" required><br><br>
        <button type="submit">Enviar</button>
    </form>

    <?php

        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: 'Formulário enviado com sucesso!',
            });
        </script>";
 
    ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
</body>
</html>
