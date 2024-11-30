<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<script src='dist/js/index.global.js'></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      locale: 'pt-br',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'listDay,listWeek'
      },
      views: {
        listDay: { buttonText: 'Listar por dia' },
        listWeek: { buttonText: 'Listar por semana' }
      },
      initialView: 'listWeek',
      initialDate: '2023-01-12',
      navLinks: true,
      editable: true,
      dayMaxEvents: true,
      events: [
        {
          title: 'Reunião de Equipe',
          start: '2023-01-12T10:00:00',
          descricao: 'João',
          imageUrl: 'https://via.placeholder.com/40', // URL da foto
          status: 'Em andamento' // Status do evento
        },
        {
          title: 'Apresentação do Projeto',
          start: '2023-01-13T14:00:00',
          descricao: 'Maria',
          imageUrl: 'https://via.placeholder.com/40',
          status: 'Concluído' // Status do evento
        }
      ],

      eventContent: function(info) {
        // Determinar a classe da badge com base no status
        let status = info.event.extendedProps.status || 'Sem status';
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
          default:
            badgeClass = 'badge-secondary';
        }

        // HTML personalizado para exibir a foto, status e descrição
        return {
          html: `
            <div style="display: flex; align-items: center;">
              <img src="${info.event.extendedProps.imageUrl}" alt="Foto" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
              <div>
                <strong>${info.event.title}</strong><br>
                <em>Descrição: ${info.event.extendedProps.descricao || 'Não definido'}</em><br>
                <span class="badge ${badgeClass}">${status}</span>
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

  .badge-secondary {
    background-color: #6c757d;
  }
</style>
</head>
<body>
  <div id='calendar'></div>
</body>
</html>
