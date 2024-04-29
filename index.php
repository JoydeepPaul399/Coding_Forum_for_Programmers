<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Welcome to iDiscuss -Coding Forums</title>

</head>

<body>

    <?php 


//     if(isset($_GET['login']) && $_GET['login']=="no"){
//         echo ' <div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
//     <strong>Oop!</strong> Unable to log in 
//     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//       <span aria-hidden="true">&times;</span>
//     </button>
//   </div>';

//     }

    ?>

<?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    
    <!-- Slider starts here  -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="partials/1.avif" height="500" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="partials/2.avif" height="500" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="partials/3.avif" height="500" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>

        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- Category container starts here -->
    <div class="container my-3">
        <h2 class="text-center my-3">iDiscuss - Browse Categories</h2>
        <div class="row">
            <!-- use a loop to iterate through Categories -->
            <!-- Fetch all the categories  -->
            <?php 
            
            $sql="SELECT * FROM `categories`";
            $result= mysqli_query($conn, $sql);
            while($row=mysqli_fetch_assoc($result)){
                // echo $row['category_id'];
                // echo $row['category_name'];
                
                $cat= $row['category_name']; 
                $id=$row['category_id'];
                $desc= $row['category_description'];
                // "?catid=" is part of a URL query string.It typically indicates that the webpage is expecting a parameter called "catid" to be passed to it. The value of this parameter is usually used by the server-side code to determine what content to display or what action to take. For example, in a forum application, "?catid=" might specify the category ID of the forum threads to display.
                // echo $cat;
                echo '<div class="col md-4">
                <div class="card my-2" style="width: 18rem;">
                    <img src="partials/'.$cat.'.png" height="150" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><a href="threadlist.php?catid='.$id.' ">'.$cat.'</a></h5>
                        <p class="card-text">'.substr($desc, 0, 90).'...</p>
                        <a href="threadlist.php?catid='.$id.' " class="btn btn-primary">View Threads</a>
                    </div>
                </div>

            </div>';
            }
             ?>
        </div>
    </div>


    <?php include 'partials/_footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>