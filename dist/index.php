<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Links -->
    <link rel="stylesheet" href="./css/main.css">
    <script src="https://kit.fontawesome.com/8b614ed6c5.js" crossorigin="anonymous"></script>
    <!-- Sweet Alert -->
    <script src="./js/sweetalert.min.js"></script>
    <title>Document</title>
</head>
<body>
    <!-- Sweet Alert -->
    <?php include_once './connection/alert.php'?>
    
    <div class="main-section">
        <div class="section-first-half">
            <div class="container-header">
                <img src="./img/logo-hermosa 4.png" alt="Image" width="100">
                <!-- <div class="mergeIconSelect">
                    <i class="fa-solid fa-gear"></i>
                    <select name="position" id="">
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                        <option value="admin">Admin</option>
                  </select>
                </div> -->
            </div>
            
            <div class="container-body">
                <div class="container-first-half">
                    <div class="header-first-half">
                        <h1>Hi there!</h1>
                        <p>Welcome to Biclatan Highschool</p>
                        <button>Learn More About Us</button>
                        <p class="division">__________ or __________</p>
                    </div>
                       
                    <form action="login.php" method="POST" class="form">
                        <div class="input-type-section">
                            <div class="mergeIconUser">
                                <i class="fas fa-user"></i> 
                                <input type="text" placeholder="Your Username" name="username">
                            </div>
                        </div>
                        <div class="input-type-section">
                            <div class="mergeIconPass">
                                <i class="fa-solid fa-lock" id="lock"></i>
                                <input type="password" id="passwordInput" placeholder="Password" name="password">
                                <i class="fa-solid fa-eye-slash" id="togglePassword"></i>
                            </div>
                        </div>
                        <a class="forgotP" href="#">Forgot Password?</a>
                        <button type="submit">Sign In</button>
                        <center>
                            <p>Dont Have an Account yet? <a class="signUpLink" href="#"><b>Contact Us</b></a></p>
                        </center>
                    </form>
                </div>
            </div>
        </div>

        <div class="section-second-half">
            <div class="slideshow-container">
                <div class="developer-main">
                    <div class="developer-logo">
                      <img src="./img/cvsu_logo.png" alt="Image 4" width="60">
                    </div>
                    <div class="developer-caption">
                      <caption>
                        <label for="caption_logo">Brought to you by</label>
                        <p><b>Cavite State University</b></p>
                      </caption>
                    </div>
                </div>
                  
                

                <div class="slide">
                    <img src="./img/slideshow1.jpg" alt="Image 1">
                    <div class="overlay"></div>
                </div>
                <div class="slide">
                    <img src="./img/slideshow2.jpg" alt="Image 2">
                    <div class="overlay"></div>
                </div>
                <div class="slide">
                    <img src="./img/slideshow3.jpg" alt="Image 3">
                    <div class="overlay"></div>
                </div>
                
                <div class="slides-button">
                    <a class="prev" onclick="changeSlide(-1)"><i class="fa-solid fa-arrow-left"></i></a>
                <a class="next" onclick="changeSlide(1)"><i class="fa-solid fa-arrow-right"></i></a>
                </div>

                <div class="text-second">
                    <h1>"Your presence matters. Show up, engage, and make the most of your educational journey."</h1>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- js links -->
<script src="./js/slideshow_index.js"></script>

<!-- Password visibility -->
<script>
    // JavaScript to toggle password visibility
    const passwordInput = document.getElementById('passwordInput');
    const togglePassword = document.getElementById('togglePassword');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Change eye icon based on password visibility
        if (type === 'password') {
            togglePassword.classList.remove('fa-eye');
            togglePassword.classList.add('fa-eye-slash');
        } else {
            togglePassword.classList.remove('fa-eye-slash');
            togglePassword.classList.add('fa-eye');
        }
    });
</script>
</html>