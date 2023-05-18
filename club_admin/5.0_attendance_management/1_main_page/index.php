<?php
session_start();


// User only can have access when session is set to admin
if(isset($_SESSION["admin"])=="admin"){
    ?>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- Import library Of bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Importing the script -->\
    <script src="script/qr.js"></script>
    <script type="text/javascript" src="script/script.js"></script>

    <title>Welcome</title>
</head>

<body>
    <div class="container">
        <!-- Navigation bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-top: 1rem">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Energizing Wellness</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../../">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../../logout">Logout</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="../../4.0_student_database_management">Student Database</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAttendance" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Attendance
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownAttendance">
                                <li><a class="dropdown-item" href="../0_redirect_page">Attendance
                                        Management</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="../../5.1_attendance_report">Attendance Report</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- End of navigation bar  -->
        <div id="class_title" style="margin-top: 1rem"></div>
        <div class="input-group mb-3" style="margin-top: 1rem">
            <input id="search" type="text" class="form-control" placeholder="Student's name" aria-label="Student's name"
                aria-describedby="basic-addon2" onkeyup="search_get_id()">
            <span class="input-group-text" id="basic-addon2">Search</span>
        </div>




        <div id="display" class="overflow-visible"></div>

        <!-- IMPORTING THE AUDIO -->
        <audio id="audio" src="beep.wav"></audio>
        <!-- END OF IMPORTING THE AUDIO -->

        <!-- QR CODE SCANNER -->
        <div class=" collapse" id="collapseExample">
            <div class="card card-body">
                <center><video id="preview" style="width:300px;height100px;"></video></center>
            </div><br>

            <button type="button" class="btn btn-warning" onclick="camera_display(0)">Front Cam</button>
            <button type="button" class="btn btn-warning" onclick="camera_display(1)">Rear Cam</button>
            <br>

        </div><br>
        <!-- END OF QR CODE -->

        <!-- QR BUTTON -->
        <div>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
                aria-expanded="false" aria-controls="collapseExample">
                QR Scan
            </button>
        </div>
        <div id="display_attendence"></div>
    </div>
    <br>
    <!-- END OF QR BUTTON -->



</body>
<script type="text/javascript">
let scanner = new Instascan.Scanner({
    video: document.getElementById('preview'),
    mirror: true
});



const camera_display = function(data) {
    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[data]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function(e) {
        console.error(e);
    });
};

camera_display(0);

scanner.addListener('scan', function(content) {
    if (content != '') {
        audio.play();
        console.log(content);
        tunjuk(content);
    }
    document.getElementById("outer").value = content;
});



function tunjuk(value) {
    insert_get_data(value);
}
</script>

</html>
<?php
}
else header("../")


?>