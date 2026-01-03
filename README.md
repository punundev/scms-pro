Create a permission seed:

```sh
php artisan permissions:generate
```
<label for="event-date">Select Date:</label>
<input 
    type="date" 
    id="event-date" 
    name="event-date"
    min="2024-01-01" 
    max="2030-12-31"
>


<label for="meeting-time">Select Time:</label>
<input 
    type="time" 
    id="meeting-time" 
    name="meeting-time"
    min="09:00" 
    max="18:00"
>
