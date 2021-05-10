
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>IDiscuss Coding forum</title>
  </head>
  <body>
  <?php 
    include 'partials/_dbcon.php';?>
      <?php 
    include 'partials/_header.php';
    ?>
  <?php
 $id=$_GET['catid'];
 $sql="SELECT * from category where category_id='$id'";
 $result=mysqli_query($con,$sql);
 $row=mysqli_fetch_assoc($result);
 $name=$row['category_name'];
 $catdesc=$row['category_desc'];
  ?>


  <?php
  $method=$_SERVER["REQUEST_METHOD"];
  // echo $method;
    if($method=="POST"){
        $title=$_POST['tname'];
        $txtdesc=$_POST['txtdesc'];

        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title); 

        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc); 


       $no=$_POST['sno'];
        // echo $title;
      
      $sql="INSERT INTO `thread` (`thread_title`, `thread_desc`, `thread_catid`, `thread_user`, `Date`) VALUES ('$title', '$txtdesc', '$id', '$no', current_timestamp())";
      $result=mysqli_query($con,$sql);
      $showAlert = true;
    if($showAlert){
      echo '
          <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
          <strong>Success!</strong> Your thread has been added! Please wait for community to respond!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      ';
    }
     
  }
?>

    <div class="container my-3">
    <div class="jumbotron">
      <h1 class="display-4">Welcome to <?php echo $name;?> forums</h1>
      <p class="lead"><?php echo $catdesc;?></p>
      <hr class="my-4">
      <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
      post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
      questions. Remain respectful of other members at all times.</p>
      <a class="btn btn-success btn-lg" href="#" role="button">Learn More</a>
    </div>
  </div>
  



<?php
 $id=$_GET['catid'];
 
   if(isset($_SESSION['login']) && $_SESSION['login']==true){
    
    echo '<div class="container">
    <h1>Start a Discussion</h1>
    <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
      <div class="form-group">
        <label for="title">Problem Tile</label>
        <input type="tname" class="form-control" id="tname" name="tname" aria-describedby="emailHelp">
       
      </div>
      
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Elaborate Your Concern</label>
        <textarea class="form-control" id="txtdesc" name="txtdesc" rows="3"></textarea>
        <input type="hidden" name="sno" value="'. $_SESSION['num']. '">
      </div>
      <button type="submit" class="btn btn-success">Submit</button>
    </form>
    </div>';
  }

  else{
    echo '
    <div class="container">
    <h1>Start a Discussion</h1>
           <div class="jumbotron">
                   <p class="display-4 ">No Threads Found</p>
                        <p class="lead"> Be the first person to ask a question</p>
                    </div>
                 </div> 
        
    ';
  }
  ?>


<div class="container my-2">
 <h1>Browse Questions</h1>
<?php

 $id=$_GET['catid'];
 $sql="SELECT * from thread where thread_catid=$id";
 $result=mysqli_query($con,$sql);
 while($row=mysqli_fetch_assoc($result)){;
 $tid=$row['thread_id'];
 $title=$row['thread_title'];
 $desc=$row['thread_desc'];
 $date=$row['Date'];

 echo '

  <div class="media py-2">
  <img src="img/user.png" height=30px width=30px class="mr-3 my-2" alt="cc">
    <div class="media-body">
     <a href="thread.php?threadid='.$tid.'" class="href"> <h5 class="mt-0">'.$title.'</h5></a>
     '.$desc.' 
    </div><p><em>Posted at:'.$date.'</em></p>
  </div>
';
 }
?></div>








    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>

