<?php 

  session_start();
  include 'partials/_dbconnect.php';


  
    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/Forum">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/Forum">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Top Categories
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
          $sql = "SELECT category_name, category_id FROM `categories`";
          $result = mysqli_query($conn, $sql);

          while($row=mysqli_fetch_assoc($result)){

           echo '<a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].' ">'.$row['category_name'].'</a>';
          }

          



            
          echo '</div>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="contacts.php" >Contact</a>
        </li>
      </ul>
      <div class="mx-2 row">';

      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        // Important headsup we need to metion method first otherwise it might not work.
        echo '<form class="form-inline my-2 my-lg-0 method="get" action="search.php"  ">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
        <p class="text-light mx-2 my-0"> Welcome - '.$_SESSION['useremail'].'</p>
        <a href="partials/_logout.php" class="btn btn-outline-success ml-2" >LogOut</a>
        
      </form>';
      }



      
      else{
        echo '
        <form class="form-inline my-2 my-lg-0 method="get" action="search.php"   ">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button></form>
        <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#exampleModal">Login</button>
        <button class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#signupModal">Signup</button>
        </form>';
      }
        
      
      echo' </div>
      
    </div>
  </nav>';

  include 'partials/loginModal.php';
  include 'partials/signupModal.php';

  if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){ //here isset($_GET['signupsuccess']) this checks whether it is set or unser and $_GET['signupsuccess']=="true" this checks the string passed in the url.
    echo ' <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
    <strong>Success</strong> You can now log in.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
    
    ';
  }

  else if((isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="false") && (isset($_GET['error']) && $_GET['error']=="Email already in use")){
    echo ' <div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
    <strong>Oops!</strong> Email already in use
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
    
    ';

  }

  else if((isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="false") && (isset($_GET['error']) && $_GET['error']=="Password do not match")){
    echo ' <div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
    <strong>Oops!</strong> Password do not match
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
    
    ';

  }

?>