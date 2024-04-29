<!-- <?php 
// session_start(); //Already a session is started in _header.php file so no need to start the session here

?> -->

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
    #ques {
        min-height: 433px;
    }
    </style>

    <title>Welcome to iDiscuss -Coding Forums</title>

</head>

<body>

    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    <?php

    $id= $_GET['catid'];
    

    $sql="SELECT * FROM `categories` WHERE category_id='$id' ";
    $result= mysqli_query($conn, $sql);
    
   
    while($row=mysqli_fetch_assoc($result)){
        $catname=$row['category_name'];
        $catdesc=$row['category_description'];
    }
    
    ?>


    <?php 
    $showAlert=false;
    $method= $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        //Insert thread into db
        $th_title=$_POST['title'] ;
        $th_desc= $_POST['desc'] ;
            
        // $user_sl= $_SESSION['slno']
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$th_uid', current_timestamp())";
        $result= mysqli_query($conn, $sql);
        $showAlert=true;

        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your thread has been added please wait for community to respond
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    }

    ?>




    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> forums</h1>
            <p class="lead"><?php echo $catdesc ?></p>
            <hr class="my-4">
            <p>This is the pair to pair forum for sharing knowledge with each other, Keep it friendly.
                Be courteous and respectful. Appreciate that others may have an opinion different from yours.
                Stay on topic,
                Share your knowledg,
                Refrain from demeaning, discriminatory, or harassing behaviour and speech.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>

    </div>

    <!-- //$_SERVER['PHP_SELF'] it method send a request in same page
        // $_SERVER['REQUEST_URI'] it send request to same page along with the query string basically the text after question mark(?) -->

    <?php 

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=true){
        echo '
        <div class="container">
        <h1 class="py-2">Start a discussion</h1> 
        
            <form action=" '. $_SERVER['REQUEST_URI'].'" method="post" >
                <div class="form-group">
                    <label for="exampleInputEmail1">Problem Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">keep your title as short and crisp as
                        possible</small>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Ellaburate Your Concern</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>';
        }

        else{
            echo '
            <div class="container">
                <h1 class="py-2">Start a discussion</h1>
                <p class="lead">You are not logged in. Please log in to be able to start discussion</p>
                <button class="btn btn-success btn-lg ml-2" data-toggle="modal" data-target="#exampleModal">Login</button>
            </div>
            ';
        }
        ?>









    <?php
    $id= $_GET['catid'];
    $sql="SELECT * FROM `threads` WHERE thread_cat_id='$id' ";
    $result= mysqli_query($conn, $sql);
    $noResult=true;
    
   echo '<div class="container mb-5" id="ques">
   <h1 class="py-2">Browse questions</h1>';
    while($row=mysqli_fetch_assoc($result)){
        $id= $row['thread_id'];
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];
        $noResult=false;
        $thread_time=$row['timestamp'];
        $thread_user_id= $row['thread_user_id'];
        $sql2= " SELECT `user_email` FROM `users` WHERE `slno`= '$thread_user_id' ";
        $result2=mysqli_query($conn, $sql2);
        $row2=mysqli_fetch_assoc($result2);

        echo '<div class="container media my-3">
            <img src="partials/default.jfif" width="54px" class="mr-3" alt="...">
            <div class="media-body">
                <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid='.$id.' ">'.$title.' </a></h5>
                '.$desc.' <p class="font-weight-bold my-0">asked by '.$row2['user_email'].' at '.$thread_time.'</p>
            </div>
        </div>';
    }

    if($noResult){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <p class="display-4">No Threads Found </p>
          <p class="lead">Be the first person to ask a question</p>
        </div>
      </div>' ;
        
    }

        ?>

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