
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
            <label for="schedule">Schedule</label>

            <div class="sched-container">
                <!-- From Label -->
                <div class="from-label">
                    <label>From:</label> <!-- Label -->
                    <div class="main-select-container"> <!-- Selects -->
                        <!-- Select 1 -->
                        <div class="select-container">
                            <select name="schedFromHour${sectionCounter}">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="12">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <!-- Select 2 -->
                        <div class="select-container">
                            <select name="schedFromMin${sectionCounter}">
                                <option value="00">00</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                                <option value="46">46</option>
                                <option value="47">47</option>
                                <option value="48">48</option>
                                <option value="49">49</option>
                                <option value="50">50</option>
                                <option value="51">51</option>
                                <option value="52">52</option>
                                <option value="53">53</option>
                                <option value="54">54</option>
                                <option value="55">55</option>
                                <option value="56">56</option>
                                <option value="57">57</option>
                                <option value="58">58</option>
                                <option value="59">59</option>
                            </select>
                        </div>
                        <!-- Select 3 -->
                        <div class="select-container">
                            <select name="schedFromPeriod${sectionCounter}">
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- To Label -->
                <div class="from-label">
                    <label for="teacherSchedule1">To:</label> <!-- Label -->
                    <div class="main-select-container"> <!-- Selects -->
                        <!-- Select 1 -->
                        <div class="select-container">
                            <select name="schedToHour${sectionCounter}">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="12">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <!-- Select 2 -->
                        <div class="select-container">
                            <select name="schedToMin${sectionCounter}">
                                <option value="00">00</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                                <option value="46">46</option>
                                <option value="47">47</option>
                                <option value="48">48</option>
                                <option value="49">49</option>
                                <option value="50">50</option>
                                <option value="51">51</option>
                                <option value="52">52</option>
                                <option value="53">53</option>
                                <option value="54">54</option>
                                <option value="55">55</option>
                                <option value="56">56</option>
                                <option value="57">57</option>
                                <option value="58">58</option>
                                <option value="59">59</option>
                            </select>
                        </div>
                        <!-- Select 3 -->
                        <div class="select-container">
                            <select name="schedToPeriod${sectionCounter}">
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- GRADE -->
        <div class="bind-label">
            <br>
            <label>Grade:</label>
            <input type="text" id="teacherGrade1" name="teacherGrade${sectionCounter}">
        </div>
        <!-- SECTION -->
        <div class="bind-label">
            <br>
            <label>Section:</label>
            <input type="text" id="teacherSection1" name="teacherSection${sectionCounter}">
        </div>
        <!-- SUBJECT -->
        <div class="bind-label">
            <br>
            <label>Subject Name:</label>
            <input type="text" id="teacherSubject1" name="teacherSubject${sectionCounter}">
        </div>

        <!-- School Year -->
        <div class="bind-label">
            <label>School Year:</label> <!--Label-->
            <div class="sched-container"> <!--School Year-->
                <div class="from-label">
                    <label>From:</label>
                    <input type="number" id="teacherSchedule1" name="teacherFromSchoolYear${sectionCounter}">
                </div>
                <div class="from-label">
                    <label>To:</label>
                    <input type="number" id="teacherSchedule1" name="teacherToSchoolYear${sectionCounter}">
                </div>
            </div>
        </div>
        <div class="withButton">
            <br>
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
