<?php

    $title = $_GET['header'];
    $firstname = $_GET['fname'];
    $position = $_GET['position'];

    // Check if the file exists before including it
    if (file_exists('../connection/alert.php')) {
        include_once '../connection/alert.php';
        $image = '../img/logo-hermosa 4.png';
        $logout = '../logout.php';
       
    } else {
        include_once '../../connection/alert.php';
        $image = '../../img/logo-hermosa 4.png';
        $logout = '../../logout.php';
    }
?>

<!-- Topbar -->
<div class="dashboard-top-bar">
        <div class="top-bar-left">
            <img src="<?php echo $image; ?>" alt="">
            <p>WAMS</p>
        </div>
        <div class="top-bar-right">
            <!-- test -->
            <div class="left-section-topbar">
                <p><?php echo $title?><br></p>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">
                    <path d="M4.89538 14.0866V11.7864C4.89537 11.2036 5.36102 10.73 5.93779 10.7263H8.05561C8.63496 10.7263 9.10462 11.201 9.10462 11.7864V14.0799C9.1046 14.5854 9.50823 14.9963 10.0085 15H11.4533C12.1282 15.0017 12.7759 14.7321 13.2537 14.2505C13.7315 13.7689 14 13.115 14 12.4331V5.89938C14 5.34853 13.7584 4.82603 13.3402 4.47262L8.43167 0.5057C7.57364 -0.188158 6.34817 -0.165744 5.51555 0.559037L0.712535 4.47262C0.274651 4.81561 0.0129333 5.33966 0 5.89938V12.4265C0 13.8478 1.14018 15 2.54665 15H3.95853C4.19939 15.0017 4.43099 14.9063 4.60193 14.7348C4.77286 14.5633 4.869 14.33 4.86899 14.0866H4.89538Z" fill="#B6B6B6"/>
                </svg>
            </div>              
            <div class="right-section-topbar">
                <div class="search-section">
                    <input type="text" placeholder="Search here">
                    <svg xmlns="http://www.w3.org/2000/svg" id="search-icon" width="13" height="13" viewBox="0 0 13 13" fill="none">
                        <path d="M11.8086 10.8618L9.54154 8.60139C10.273 7.66954 10.6699 6.51882 10.6684 5.3342C10.6684 4.27919 10.3555 3.24788 9.76941 2.37068C9.18329 1.49347 8.3502 0.809776 7.3755 0.406044C6.40081 0.0023112 5.32828 -0.103324 4.29355 0.102497C3.25881 0.308318 2.30835 0.816351 1.56235 1.56235C0.816351 2.30835 0.308318 3.25881 0.102497 4.29355C-0.103324 5.32828 0.0023112 6.40081 0.406044 7.3755C0.809776 8.3502 1.49347 9.18329 2.37068 9.76941C3.24788 10.3555 4.27919 10.6684 5.3342 10.6684C6.51882 10.6699 7.66954 10.273 8.60139 9.54154L10.8618 11.8086C10.9237 11.8711 10.9975 11.9207 11.0787 11.9545C11.16 11.9884 11.2471 12.0058 11.3352 12.0058C11.4232 12.0058 11.5103 11.9884 11.5916 11.9545C11.6728 11.9207 11.7466 11.8711 11.8086 11.8086C11.8711 11.7466 11.9207 11.6728 11.9545 11.5916C11.9884 11.5103 12.0058 11.4232 12.0058 11.3352C12.0058 11.2471 11.9884 11.16 11.9545 11.0787C11.9207 10.9975 11.8711 10.9237 11.8086 10.8618ZM1.33355 5.3342C1.33355 4.54294 1.56818 3.76946 2.00778 3.11156C2.44738 2.45365 3.07219 1.94088 3.80321 1.63808C4.53424 1.33528 5.33863 1.25606 6.11468 1.41042C6.89073 1.56479 7.60358 1.94581 8.16308 2.50531C8.72258 3.06481 9.1036 3.77766 9.25797 4.55371C9.41233 5.32976 9.33311 6.13415 9.03031 6.86518C8.72751 7.5962 8.21474 8.22101 7.55683 8.66061C6.89893 9.10021 6.12545 9.33484 5.3342 9.33484C4.27316 9.33484 3.25558 8.91334 2.50531 8.16308C1.75505 7.41281 1.33355 6.39523 1.33355 5.3342Z" fill="#B9B9B9"/>
                    </svg>
                </div>
                
                <i class="fa-solid fa-bell"></i>
                <div class="position">
                    <div class="circle-user">
                        <span class="defaul-user">AQ</span>
                    </div>
                    <div class="dropdown">
                        <button class="dropdown-btn"><span class="userName"><?php echo $firstname?><br></span><span class="labelPosition"><?php echo $position?></span><i id="iconDrop" class="fa-solid fa-chevron-down"></i></button>
                        <div class="dropdown-content">
                          <a href="#">Visit Profile</a>
                          <a href="#" onclick="logoutAlert()">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- JS for onscroll color change -->
    <script>
        // Get the top bar element
        const topBar = document.querySelector('.dashboard-top-bar');

        // Function to toggle the scrolling class based on the scroll position
        function toggleScrollingClass() {
        if (window.scrollY > 0) {
            topBar.classList.add('scrolling');
        } else {
            topBar.classList.remove('scrolling');
        }
        }

        // Add an event listener to the scroll event
        window.addEventListener('scroll', toggleScrollingClass);

    </script>

    <!-- Sweet Alert Logout -->
    <script>
        //Logout Alert
        function logoutAlert() {
            Swal.fire({
            icon: "question",
            title: "Logout",
            text: "Are you sure you want to logout?",
            showCancelButton: true,
            }).then(function (result) {
            if (result.isConfirmed) {
                window.location.href = "<?php echo $logout?>";
            }
            });
        }
    </script>
<?php
?>