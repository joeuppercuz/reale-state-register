
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width," intitial-scale="1" maximum-scale="1">
    <!-- Css -->
    <!--
    <link rel="stylesheet" type="text/css" href="assets/DataTables-1.10.11/css/dataTables.bootstrap.min.css">  -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/bs-3.3.6/jq-2.2.0,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.11,af-2.1.1,b-1.1.2,b-colvis-1.1.2,b-flash-1.1.2,b-html5-1.1.2,b-print-1.1.2,cr-1.3.1,fc-3.2.1,fh-3.1.1,kt-2.1.1,r-2.0.2,rr-1.1.1,sc-1.4.1,se-1.1.2/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/t/bs-3.3.6/jq-2.2.0,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.11,af-2.1.1,b-1.1.2,b-colvis-1.1.2,b-flash-1.1.2,b-html5-1.1.2,b-print-1.1.2,cr-1.3.1,fc-3.2.1,fh-3.1.1,kt-2.1.1,r-2.0.2,rr-1.1.1,sc-1.4.1,se-1.1.2/datatables.min.js"></script>
    <!-- link rel="stylesheet" type="text/css" href="assets/datatables.min.css"/ -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <title><?php echo $env['APP_NAME']; ?> | Data</title>
</head>
<body>
    <nav id="top_header" class="navbar navbar-default ">
        <div class="container">

            <!--navbar-->
            <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" style="color:#353535;">
                        Menu
                    </button>
                    <a class="navbar-brand" href="#"><?php echo $env['APP_NAME']; ?></a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a id="btn1" href="">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

            <!--navbar-->
        <div class="container" style="padding-top:100px;">
            <table id="data" class="table" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>เบอร์โทร</th>
                <th>อีเมล</th>
                <!-- <th>แบบบ้าน</th> -->
                <th>Ref</th>
                <th>Medium</th>
                <th>Campaign</th>
                <th>วัน-เวลาบันทึก</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>#</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>เบอร์โทร</th>
                <th>อีเมล</th>
                <!-- <th>แบบบ้าน</th> -->
                <th>Ref</th>
                <th>Medium</th>
                <th>Campaign</th>
                <th>วัน-เวลาบันทึก</th>
            </tr>
        </tfoot>
        <tbody>
            <?php
                foreach ($records as $record) {
                    echo '<tr>';
                    echo "<td>{$record['id']}</td>";
                    echo "<td>{$record['name']}</td>";
                    echo "<td>{$record['surname']}</td>";
                    echo "<td>{$record['tel']}</td>";
                    echo "<td>{$record['email']}</td>";
                    // echo "<td>{$record['type']}</td>";
                    echo "<td>{$record['ref']}</td>";
                    echo "<td>{$record['medium']}</td>";
                    echo "<td>{$record['campaign']}</td>";
                    echo "<td>{$record['created_at']}</td>";
                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>
        </div>

    </footer>
    <!--script type="text/javascript" src="assets/datatables.min.js"></script-->
<script type="text/javascript">
//  $(document).ready(function() {
//      $('#data').DataTable({
//             dom: 'Bfrtip',
//             buttons: [
//                 'copyHtml5',
//                 'excelHtml5',
//                 'csvHtml5',
//                 'pdfHtml5'
//                  ]
//         });
// } );

        $(document).ready(function() {
            $('#data').DataTable({
                "pagingType": "full_numbers",
                "order": [[ 0, "asc" ]],
          dom: 'Bfrtip',
              buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
                 ]
            });
        } );

</script>
</body>
</html>
