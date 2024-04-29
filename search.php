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
            #maincontainer{
                min-height: 100vh;
            }
        </style>

    <title>Welcome to iDiscuss -Coding Forums</title>

</head>

<body>

    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    
    
    <!-- search result  -->
    <!-- To implement search logic we need to implement fulltext search we can read it later for this we can use alter and ......... alter table threads add FULLTEXT (`thread_title`, `thread_desc`); enabling fulltext search in thread table -->
    
    <div class="container my-3" id="maincontainer" >
        <h1 class="py-3">Search results for <em>"<?php echo $_GET['search'] ?>"</em> </h1>

        <?php 
            $noresult=true;
            $query= $_GET["search"];

            $sql="select * from threads where match (thread_title, thread_desc) against ('$query')";
            $result= mysqli_query($conn, $sql);


            while($row=mysqli_fetch_assoc($result)){
                $noresult=false;
                $title=$row['thread_title'];
                $catdesc=$row['thread_desc'];
                $thread_id= $row['thread_id'];
                $url= "thread.php?threadid=".$thread_id;
                
                //displaying the search result
                echo '
                <div class="result">
                    <h3> <a href="'.$url.'" class="text-dark"> '.$title.' </a></h3>
                    <p>'.$catdesc.'</p>
                </div>';        
            }

            if($noresult){
                echo '<div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <p class="display-4">No Results Found </p>
                            <p class="lead">Suggestions:<ul>

                                <li>Make sure that all words are spelled correctly.</li>
                                <li>Try different keywords.</li>
                                <li>Try more general keywords.</li>
                                <li>Try fewer keywords.</li>
                                </ul>
                            </p>
                        </div>
                    </div>';    
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