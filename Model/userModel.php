<?php
    class userModel
    {
        

        function checkRegisterUser($login, $password)
        {
            include 'connectDB.php';
            $query = "SELECT * FROM users WHERE login = '$login'";
            $request = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
            
            if(mysqli_num_rows($request) > 0)
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }

        function userRegister($login, $password)
        {
            include 'connectDB.php';
            $query = "INSERT INTO users (login, password, user_hash) VALUES ('$login', '$password', '$hash')";
            $request = mysqli_query($link, $query) or die("Ошибка регистрации" . mysqli_error($link));
            
        }

        function checkUserPassword($login, $password)
        {
            include 'connectDB.php';
            $query = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
            $request = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
            

            if(mysqli_num_rows($request) > 0)
            {
                
                return 1;
                
            }
            else
            {
                
                return 0;
            }
        }

        function userSetHash($hash)
        {
            include 'connectDB.php';
            $query = "UPDATE users SET user_hash = '$hash' WHERE login = '$login' AND password = '$password'";
            $request = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        }

    }
?>