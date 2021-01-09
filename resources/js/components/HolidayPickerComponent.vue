<template>
</template>



<script>
  $( function() {
    $( "#Holiday_start_date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    });

$( function() {
    $( "#Holiday_end_date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    });

$( function() {
    $( "#Holiday_start_time" ).timepicker({
            timeFormat: 'HH:mm',
            interval: 30,
            minTime: '0',
            maxTime: '11:30pm',
            startTime: '0:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    });

$( function() {
    $( "#Holiday_end_time" ).timepicker({
            timeFormat: 'HH:mm',
            interval: 30,
            minTime: '0',
            maxTime: '11:30pm',
            startTime: '0:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    });

  // https://medium.com/@nedsoft/how-to-add-jquery-ui-plugin-to-a-laravel-app-using-laravel-mix-e85bf0244fc1

  // https://timepicker.co/#
  </script>
