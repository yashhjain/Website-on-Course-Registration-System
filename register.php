<?php 
    $dbb= mysqli_connect('localhost','root','root','coursemanagement');
    $retrived_name = $_POST['name'];
    $retrived_username = $_POST['username'];
    $retrived_email = $_POST['email'];
    $retrived_password = $_POST['password'];
    $query_to_register = "INSERT INTO authentication (name,username, emailid,password) VALUES ('$retrived_name','$retrived_username' ,'$retrived_email','$retrived_password')";
    $confirm = mysqli_query($dbb,$query_to_register);
    if($confirm)
    {
        echo("Success.");
    }
    else{
        echo("Could not register you to the database.");
    }
?>