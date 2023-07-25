
let sectionCounter = 1; // Initialize the section counter

// Function to handle the "Add Section" button click
function addSection() {
    // Get the container where new sections will be added
    const container = document.getElementById('sectionContainer');

    // Check if the maximum number of sections has been reached (9)
    if (container.childElementCount >= 10) {
        alert("You can't add more than 10 sections.");
        return;
    }

    // Increment the section counter for each new section added
    sectionCounter++;

    // Create a new div element with class 'section-three-addTeacher'
    const newSection = document.createElement('div');
    newSection.classList.add('section-three-addTeacher');

    // Add the HTML content for the new section with unique names
    newSection.innerHTML = `
        <div class="bind-label">
            <label for="teacherSchedule${sectionCounter}">Schedule:</label>
            <input type="text" id="teacherSchedule${sectionCounter}" name="teacherSchedule${sectionCounter}" required>
        </div>
        <div class="bind-label">
            <label for="teacherSection${sectionCounter}">Section Name:</label>
            <input type="text" id="teacherSection${sectionCounter}" name="teacherSection${sectionCounter}" required>
        </div>
        <div class="bind-label">
            <label for="teacherSubject1${sectionCounter}">Subject Name:</label>
            <input type="text" id="teacherSubject1${sectionCounter}" name="teacherSubject1${sectionCounter}" required>
        </div>
        <div class="withButton">
            <label for="teacherSubject1">d</label>
            <button class="removeBtn" onclick="removeSection(${sectionCounter})"><i class="fa-regular fa-square-minus"></i></button>
        </div>
    `;

    // Append the new section to the container
    container.appendChild(newSection);
}

// Function to handle the "Remove Section" button click
function removeSection(sectionNum) {
    // Get the container and the section to be removed
    const container = document.getElementById('sectionContainer');
    const sectionToRemove = document.getElementById(`teacherSchedule${sectionNum}`).closest('.section-three-addTeacher');

    // Remove the section from the container
    container.removeChild(sectionToRemove);
}

// Add event listener to the "Add Section" button
const addSectionBtn = document.getElementById('addSectionBtn');
addSectionBtn.addEventListener('click', addSection);
