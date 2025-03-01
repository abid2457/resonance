(function ($) {
	
	"use strict";

	  const second = 1000,
      minute = second * 60,
      hour = minute * 60,
      day = hour * 24;

// Set target date
let countDown = new Date('jan 31, 2025 00:00:00').getTime();

let x = setInterval(function() {
  let now = new Date().getTime();
  let distance = countDown - now; // Calculate remaining time

  if (distance > 0) {
    // Update countdown values
    document.getElementById('days').innerText = Math.floor(distance / day);
    document.getElementById('hours').innerText = Math.floor((distance % day) / hour);
    document.getElementById('minutes').innerText = Math.floor((distance % hour) / minute);
    document.getElementById('seconds').innerText = Math.floor((distance % minute) / second);
  } else {
    // Stop countdown when complete
    clearInterval(x);
    document.getElementById('countdown').innerText = "IT'S TIME!";
  }
}, second);

})(window.jQuery);
