<?php

class Model_authentification extends Model
{
	
	public function get_data()
	{	
		
    }
    
    
    private $connect_db;

    function __construct()
    {
        $this->connect_db = new connect_database();
        
        
    }

    function checkRegisterUser($login)
        {
            
            $link = $this->connect_db->getLink();
            $mysqli = $this->connect_db->getMysqli();
            
            $login = $mysqli->real_escape_string($login);
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
            $link = $this->connect_db->getLink();
            $mysqli = $this->connect_db->getMysqli();

            $login = $mysqli->real_escape_string($login);
            $password = $mysqli->real_escape_string($password);
            $hash = md5(md5($login.$password));
            $query = "INSERT INTO users (login, password, user_hash) VALUES ('$login', '$password', '$hash')";
            $request = mysqli_query($link, $query) or die("Ошибка регистрации" . mysqli_error($link));
            $this->userSetHash($hash, $login, $password);
            
        }

        function checkUserPassword($login, $password)
        {
            $link = $this->connect_db->getLink();
            $mysqli = $this->connect_db->getMysqli();

            $login = $mysqli->real_escape_string($login);
            $password = $mysqli->real_escape_string($password);
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

        function userSetHash($hash, $login, $password)
        {
            $link = $this->connect_db->getLink();
            $mysqli = $this->connect_db->getMysqli();

            $login = $mysqli->real_escape_string($login);
            $password = $mysqli->real_escape_string($password);
            $query = "UPDATE users SET user_hash = '$hash' WHERE login = '$login' AND password = '$password'";
            $request = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        }

}
