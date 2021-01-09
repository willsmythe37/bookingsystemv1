<template>

</template>



<script>

  $( function() {
    $( "#Booking_start_date" ).datepicker({
            dateFormat: "yy-mm-dd",
            autoSize: true,
            showOptions: { direction: "down"},
            showAnim: "show",
            focusOnShow: false,
            ignoreReadonly: true,
            showClose: true,
            showOtherMonths: true,
            selectOtherMonths: true,
            inline: true,
            preventFocusZoom: true,
            firstDay: 1, // Start with Monday
            maxDate: '+2y',
            onSelect: function(date){

                var selectedDate = new Date(date);
                var endDate = new Date(selectedDate.getTime());

            //Set Minimum Date of EndDatePicker After Selected Date of StartDatePicker
                $("#Booking_end_date").datepicker( "option", "minDate", endDate );
                $("#Booking_end_date").datepicker( "option", "maxDate", '+2y' );

            }

        });
    });


$( function() {
    $( "#Booking_end_date" ).datepicker({
            dateFormat: "yy-mm-dd",
            autoSize: true,
            showOptions: { direction: "down"},
            showAnim: "show",
            focusOnShow: false,
            ignoreReadonly: true,
            showClose: true,
            showOtherMonths: true,
            selectOtherMonths: true,
            inline: true,
            firstDay: 1, // Start with Monday
            maxDate: '+2y',
        });
    });

$( function() {
    $( "#Booking_start_time" ).timepicker({
            timeFormat: 'HH:mm',
            interval: 30,
            minTime: '7',
            maxTime: '11:30pm',
            startTime: '0:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
    });

$( function() {
    $( "#Booking_end_time" ).timepicker({
            timeFormat: 'HH:mm',
            interval: 30,
            minTime: '7',
            maxTime: '11:30pm',
            startTime: '0:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
    });



      $( function() {
    $( "#Booking_start_date2" ).datepicker({
            dateFormat: "yy-mm-dd",
            autoSize: true,
            showOptions: { direction: "down"},
            showAnim: "show",
            focusOnShow: false,
            ignoreReadonly: true,
            showClose: true,
            showOtherMonths: true,
            selectOtherMonths: true,
            inline: true,
            firstDay: 1, // Start with Monday
            maxDate: '+2y',
            onSelect: function(date){

                var selectedDate = new Date(date);
                var endDate = new Date(selectedDate.getTime());

            //Set Minimum Date of EndDatePicker After Selected Date of StartDatePicker
                $("#Booking_end_date2").datepicker( "option", "minDate", endDate );
                $("#Booking_end_date2").datepicker( "option", "maxDate", '+2y' );

            }

        });
    });

$( function() {
    $( "#Booking_end_date2" ).datepicker({
            dateFormat: "yy-mm-dd",
            autoSize: true,
            showOptions: { direction: "down"},
            showAnim: "show",
            focusOnShow: false,
            ignoreReadonly: true,
            showClose: true,
            showOtherMonths: true,
            selectOtherMonths: true,
            inline: true,
            firstDay: 1, // Start with Monday
            maxDate: '+2y',
        });
    });

$( function() {
    $( "Booking_start_time" ).timepicker({
            timeFormat: 'HH:mm',
            interval: 30,
            minTime: '7',
            maxTime: '11:30pm',
            startTime: '0:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
    });

$( function() {
    $( ".Booking_end_time" ).timepicker({
            timeFormat: 'HH:mm',
            interval: 30,
            minTime: '7',
            maxTime: '11:30pm',
            startTime: '0:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
    });


  $( function() {
    $( "#guitarheadamount" ).spinner({
        max: 20,
        min: 0,
    })
  });

  $( function() {
    $( "#guitarcomboamount" ).spinner({
        max: 20,
        min: 0,
    })
  });

  $( function() {
    $( "#guitarcabamount" ).spinner({
        max: 20,
        min: 0,
    })
  });

  $( function() {
    $( "#bassheadamount" ).spinner({
        max: 20,
        min: 0,
    })
  });

  $( function() {
    $( "#basscomboamount" ).spinner({
        max: 20,
        min: 0,
    })
  });

  $( function() {
    $( "#basscabamount" ).spinner({
        max: 20,
        min: 0,
    })
  });

  $( function() {
    $( "#cymbalsamount" ).spinner({
        max: 20,
        min: 0,
    })
  });

  $( function() {
    $( "#drumkitamount" ).spinner({
        max: 20,
        min: 0,
    })
  });

  // https://medium.com/@nedsoft/how-to-add-jquery-ui-plugin-to-a-laravel-app-using-laravel-mix-e85bf0244fc1

  // https://timepicker.co/#
  </script>
