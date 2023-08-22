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
                <video id="preview" width="50%"></video>
            </div>
            <div class="preview-scan-info">
                <label for="">Scan QR Code</label>
                <input type="text" name="text" id="text" readonly placeholder="Scan QR Here">
            </div>
        </div>
    </section>
    

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
</body>
</html>