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
          Descrição: 'João',
          imageUrl: 'https://via.placeholder.com/40' // URL da foto
        },
        {
          title: 'Apresentação do Projeto',
          start: '2023-01-13T14:00:00',
          Descrição: 'Maria',
          imageUrl: 'https://via.placeholder.com/40'
        }
      ],

      eventContent: function(info) {
        // HTML personalizado para exibir a foto ao lado do evento
        return {
          html: `
            <div style="display: flex; align-items: center;">
              <img src="${info.event.extendedProps.imageUrl}" alt="Foto" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
              <div>
                <strong>${info.event.title}</strong><br>
                <em>Responsável: ${info.event.extendedProps.responsavel || 'Não definido'}</em>
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
</style>
</head>
<body>
  <div id='calendar'></div>
</body>
</html>
