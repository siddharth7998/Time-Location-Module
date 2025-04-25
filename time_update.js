(function ($, Drupal) {
  Drupal.behaviors.timeUpdate = {
    attach: function (context, settings) {
      function updateTime() {
        const timezone = drupalSettings.site_location_time.timezone;
        $('#time-block', context).text(formatDate(timezone));
      }
      setInterval(updateTime, 1000);
      updateTime();

      function formatDate(timezone) {
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-US', {
          hour: '2-digit',
          minute: '2-digit',
          hour12: true, // Use AM/PM
          timeZone: timezone,
        });

        const day = now.getDate({ timeZone: timezone });
        const month = now.getMonth('en-US', { month: "long", timeZone: timezone });
        const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        const year = now.getFullYear({ timeZone: timezone });
        const dayWithSuffix = day + (day === 1 || day === 21 || day === 31 ? 'st' : day === 2 || day === 22 ? 'nd' : day === 3 || day === 23 ? 'rd' : 'th');
        return `${dayWithSuffix} ${months[month]} ${year} - ${timeString}`;
      }
      
    }
  };
})(jQuery, Drupal);
