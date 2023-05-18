<?php
session_start();


// User only can have access when session is set to admin
if(isset($_SESSION["admin"])=="admin"){
    require 'includes/includes.5.1_attendance_report.php';
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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css">


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
                                <li><a class="dropdown-item" href="#">Attendance Report</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- End of navigation bar  -->
        <div id="display"></div>

        <div id="table">
            <table border="0" cellspacing="5" cellpadding="5">
                <tbody>
                    <tr>
                        <td>Minimum date:</td>
                        <td><input type="text" id="min" name="min"></td>
                    </tr>
                    <tr>
                        <td>Maximum date:</td>
                        <td><input type="text" id="max" name="max"></td>
                    </tr>
                </tbody>
            </table>
            <table id="example" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Center</th>
                        <th>Session</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>

                    <?php echo $display_attendence_report_func->v_display_attendence_report_func();?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Center</th>
                        <th>Session</th>
                        <th>Name</th>
                    </tr>
                </tfoot>
            </table>
        </div>


    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>


</html>
<script>
var minDate, maxDate;

// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date(data[1]);


        if (
            (min === null && max === null) ||
            (min === null && date <= max) ||
            (min <= date && max === null) ||
            (min <= date && date <= max)
        ) {
            return true;
        }
        return false;
    }
);

$(document).ready(function() {
    // Create date inputs
    minDate = new DateTime($('#min'), {
        format: 'MMMM Do YYYY'
    });
    maxDate = new DateTime($('#max'), {
        format: 'MMMM Do YYYY'
    });


    // Refilter the table
    $('#min, #max').on('change', function() {
        table.draw();
    });

    // Setup - add a text input to each footer cell
    $('#example tfoot th').each(function() {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    });



    // DataTables initialisation
    var table = $('#example').DataTable({
        initComplete: function() {
            // Apply the search
            this.api()
                .columns()
                .every(function() {
                    var that = this;

                    $('input', this.footer()).on('keyup change clear', function() {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
        },
        // Set target column
        columnDefs: [{
            searchable: false,
            orderable: false,
            targets: 0,
        }, ],
        order: [
            [1, 'asc']
        ],
    });

    // Set the row number and increment
    table.on('order.dt search.dt', function() {
        let i = 1;

        table.cells(null, 0, {
            search: 'applied',
            order: 'applied'
        }).every(function(cell) {
            this.data(i++);
        });
    }).draw();

});
$(document).ready(function() {
    // var t = $('#example').DataTable({
    //     columnDefs: [{
    //         searchable: false,
    //         orderable: false,
    //         targets: 0,
    //     }, ],
    //     order: [
    //         [1, 'asc']
    //     ],
    // });

    // t.on('order.dt search.dt', function() {
    //     let i = 1;

    //     t.cells(null, 0, {
    //         search: 'applied',
    //         order: 'applied'
    //     }).every(function(cell) {
    //         this.data(i++);
    //     });
    // }).draw();
});
</script>

<?php
}
else header('Location:../../');


?>