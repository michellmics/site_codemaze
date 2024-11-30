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
          title: 'All Day Event',
          start: '2023-01-01',
          responsavel: 'João',
          color: 'green'
        },
        {
          title: 'Long Event',
          start: '2023-01-07',
          end: '2023-01-10',
          responsavel: 'Maria'
        },
        {
          groupId: 999,
          title: 'Repeating Event',
          start: '2023-01-09T16:00:00',
          end: '2023-01-09T17:00:00',
          responsavel: 'Carlos'
        },
        {
          title: 'Conference',
          start: '2023-01-11',
          end: '2023-01-13',
          responsavel: 'Ana'
        }
      ],

      eventContent: function(info) {
        return {
          html: `
            <div>
              <strong>${info.event.title}</strong><br>
              <em>Responsável: ${info.event.extendedProps.responsavel || 'Não definido'}</em>
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
