<?php
 include '_dbcon.php';
 if($_SERVER["REQUEST_METHOD"]=="POST"){
     $name=$_POST['uname'];
     $pass=$_POST['password'];
     $cpass=$_POST['cpassword'];
     
     $sql="SELECT * from `login` where username='$name'";
     $result=mysqli_query($con,$sql);
     $num=mysqli_num_rows($result);
     if($num>0){
        echo 'user exist';
     }
     else{
         if($pass==$cpass){
             $hash=password_hash("$pass",PASSWORD_DEFAULT);
             $sql="INSERT into `login` (`username`,`password`,`date`) values ('$name','$hash',current_timestamp())";
             $result=mysqli_query($con,$sql);
             if($result){
                //  echo "success";
                
                header("location:/APHP/FORUM/index.php");
                // $_SESSION[]
             }
             else{
                 echo "invalid";
             }
         }
         else{
             echo "invalid1";
         }
     }
 }

?>