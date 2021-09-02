<?php
session_start();
    
  if(!isset($_SESSION['username']))
  {
    
    header('location:index.php');
    exit;
  }
?> 
<?php
   include "db.php";
try 
{
   if(isset($_POST["submit"]))
    {
    $nm=$_POST['name'];
    $dis=$_POST['discription'];
    $lng=$_POST['lang'];
    $ldate=$_POST['ldate'];
    $timee=$_POST['dtime'];
    $theatre_name=$_POST['theatre_name'];
    $sno=$_POST['sno'];
  //  $city=$_POST['city'];
    $price=$_POST['price'];
    $tamp = explode(".", $_FILES['photo']['name']);
    $extension = end($tamp);
    $img = $_FILES['photo']['name'];
    $path = 'images/poster/';
     move_uploaded_file($_FILES['photo']['tmp_name'],($path . $img));
    // echo "$img";
     foreach($theatre_name as $item)
    {
         //print_r($theatre_name);
         //echo $item."<br>";
          $sql="INSERT INTO movie_list(movie_name,discription,language,   launch_date,timess,theatre_id,screen_no,image,price)VALUES('$nm','$dis','$lng','$ldate','$timee','$item','$sno','$img','$price')";
  
     $conn->exec($sql);
         
       
    }
   // die();
   
      header("location:show_movie.php");
      echo "successfully inserted";
    }
  }
  catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

?>

<!doctype html>

<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Online Movie Booking</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="multiselect-master/styles/multiselect.css" rel="stylesheet"/>
    <script src="multiselect-master/multiselect.min.js"></script>

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">


    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>


    <!-- Left Panel -->

     <?php
    include('leftpenal.php');
 ?>
   <!-- /#left-panel -->

    

    <div id="right-panel" class="right-panel">

        <!-- Header-->
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
                        <li><a href="add_movie.php">Add Movie</a></li>
                            
                        </ol>
                    </div>
                </div>
            </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Add Movie Detail's</strong></div>
                            <div class="card-body card-block">
                                <form name="myform"  method="POST" id="emp" onsubmit="return validateform()" enctype="multipart/form-data">
                                  <div class="form-group">
                                        <label for="studentname" class=" form-control-label">Theater</label><br>
                                       <select id='testSelect1' multiple name="theatre_name[]">

    <?php
        include "db.php";  // Using database connection file here
          
         $sql = "select * from theatre";
         $result = $conn->prepare($sql);
         $result->execute();
                                      
         while($row = $result->fetch())
         {
    ?>
     <option value='<?php echo  $row['theatre_id'] ?>'><?php echo $row['theatre_name'] ?> </option>
                  <?php } ?>
    
</select>
                                         <span id='blanktheater'></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class=" form-control-label">Name</label>
                                        <input type="text" name="name" id="name"  placeholder="Enter Movie name" class="form-control"/>
                                         <span id='blankname'></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="Dis" class=" form-control-label">Discription</label>
                                        <input type="text" name="discription" id="dis"  placeholder="Enter Discription" class="form-control"/>
                                         <span id='blankdiscription'></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="lan" class=" form-control-label">Language</label>
                                        <input type="text" name="lang" id="lang"  placeholder="Enter Language" class="form-control"/>
                                         <span id='blanklang'></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="ldate" class=" form-control-label">Lunch Date</label>
                                        <input type="Date" name="ldate" id="ldate"  class="form-control"/>
                                         <span id='blankldate'></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="dt" class=" form-control-label">Time</label>
                                        <input type="Time" name="dtime" id="dtime"  class="form-control"/>
                                         <span id='blankdtime'></span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="sno" class=" form-control-label">Screen No</label>
                                        <input type="text" name="sno" id="sno"  class="form-control"/>
                                         <span id='blanksno'></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="img" class=" form-control-label">Image</label>
                                        <input type="file" name="photo" id="photo"  class="form-control"/>
                                         <span id='blankphoto'></span>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="ct" class=" form-control-label">City</label>
                                        <input type="text" name="city" id="city"  class="form-control"/>
                                         <span id='blankcity'></span>
                                    </div> -->
                                    <div class="form-group">
                                        <label for="sno" class=" form-control-label">Price</label>
                                        <input type="text" name="price" id="price"  class="form-control"/>
                                         <span id='blankprice'></span>
                                    </div>
                                    <div style="flex-direction: row;margin-left: 20px">
                                        <button type="submit" name="submit" class="btn btn-outline-secondary">
                                            Save
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary">
                                            <a href="dashboard.php">Cancel</a>
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>


        </div>


        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>

<script>
    document.multiselect('#testSelect1')
        .setCheckBoxClick("checkboxAll", function(target, args) {
            console.log("Checkbox 'Select All' was clicked and got value ", args.checked);
        })
        .setCheckBoxClick("1", function(target, args) {
            console.log("Checkbox for item with value '1' was clicked and got value ", args.checked);
        });

    function enable() {
        document.multiselect('#testSelect1').setIsEnabled(true);
    }

    function disable() {
        document.multiselect('#testSelect1').setIsEnabled(false);
    }
</script>

</body>
<script>
    function validateform() 
    {
      let name=document.forms["myform"]["name"].value;
      if (name=="") 
      {
        let span = document.getElementById('blankname')
        span.innerHTML = "<span style='color: red;'>"+
                        "Please enter name</span>"
        return false;
      }
      let discription=document.forms["myform"]["discription"].value;
      if (discription=="") 
      {
        let span = document.getElementById('blankdiscription')
        span.innerHTML = "<span style='color: red;'>"+
                        "Please enter discription</span>"
        return false;
      }
      let lang=document.forms["myform"]["lang"].value;
      if (lang=="") 
      {
        let span = document.getElementById('blanklang')
        span.innerHTML = "<span style='color: red;'>"+
                        "Please enter language</span>"
        return false;
      }
      let ldate=document.forms["myform"]["ldate"].value;
      if (ldate=="") 
      {
        let span = document.getElementById('blankldate')
        span.innerHTML = "<span style='color: red;'>"+
                        "Please enter date</span>"
        return false;
      }
      let dtime=document.forms["myform"]["dtime"].value;
      if (dtime=="") 
      {
        let span = document.getElementById('blankdtime')
        span.innerHTML = "<span style='color: red;'>"+
                        "Please enter time</span>"
        return false;
      }
      let sno=document.forms["myform"]["sno"].value;
      if (sno=="") 
      {
        let span = document.getElementById('blanksno')
        span.innerHTML = "<span style='color: red;'>"+
                        "Please enter screen number</span>"
        return false;
      }
      let photo=document.forms["myform"]["photo"].value;
      if (photo=="") 
      {
        let span = document.getElementById('blankphoto')
        span.innerHTML = "<span style='color: red;'>"+
                        "Please enter image</span>"
        return false;
      }
      let city=document.forms["myform"]["city"].value;
      if(city=="")
      {
        let span = document.getElementById('blankcity')
        span.innerHTML = "<span style='color: red;'>"+
                        "Please enter city</span>"
        return false;
      }
      let price=document.forms["myform"]["price"].value;
      if(price=="")
      {
        let span = document.getElementById('blankprice')
        span.innerHTML = "<span style='color: red;'>"+
                        "Please enter price</span>"
        return false;
      }
     }
           
  </script>


</html>
