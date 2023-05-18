<?php
session_start();


// SESSION = (ADMIN) ? OK = (VENDOR_MGT)  || !OK MAIN_PAGE
if(isset($_SESSION["admin"])=="admin"){
    // header('Location: ../../dbh.class.php');
?>
<html>

<head>
    <!-- REQUIRED META TAGS -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- IMPORT LIBRARY OF BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- IMPORTING THE SCRIPT -->
    <script src="script/script.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.1/html2pdf.bundle.min.js"
        integrity="sha512-1qLXyA3x0VSWeM+8vOotn6+KIRGdcQ8QMzsNeDXmdJsUAnoDGjzlxzqAuUGJGrGkGrtOrq4buDoAHxR89D9PWA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


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
                            <a class="nav-link active" onclick="test()" aria-current="page" href="../">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" onclick="logout()" aria-current="page"
                                href="../logout">Logout</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Student Database</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAttendance" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Attendance
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownAttendance">
                                <li><a class="dropdown-item"
                                        href="../5.0_attendance_management/0_redirect_page">Attendance
                                        Management</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="../5.1_attendance_report">Attendance Report</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- End of navigation bar  -->



        <br>
        <button id="open" class=" btn btn-success" data-bs-toggle="modal" data-bs-target="#modal" type="button"
            onclick="show_create_modal_btn()">
            Create New Student
        </button>
        <br>
        <!-- (STUDNET) SEARCH -->
        <div class="input-group">
            <input id="search" onkeyup="search_get_id()" type="text" class="form-control" aria-label="Search Student">
            <span class="input-group-text">Student Search</span>
        </div>
        <!-- END OF (STUDENT) SEARCH -->
        <br>

        <!-- Display data / error -->
        <div id="display"></div>

        <!-- MODAL -->
        <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">
                            Create New Student
                        </h5>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            onclick="clear_data()"></button> -->
                    </div>
                    <!-- (STUDENT) STUDENT_ID -->
                    <input type="hidden" id="student_id">
                    <!-- END OF STUDENT_ID-->

                    <div class="modal-body">

                        <!-- (STUDENT) STUDENT_NAME INPUT -->
                        <div class="mb-3">
                            <label for="student_name" class="form-label">Student Name</label>
                            <input type="text" class="form-control" id="student_name" />
                            <div id="student_nameText" class="form-text">
                                Student Name
                            </div>
                        </div>
                        <!-- END OF STUDENT_NAME INPUT-->


                        <!-- (STUDENT) STUDENT_IC INPUT -->
                        <div class="mb-3">
                            <label for="student_ic" class="form-label">Student Ic</label>
                            <input type="text" class="form-control" id="student_ic" />
                            <div id="student_icText" class="form-text">
                                Student Ic
                            </div>
                        </div>
                        <!-- END OF STUDENT_IC INPUT-->


                        <!-- (STUDENT) STUDENT_GRADE INPUT -->
                        <div class="mb-3">
                            <label for="student_grade" class="form-label">Select Student Grade</label>
                            <select id="student_grade" class="form-select">
                                <option value="">--</option>
                                <option value="15">15</option>
                                <option value="14">14</option>
                                <option value="13">13</option>
                                <option value="12">12</option>
                                <option value="11">11</option>
                                <option value="10">10</option>
                                <option value="9">9</option>
                                <option value="8">8</option>
                                <option value="7">7</option>
                                <option value="6">6</option>
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                        <!-- END OF STUDENT_GRADE INPUT-->

                        <!-- (STUDENT) STUDENT_CENTER INPUT -->
                        <div class="mb-3">
                            <label for="student_center_id" class="form-label">Select Student Grade</label>
                            <select id="student_center_id" class="form-select">
                                <option value="">--</option>
                                <option value="1">BSP</option>
                                <option value="2">SRAI</option>
                                <option value="3">SKPP11</option>
                                <option value="4">SRITIN</option>
                                <option value="5">SMKBSP</option>
                            </select>
                        </div>
                        <!-- END OF STUDENT_CENTER INPUT-->

                        <!-- (STUDENT) STUDENT_ADDRESS INPUT -->
                        <div class="mb-3">
                            <label for="student_address" class="form-label">Student Address</label>
                            <input type="text" class="form-control" id="student_address" />
                            <div id="student_addressText" class="form-text">
                                Student Address
                            </div>
                        </div>
                        <!-- END OF STUDENT_ADDRESS INPUT-->

                        <!-- (STUDENT) STUDENT_TEL_NO INPUT -->
                        <div class="mb-3">
                            <label for="student_tel_no" class="form-label">Student Telephone Number</label>
                            <input type="text" class="form-control" id="student_tel_no" />
                            <div id="student_tel_noText" class="form-text">
                                Student Telephone Number
                            </div>
                        </div>
                        <!-- END OF STUDENT_TEL_NO INPUT-->

                        <!-- (STUDENT) STUDENT_EMAIL INPUT -->
                        <div class="mb-3">
                            <label for="student_email" class="form-label">Student Email</label>
                            <input type="email" class="form-control" id="student_email" />
                            <div id="student_emailText" class="form-text">
                                Student Email
                            </div>
                        </div>
                        <!-- END OF STUDENT_EMAIL INPUT-->

                        <!-- STUDENT CARD -->
                        <div id="student_card">
                            <button class="btn btn-success" onclick="generatePDF()">Print QR</button>
                            <div class="card" id="execute" style="width:55%;height:50%;">
                                <div class="card-body" style="border-style: solid;">
                                    <center>
                                        <div id="title"></div>
                                        <br><br>
                                        <div id="qrcode"></div>
                                    </center>

                                    <div id="list"></div>
                                </div>
                            </div>
                        </div>


                        <!-- STUDENT CARD -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close" class="btn btn-danger" data-bs-dismiss="modal"
                            onclick="clear_modal_data()">
                            Cancel
                        </button>
                        <div id="btn_create">
                            <button type="button" class="btn btn-primary" onclick="insert_get_data()">Create</button>
                        </div>
                        <div id="btn_edit">
                            <button id="save_vendor" type="button" class="btn btn-success"
                                onclick="edit_get_data()">Save
                                edits</button>
                        </div>
                        <!-- END OF MODAL -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>

</script>
<?php
}
else header("../../")


?>