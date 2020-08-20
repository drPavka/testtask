<?php
define( 'CALENDAR_PATH', 'fullcalendar-4.4.0/packages' );
define( 'API_PATH', '/api' );
function importCalendarLibraries( array $dirs, string $pattern ): string {
	return join(
		array_map(
			function ( $package ) use ( $pattern ) {
				return sprintf( $pattern, CALENDAR_PATH . '/' . $package );
			},
			$dirs
		)
	);
}

?>
<html>
<head>
    <meta charset='utf-8'/>
    <style>
        * {
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
        }

        #calendar {
            width: 100%;
            height: 100%;
        }
    </style>
	<?= importCalendarLibraries(
		[
			'core',
			'daygrid',
			'timegrid',
		],
		'<link href="%s/main.css" rel="stylesheet"/>'
	) ?>
	<?= importCalendarLibraries(
		[
			'core',
			'daygrid',
			'timegrid',
			'interaction',
		],
		'<script src="%s/main.js"></script>'
	) ?>
    <script>

        (function () {
            const loader = function () {
                try {
                    const createCalendar = function () {
                        const calendarEl = document.getElementById('calendar');
                        if (!calendarEl) throw new Error('Calendar container is not set');
                        const onChange = function ({event, revert}) {
                            window.fetch('<?= API_PATH ?>', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    start: event.start,
                                    end: event.end,
                                    id: event.id,
                                    scope: 'update'
                                })
                            }).then((response) => {
                                if (!response.ok) throw new Error(response.statusText);
                            }).catch((e) => {
                                //console.error(e);
                                revert();
                            });
                        };
                        const _ = new FullCalendar.Calendar(calendarEl, {
                            plugins: ['timeGrid', 'interaction',],
                            defaultView: 'timeGridWeek',
                            editable: true,
                            selectable: true,
                            eventColor: '#fff',
                            eventBackgroundColor: '#000',
                            eventDrop: onChange,
                            eventResize: onChange
                        });
                        _.render();
                        return _;
                    }

                    const populateEvent = function (calendar, eventData) {
                        calendar.addEvent(eventData);
                        calendar.gotoDate(calendar.getEventById(eventData.id).start);
                    }

                    const calendar = createCalendar();
                    populateEvent(calendar, {
                        start: '2020-05-10 08:00:00',
                        end: '2020-05-10 10:00:00',
                        title: 'Meeting',
                        id: 1
                    });
                } catch (e) {
                    console.error(e)
                }
            }

            document.addEventListener('DOMContentLoaded', loader);

        })();

    </script>
</head>
<body>
<div id="calendar"></div>
</body>
</html>
