<?php
session_start();
echo   $_SESSION["admin"];

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

    <!-- Importing the script -->
    <script src="main/script/script.js"></script>

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
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./logout">Logout</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="4.0_student_database_management">Student Database</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAttendance" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Attendance
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownAttendance">
                                <li><a class="dropdown-item" href="5.0_attendance_management/0_redirect_page">Attendance
                                        Management</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="5.1_attendance_report">Attendance Report</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <div class="card" style="margin-top: 1.5rem">
            <img src="data:image/jpeg;base64,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"
                class="card-img-top" alt="...">
            <div class="card-body">
                <h3 class="card-title">Welcome Admin</h3>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p>
            </div>
        </div>

    </div>

</body>

</html>
<?php
}
// header('Location: ../../');


?>