<?php
session_start();
include "../dbconfig.php";
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['typeOflog']))
{
    function test_input($data)
     {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      $email = test_input($_POST['email']) ;
      $password = test_input($_POST['password']);
      $typeOflog=test_input($_POST['typeOflog']);
      $password = md5($password);

      $type = array("","admin","faculty_list","student_list");
      $type2 = array("","admin","faculty","student");

      $sql="SELECT * FROM {$type[$typeOflog]} where email = '".$email."' and password = '".$password."'  ";
      $result = mysqli_query($conn,$sql) ; 
      
      if (mysqli_num_rows($result)>0)
      {
        $rwo = mysqli_fetch_assoc($result);
        if($rwo['password']===$password && $rwo['email']===$email)
        {
            $_SESSION['login_type'] =$type[$typeOflog];
            $_SESSION['login_view_folder'] = $type2[$typeOflog];
            $_SESSION['email']=$email;
            $_SESSION['image']=$rwo['image'];

            if($_SESSION['login_type']=='student_list')
            {
                if($rwo['email_verified_at']==null)
                {
                    die("Please verify your email <a href='../email-verification.php?username=" . $email . "'>from here</a>") ; 
                }
                else 
                {
                    header("location:../$type2[$typeOflog]");
                    exit;
                }
                
            }
            else
            {
                header("location:../$type2[$typeOflog]");
                exit;
            }

        }
         else
        {          header("location:../login.php?error=Incorect UserName or Password");
        }
     }else{          header("location:../login.php?error=Incorect UserName or Password");
     }
}

?>


