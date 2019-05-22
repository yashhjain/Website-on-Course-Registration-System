<?php
    require_once('connection.php');
    session_start();
    #The connection parameter is $dbb.
    if(isset($_POST['login']))
    {
        $username_login = $_POST['username'];
        $password_login = $_POST['password'];
        
        if($username_login == 'admin')
        {
            if($password_login == 'admin')
            {
                #Login as admin.
                $_SESSION['user_logging_in'] = 'admin';
                header('Location: pretendadmin.php');
            }
        }
        else
        {
            if(!empty($username_login))
            {
                if(!empty($password_login))
                {
                    
                    //Now we query the database.
                    $query = "SELECT * FROM authentication WHERE username = '$username_login' and password = '$password_login'";
                    $execute_this_query = mysqli_query($dbb, $query);
                    $rows = mysqli_num_rows($execute_this_query);
                    #We should get only one record because username is unique all the time.
                    if($rows == 1)
                    {
                        $records = mysqli_fetch_array($execute_this_query);
                        $retrieved_username = $records['username'];
                        $retrieved_password = $records['password'];
                        if($retrieved_username == $username_login && $retrieved_password == $password_login)
                        {
                            #Accept the user's credentials.
                            #Successful login.
                            echo("Successful login");
                            $_SESSION['user_logging_in'] = $username_login;
                            header('Location: welcome.php');
                        }
                        else
                        {
                            echo("Came here");
                            header('Location: login.html');
                        }
                    }
                    else{
                        #Somehow we have two users with the same username which is prohibited.
                        #Figure out what to do in these scenarios.
                        echo("Login was not successful");
                        header('Location: login.html');
                    }
                }
            }
        }
    }
?>