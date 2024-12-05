<?php
  include_once 'objetos.php'; 
  $siteAdmin = new SITE_ADMIN();

  session_start(); 
  define('SESSION_TIMEOUT', 1800); // 30 minutos
 
  if (!isset($_SESSION['user_id'])) 
  {
    header("Location: index.php");
    exit();
  }

  if ($_SESSION['user_nivelacesso'] == "ADMINISTRADOR") 
  {
    $siteAdmin->getAgendaAtividadesInfo();
  }

  if ($_SESSION['user_nivelacesso'] != "ADMINISTRADOR") 
  {
    $idUser = $_SESSION['user_id'];
    $siteAdmin->getAgendaAtividadesByIdInfo($idUser);
  }




  $arrayEventos = array();

  foreach($siteAdmin->ARRAY_AGENDAATIVIDADES as $evento) {
    // Alimentando o arrayEventos com as informações de cada evento
    $dataInicio = new DateTime($evento['AGE_DTINI']); // A data de término do evento (AGE_DTFIM)
    $dataInicioFormatada = $dataInicio->format('Y-m-d\TH:i:s'); // Formato necessário para o FullCalendar
    $dataFim= new DateTime($evento['AGE_DTFIM']); // A data de término do evento (AGE_DTFIM)
    $dataFimFormatada = $dataFim->format('Y-m-d\TH:i:s'); // Formato necessário para o FullCalendar

    $arrayEventos[] = array(
        'title' => strtoupper($evento['AGE_DCTITULO']),               // Título do evento
        'start' => $dataInicioFormatada, 
        'end' => $dataFimFormatada,               // Data e hora do evento
        'descricao' => $evento['AGE_DCDESC'],       // Descrição do evento
        'imageUrl' => $evento['USA_DCFOTO'],         // URL da imagem do evento
        'status' => $evento['AGE_STSTATUS'],  
        'color' => 'green',           // Status do evento
        'statusLink' => 'https://www.codemaze.com.br/site/admin/form_agenda_edit.php?id=' . $evento['AGE_IDAGENDA'] // URL do status
    );
}

$jsonEventos = json_encode($arrayEventos);



?>


<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<script src='dist/js/index.global.js'></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var events = <?php echo $jsonEventos; ?>;
    var calendar = new FullCalendar.Calendar(calendarEl, {
      locale: 'pt-br',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'listDay,listWeek'
      },
      buttonText: {
        today: 'Esta Semana' 
      },
      views: {
        listDay: { buttonText: 'Listar por dia' },
        listWeek: { buttonText: 'Listar por semana' }
      },
      initialView: 'listWeek',
      initialDate: '2024-11-30',
      navLinks: true,
      editable: true,
      dayMaxEvents: true,
      events: events,

      eventContent: function(info) {
        // Determinar a classe da badge com base no status
        let status = info.event.extendedProps.status || 'Sem status';
        let statusLink = info.event.extendedProps.statusLink || '#'; // Link padrão caso não exista
        let badgeClass = '';

        switch (status) {
          case 'Em andamento':
            badgeClass = 'badge-primary';
            break;
          case 'Concluído':
            badgeClass = 'badge-success';
            break;
          case 'Pendente':
            badgeClass = 'badge-warning';
            break;
          case 'Atrasado':
            badgeClass = 'badge-danger';
            break;
          default:
            badgeClass = 'badge-secondary';
        }

        // HTML personalizado para exibir a foto, status clicável e descrição
        return {
          html: `
            <div style="display: flex; align-items: center;">
              <img src="${info.event.extendedProps.imageUrl}" alt="Foto" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
              <div>
                <strong>${info.event.title}</strong><br>
                <em>Descrição: ${info.event.extendedProps.descricao || 'Não definido'}</em><br>
                <a href="${statusLink}" target="_self" class="badge ${badgeClass}" ">${status}</a>
              </div>
            </div>
          `
        };
      }
    });

    calendar.render();
  });
</script>
<style>
  body {
    margin: 40px 10px;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 1100px;
    margin: 0 auto;
  }

  /* Estilos para as badges */
  .badge {
    display: inline-block;
    padding: 0.25em 0.4em;
    font-size: 75%;
    font-weight: 700;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.375rem;
    color: #fff;
  }

  .badge-primary {
    background-color: #007bff;
  }

  .badge-success {
    background-color: #28a745;
  }

  .badge-warning {
    background-color: #ffc107;
    color: #212529;
  }

  .badge-danger {
    background-color: #dc3545;
  }

  .badge-secondary {
    background-color: #6c757d;
  }

  .badge:hover {
    opacity: 0.8; /* Adiciona um efeito ao passar o mouse */
  }
</style>
</head>
<body>
  <div id='calendar'></div>
</body>
</html>
