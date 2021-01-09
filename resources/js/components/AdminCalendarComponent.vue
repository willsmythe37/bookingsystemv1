<script>
import FullCalendar from "@fullcalendar/vue";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";

export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
        initialView: "timeGridDay",
        headerToolbar: {
          left: "prev,next today",
          center: "title",
          right: "listWeek,timeGridWeek,timeGridDay"
        },
        allDaySlot: false,
        firstDay: "1",
        allDay: false,
        height: 500,
        businessHours: {'daysOfWeek':'[ 0, 1, 2, 3, 4, 5, 6 ]','startTime':'09:00','endTime':'23:00'},
        events: {
          url: "/admin/calendar/events",
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
