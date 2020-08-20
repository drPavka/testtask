# TestTask

1. load a week calendar view into index.php. Populate it with at least one event: ```
    start: 2020-05-10 08:00:00
    end: 2020-05-10 10:00:00
    title: Meeting
    eventId : 1 ```
    
1. When drag&droping this event, a POST request to api/index.php should be fired and send the follwing into to api/index.php: ```
    start: datetime
    end: datetime
    scope: update
    eventId: 1 ```
1. Events in calendar should have the following css attributes: ``` background: black
        color: white ```
