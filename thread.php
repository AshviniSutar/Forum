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
    include 'partials/_dbcon.php';
    ?>
     <?php 
    include 'partials/_header.php';
    ?>
  <?php
  // $no=$_SESSION['num'];
$id=$_GET['threadid'];
$sql="SELECT * from thread where thread_id=$id";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
      $title=$row['thread_title'];
      $desc=$row['thread_desc'];
      $user=$row['thread_user'];

      $sql2="SELECT username from `login` where sr_no='$user'";
      $result2=mysqli_query($con,$sql2);
      // echo $result2;
      $row2=mysqli_fetch_assoc($result2);
      $name=$row2['username'];
      // $date1=$row2['date'];
      // echo $name;

?>

<?php
$method = $_SERVER['REQUEST_METHOD'];
  if($method=="POST"){
    $comment=$_POST['comment'];
    
    $comment = str_replace("<", "&lt;", $comment);
    $comment = str_replace(">", "&gt;", $comment); 

    $userid=$_POST['sno'];
    $sql="INSERT into  `comments` (`comment_content`,`thread_id`,`comment_by`,`comment_time`) values('$comment',$id,'$userid',current_timestamp())";
    $result=mysqli_query($con,$sql);
    $showAlert = true;
    if($showAlert){
      echo '
          <div class="alert alert-success alert-dismissible fade show " role="alert">
          <strong>Success!</strong> Your comment has been added!
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
    <h1 class="display-4"><?php echo $title; ?></h1>
    <p class="lead"><?php echo $desc; ?></p>
    <hr class="my-4">
    <p>Posted By <b> <?php echo $name; ?></b> </p>
  </div>
</div>



<?php

if(isset($_SESSION['login']) && $_SESSION['login']==true){
    echo '
        <div class="container">
        <h1>Post a Comment</h1>
        <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
          <div class="form-group">
            <label for="title">Type your comment</label>
          </div>
          <div class="form-group">
            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            <input type="hidden" name="sno" value="'. $_SESSION['num']. '">
          </div>
      <button type="submit" class="btn btn-success">Submit</button>
        </form>
        </div>';
}
else{
 
 echo'
         <div class="container">
        <h1>Post a Comment</h1>
        <div class="jumbotron py-5">
        <p>You are not logged in. Please login to be able to post comments.</p>
        </div>
        </div>
        ';
}
?>

<div class="container my-2">
      <h1>Discussions</h1>
<?php
  $sql="SELECT * from comments where thread_id=$id";
  $result=mysqli_query($con,$sql);
  while($row=mysqli_fetch_assoc($result)){
    $content=$row['comment_content'];
    $date=$row['comment_time'];
    $userid=$row['comment_by'];

    $sql2="SELECT username from `login` where sr_no=$userid";
    $result2=mysqli_query($con,$sql2);
    $row2=mysqli_fetch_assoc($result2);
    $user=$row2['username'];

  echo '
      <div class="media my-2">
        <img src="img/user.png" height=30px width=30px class="mr-3 my-2" alt="cc">
        <div class="media-body">
        <p class="font-weight-bold my-0">'.$user.' at '.$date.' </p>'.$content.'
        </div>
      </div>
    
  ';
  }
 
?>



</div>












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

