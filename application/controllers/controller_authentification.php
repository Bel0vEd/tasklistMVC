<?php

class Controller_authentification extends Controller
{

    function __construct()
	{
		//$this->model = new Model_Portfolio();
        //
        $this->model = new Model_authentification();
        $this->view = new View();
	}

	function action_index()
	{	
        $this->view->generate('authorization_view.php');
        
    }

    function action_authentificationOrRegister()
    {
        $theUserExists = $this->model->checkRegisterUser($_POST['login']);

        if ($theUserExists) 
        {
            $passwordCorrect = $this->model->checkUserPassword($_POST['login'], $_POST['password']);

            if ($passwordCorrect) {
                //$host = 'http://'.$_SERVER['HTTP_HOST'];
                $hash = md5(md5($_POST['login'].$_POST['password']));
                setcookie("hash", $hash, time()+3600, '/');
                //header('Location:'.$host);
            }
            else
            {
                $host = 'http://'.$_SERVER['HTTP_HOST'];
                header('Location:'.$host);
            }
        }
        else
        {
            $this->model->userRegister($_POST['login'], $_POST['password']);
            
            //$host = 'http://'.$_SERVER['HTTP_HOST'];
            $hash = md5(md5($_POST['login'].$_POST['password']));
            setcookie("hash", $hash, time()+3600, '/');
            //header('Location:'.$host);
        }
        $host = 'http://'.$_SERVER['HTTP_HOST'];
        header('Location:'.$host);
    }
    
    
}