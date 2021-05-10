<?php
    include 'partials/_loginmodal.php';
    include 'partials/_signupmodal.php';
    include 'partials/_dbcon.php';
    session_start();
?>



<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Category
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <?php 
      $sql="SELECT category_id,category_name from category limit 5";
      $result=mysqli_query($con,$sql);
      while($row=mysqli_fetch_assoc($result)){
        $id=$row['category_id'];
        echo '
              <a class="dropdown-item" href="threadlist.php?catid='.$id.'">'.$row['category_name'].'</a>
        ';
      }
      ?>
            </div>  
       </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php" tabindex="-1">Contact</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="search.php?name" method="get">
    <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
     <a href="search.php"></a> <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    
    
      <?php
      // $userl=false;
        if(isset($_SESSION['login']) && ($_SESSION['login'])==true){
          // $userl=true;
          echo '<div class="mx-2 row">
          <p class="text-center text-light mx-1 my-2">Welcome '.$_SESSION['username']. ' </p>
          <a href="partials/_logout.php"><button type="button" class="btn btn-primary">Logout</button></a> </div>
          ';
        }
        else{
          // $userl=false;
          echo '   <div class="mx-2"> 
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginmodal">
      Login
      </button>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#signupmodal">
      Signup
      </button></div>';
        
        }
       ?>

    </form>
  </div>
</nav>







