// Get the reference to the calendar container element
const calendarContainer = document.getElementById('calendar');
// Get the reference to the previous and next buttons
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

// Initialize the current date
let currentDate = new Date();

// Function to generate the calendar
function generateCalendar() {
  // Get the year and month
  const year = currentDate.getFullYear();
  const month = currentDate.getMonth();

  // Set the current date to the first day of the month
  const firstDayOfMonth = new Date(year, month, 1);

  // Get the number of days in the month
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  // Create the calendar grid
  let calendarHTML = `<div class="header">${currentDate.toLocaleString('default', { month: 'long', year: 'numeric' })}</div>`;
  calendarHTML += '<div class="weekdays">';
  calendarHTML += '<span>SUN</span>';
  calendarHTML += '<span>MON</span>';
  calendarHTML += '<span>TUE</span>';
  calendarHTML += '<span>WED</span>';
  calendarHTML += '<span>THU</span>';
  calendarHTML += '<span>FRI</span>';
  calendarHTML += '<span>SAT</span>';
  calendarHTML += '</div>';
  calendarHTML += '<div class="days">';

  // Add empty cells for the days before the first day of the month
  for (let i = 0; i < firstDayOfMonth.getDay(); i++) {
    calendarHTML += '<span></span>';
  }

  // Add the days of the month
  for (let i = 1; i <= daysInMonth; i++) {
    if (isCurrentDate(year, month, i)) {
      calendarHTML += `<span class="current-day">${i}</span>`;
    } else {
      calendarHTML += `<span>${i}</span>`;
    }
  }

  calendarHTML += '</div>';

  // Set the generated calendar HTML to the calendar container
  calendarContainer.innerHTML = calendarHTML;
}

// Function to check if a date is the current date
function isCurrentDate(year, month, day) {
  const today = new Date();
  return year === today.getFullYear() && month === today.getMonth() && day === today.getDate();
}

// Function to go to the previous month
function goToPrevMonth() {
  currentDate.setMonth(currentDate.getMonth() - 1);
  generateCalendar();
}

// Function to go to the next month
function goToNextMonth() {
  currentDate.setMonth(currentDate.getMonth() + 1);
  generateCalendar();
}

// Add event listeners to the previous and next buttons
prevBtn.addEventListener('click', goToPrevMonth);
nextBtn.addEventListener('click', goToNextMonth);

// Generate the calendar initially
generateCalendar();
