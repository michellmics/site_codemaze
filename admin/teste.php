<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo SweetAlert</title>

    <!-- Adicionar Google Fonts (Roboto) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>

    <style>
        /* Defina a fonte personalizada para o SweetAlert */
        .swal2-title, .swal2-content {
            font-family: 'Roboto', sans-serif !important;
        }
    </style>
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
  title: 'Do you want to save the changes?',
  showDenyButton: true,
  showCancelButton: true,
  confirmButtonText: 'Save',
  denyButtonText: `Don't save`
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    Swal.fire('Saved!', '', 'success');
  } else if (result.isDenied) {
    Swal.fire('Changes are not saved', '', 'info');
  }
});
        </script>";
    }
    ?>


</body>
</html>
