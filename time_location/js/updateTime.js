(function($) {
  Drupal.behaviors.updateTimeBlock = {
    attach : function (context, setting) {
      setInterval(showTime, 60000);
      function showTime() {
        var current_user_time = document.getElementById('user-time').innerHTML;
        var current_user_time_array = current_user_time.split(" ");

        var time_var = current_user_time_array[4];
        var time = time_var.split(":");

        var hour = parseInt(time[0]);
        var min = parseInt(time[1]);

        var am_pm = current_user_time_array[5];

        if ( min != 59) {
          min += 1;
          console.log("IN IF  ");
        }
        else {
          min = 0;
          if(hour > 10) {
            hour = 0;
          }
          else { 
            min += 1;
            if (am_pm === "AM") {
              am_pm = "PM";
            }
          }
          am_pm = "AM";
        }
        if (min < 10){
          min = "0" + min;
        }
        if (hour < 10){
          hour = "0" + hour;
        }

        let currentTime = current_user_time_array[0] + " " + current_user_time_array[1] + " " + current_user_time_array[2] + " " + current_user_time_array[3] + " " + hour + ":" + min + " " + am_pm;
        document.getElementById("user-time").innerHTML = currentTime;
        console.log(currentTime);
      }
    }
  }
}(jQuery));