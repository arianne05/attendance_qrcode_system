<?php
    session_start();
    include '../connection/db_conn.php';
    include '../connection/session.php';
    include '../connection/session_name.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../connection/link.php'?>
    <!-- Link -->
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <title>Document</title>
</head>
<body>
    <!-- Topbar -->
    <?php include_once '../navbar/topbar-teacher.php'?>
    <!-- Sidebar -->
    <?php include_once '../navbar/sidebar-teacher.php'?>

    <section class="section-camera">
        <div class="vid-preview">
            <div class="preview-cam">
                <video id="preview" width="100%"></video>
            </div>
            <div class="preview-scan-info">
                <div class="img-studentNumber">
                    <img src="../img/female-icon.png" alt="">
                    <p>201912344</p>
                </div>
                
                <div class="scan-header">
                    <div class="by-label">
                        <label for="">Name</label>
                        <input type="text" name="text" id="text" readonly placeholder="Scan QR Here">
                    </div>
                    <div class="by-label">
                        <label for="">Section</label>
                        <input type="text" name="text" id="studentNumber" readonly>
                    </div>
                    <div class="by-label">
                        <label for="">School Year</label>
                        <input type="text" name="text" id="studentNumber" readonly>
                    </div>
                </div>
                
                <div class="scan-alert">
                    Your On-Time!
                </div>
                
            </div>
        </div>

        <div class="tbl-attendance">
            <br><h2>Record</h2><br>
            <div class="container-tbl-att">
            <div class="circle-design">
                <p class="circle-green"></p>
                <p class="circle-green"></p>
                <p class="circle-green"></p>
            </div>
            <br>
            <table id="student" class="display">
                <thead>
                    <th>Student Number</th>
                    <th>Name</th>
                    <th>Section</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Option</th>
                </thead>
                <tbody>
                    <td>201912344</td>
                    <td>Arianne Quimpo</td>
                    <td>BSIT 4-3</td>
                    <td>Math</td>
                    <td>on-time</td>
                    <td><button class="archive">Remove</button></td>
                </tbody>
            </table>
            </div>
        </div>
    </section>
</body>
<script>    
    new DataTable('#student');
</script>
<script>
        let scanner = new Instascan.Scanner({video: document.getElementById('preview')});
        Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            } else{
                alert("No Camera Found!");
            }
        }).catch(function(e){
            console.error(e);
        });

        scanner.addListener('scan',function(c){
            document.getElementById('text').value=c;
        });
</script>
</html>