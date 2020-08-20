<html>
<head>
    <meta charset='utf-8'/>
    <link href='fullcalendar-4.4.0/packages/core/main.css' rel='stylesheet'/>
    <link href='fullcalendar-4.4.0/packages/daygrid/main.css' rel='stylesheet'/>
    <link href='fullcalendar-4.4.0/packages/timegrid/main.css' rel='stylesheet'/>

    <script src='fullcalendar-4.4.0/packages/core/main.js'></script>
    <script src='fullcalendar-4.4.0/packages/daygrid/main.js'></script>
    <script src='fullcalendar-4.4.0/packages/timegrid/main.js'></script>
    <script>
        (function () {
            const loader = function () {
                const calendarEl = document.getElementById('calendar');

                const calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: ['timeGrid'],
                    defaultView: 'timeGridWeek'
                });

                calendar.render();
                calendar.addEvent({
                    start: '2020-05-10 08:00:00'
                    end: '2020-05-10 10:00:00'
                    title: 'Meeting'
                    eventId: 1
                })
            }

            document.addEventListener('DOMContentLoaded', loader);
        })();

    </script>
</head>
<body>
<div id="calendar"></div>
</body>
</html>
