function updateClock() {
    var now = new Date();
    
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var ampm = hours >= 12 ? 'PM' : 'AM';
    
    hours = hours % 12;
    hours = hours ? hours : 12;
    
    minutes = minutes < 10 ? '0' + minutes : minutes;
    
    var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    var day = days[now.getDay()];
    
    var time = hours + ':' + minutes + ' ' + ampm;
    
    var clockElement = document.getElementById('clock');
    clockElement.getElementsByClassName('time')[0].textContent = time;
    clockElement.getElementsByClassName('day')[0].textContent = day;
    
    setTimeout(updateClock, 1000); // Update the clock every second
  }
  
  updateClock();
  