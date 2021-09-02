<?php
session_start();
    
  if(!isset($_SESSION['username']))
  {
    
    header('location:index.php');
    exit;
  }
?>
<!doctype html>

<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Online Movie</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>
    <!-- Left Panel -->

      <?php
    include('leftpenal.php');
 ?>
    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <?php
            include('header.php');
        ?>
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li>List Booking</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Booking's Deatils</strong>
                                <!-- <div class="page-header float-right">
                                    <button type="button" class="btn btn-outline-secondary">
                                        <a href="add_theater_form.php">Add Theater</a></button>    
                                </div> -->
                                
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Movie</th>
                                          <!--   <th>Theater</th> -->
                                            <th>Name</th>
                                            <th>Contact No</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>seet No</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <?php
                                include("db.php");
                                try {
                                $sql = "select * from movie_list INNER JOIN booking_list ON movie_list.id = booking_list.movie_id";
                                // "SELECT * FROM theatre INNER JOIN movie_list ON theatre.theatre_id=movie_list.theatre_id"
                               // $result = $conn->query($sql);
                              //  print_r($sql);
                                 $result = $conn->prepare($sql);
                                     $result->execute();
                                        //$rows = $result->fetch();
                                 while($row = $result->fetch()) {
                                ?>
                              <tr>
                            <td><?php echo $row['movie_name'] ?></td>
                           <!--  <td><?php echo $row['theatre_id '] ?></td> -->
                            <td><?php echo $row['user'] ?></td>
                            <td><?php echo $row['contact_no'] ?></td>
                            <td><?php echo $row['dates'] ?></td>
                            <td><?php echo $row['timee'] ?></td>
                            <td><?php echo $row['seat_no'] ?></td>
                             
                               <td>
                                
                                <button type="button" class="btn btn-outline-secondary">
                                <a href="delete_booking.php?id=<?php echo $row['booking_id']; ?>">Delete</a> </button></td>
                                    
                              </tr>
                              <?php
                            }
                             }
      catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->
  

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>


</body>

</html>
