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
    $id= $_GET['threadid'];
    $sql="SELECT * FROM `threads` WHERE thread_id='$id' ";
    $result= mysqli_query($conn, $sql);
    
   
    while($row=mysqli_fetch_assoc($result)){
        $title=$row['thread_title'];
        $catdesc=$row['thread_desc'];
        $thread_user_id=$row['thread_user_id'];
        
        $sql2=" SELECT `user_email` FROM `users` WHERE `slno`='$thread_user_id'";
        $result2=mysqli_query($conn, $sql2);
        $row2= mysqli_fetch_assoc($result2);
        $posted_by= $row2['user_email'];
    }
    
    ?>


<?php 
    $showAlert=false;
    $method= $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        //Insert data into comment db
        $comment=$_POST['comment'] ;
        $comment=str_replace('<', '$lt', $comment); //Replacing < and > as when somebody will comment some html it should be executed if we do not do this it will be executed and can create a problem. same thing we have to implement at all the inputs for now I am skipping this process
        $comment=str_replace('>', '$gt', $comment);
        $th_uid= $_SESSION['slno'] ;
        $sql = " INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ( '$comment', '$id', $th_uid, current_timestamp()); ";
        $result= mysqli_query($conn, $sql);
        $showAlert=true;

        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your comment has been added!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    }

    ?>


    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title; ?> forums</h1>
            <p class="lead"><?php echo $catdesc ?></p>
            <hr class="my-4">
            <p>This is the pair to pair forum for sharing knowledge with each other, Keep it friendly.
                Be courteous and respectful. Appreciate that others may have an opinion different from yours.
                Stay on topic,
                Share your knowledg,
                Refrain from demeaning, discriminatory, or harassing behaviour and speech.</p>
            <p>Posted by:<b><?php echo $posted_by; ?></b></p>
        </div>

    </div>

    <?php 
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '
        <div class="container">
    <h1 class="py-2">Post a comment</h1> 

        <form action="'.$_SERVER['REQUEST_URI'].'" method="post" >
            
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Type your comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Post comment</button>
        </form>
    </div>

        ';
    }

    else{
        echo '
            <div class="container">
                <h1 class="py-2">Post a comment</h1>
                <p class="lead">You are not logged in. Please log in to be able to post comment</p>
                <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#exampleModal">Login</button>
            </div>
            ';
    }

    ?>

    

    

    <div class="container" id="ques">
        <h1 class="py-2">Discussions</h1>


        

        <?php
    $id= $_GET['threadid'];
    // $id= $_GET['catid'];
    $sql="SELECT * FROM `comments` WHERE thread_id='$id' ";
    $result= mysqli_query($conn, $sql);
    $noResult=true;
    

    while($row=mysqli_fetch_assoc($result)){
        $noResult=false;
        $id= $row['comment_id'];
        $content=$row['comment_content'];
        $comment_time=$row['comment_time'];
        $comment_by= $row['comment_by'];
        $sql2=" SELECT `user_email` FROM `users` WHERE `slno`='$comment_by'";
        $result2=mysqli_query($conn, $sql2);
        $row2= mysqli_fetch_assoc($result2);

        echo '<div class="media my-3">
            <img src="partials/default.jfif" width="54px" class="mr-3" alt="...">
            <div class="media-body">
                <p class="font-weight-bold my-0">'.$row2['user_email'].' at '.$comment_time.'</p>
                '.$content.'
            </div>
        </div>';
    }

    if($noResult){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <p class="display-4">No Comments Found </p>
          <p class="lead">Be the first person to ask a question</p>
        </div>
      </div>' ;
        
    }

        ?>


<!-- Delete the code later -->
    <!-- <?php
    $id= $_GET['threadid'];
    $sql="SELECT * FROM `threads` WHERE thread_cat_id='$id' ";
    $result= mysqli_query($conn, $sql);
    $noResult=true;
    

    while($row=mysqli_fetch_assoc($result)){
        $noResult=false;
        $id= $row['thread_id'];
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];
        

    


        echo '<div class="media my-3">
            <img src="partials/default.jfif" width="54px" class="mr-3" alt="...">
            <div class="media-body">
                <h5 class="mt-0"><a class="text-dark" href="thread.php">'.$title.' </a></h5>
                '.$desc.'
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

        ?> -->

        <!-- Till here -->

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