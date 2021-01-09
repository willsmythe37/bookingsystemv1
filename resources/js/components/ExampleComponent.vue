
<script>
const queryString = window.location.href.split("/");
var roomNumber = queryString[4];
var eventstartURL = "/events/";
var calendarURL = eventstartURL.concat(roomNumber);

import FullCalendar from "@fullcalendar/vue";
import {
  Calendar,
  parseBusinessHours,
  parseFieldSpecs
} from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";

export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  data(businesshoursData) {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, timeGridPlugin],
        initialView: "timeGridWeek",

        headerToolbar: {
          left: "prev,next today",
          center: "title",
          right: "timeGridWeek,timeGridDay"
        },

        allDaySlot: false,
        height: 500,
        businessHours: {'daysOfWeek':'[ 0, 1, 2, 3, 4, 5, 6 ]','startTime':'09:00','endTime':'23:00'},
        firstDay: "1",
        events: {
          url: calendarURL,
          type: "GET"
        },

        eventColor: '#a49de3',

        titleFormat: {  // will produce something like "Tuesday, September 18, 2018"
            month: 'short',
            year: 'numeric',
            day: 'numeric',

        }

      }
    };
  }
};


</script>

<template>
  <FullCalendar :options="calendarOptions"></FullCalendar>
</template>
