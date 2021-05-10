<?php
 include '_dbcon.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name=$_POST['uname'];
    $pass=$_POST['password'];
    echo $pass;
    $sql="SELECT * from `login` where username='$name'";
    $result=mysqli_query($con,$sql);
    $row=mysqli_fetch_assoc($result);
    // echo var_dump($row);
    
    $p=$row['password'];
    $no=$row['sr_no'];
    echo $p;
    if(password_verify("$pass","$p")){
        
        session_start();
        $_SESSION['login']=true;
        $_SESSION['username']=$name;
        $_SESSION['num']=$no;
        header("location:/APHP/FORUM/index.php");
    }

}
?>