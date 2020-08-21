<?php
    spl_autoload_register(function ($class_name) {
        
        $pathFile = '../Model/'.$class_name . '.php';
        if (file_exists($pathFile) && is_readable($pathFile)) {
            require $pathFile;
        }
        $pathFile = '../View/'.$class_name . '.php';
        if (file_exists($pathFile) && is_readable($pathFile)) {
            require $pathFile;
        } 
    });
    //setcookie("hash", "", time()+3600);
    //include '../View/view.php';
    //include '../Model/userModel.php';
    //include '../Model/taskModel.php';

    

    $controller = new Controller();
    
    $controller->requestProcessing($_GET['request']);
    
    class Controller
    {
        private $view;
        private $userModel;
        private $taskModel;

        function __construct()
        {
            $this->userModel = new userModel();
            $this->view = new view();
            $this->taskModel = new taskModel();
        }


        function requestProcessing($request)
        {
            
            if(isset($_COOKIE['hash']))
            {
                //setcookie("hash", "", time()+3600);
                //echo $_COOKIE['hash'];
                
                $listTasks = $this->taskModel->getListTasks($_COOKIE['hash']);
                $this->view->showListTasks($listTasks);
            }
            else
            {
                if (strcasecmp($request, 'registerOrCheckUser') != 0){
                    $this->view->showAuthorization();
                    die();
                }
                
            }
                
            
            if(isset($request))
            {
                
                switch ($request) {
                    case 'registerOrCheckUser':
                        
                        if ($this->userModel->checkRegisterUser($_POST['login'], $_POST['password']) == 0) 
                        {
                            $this->userModel->userRegister($_POST['login'], $_POST['password']);
                            $hash = md5(md5($_POST['login'].$_POST['password']));
                            $this->userModel->userSetHash($hash, $_POST['login'], $_POST['password']);
                            setcookie("hash", $hash, time()+3600);
                            $this->view->refreshPage();
                        }
                        else
                        {
                            if($this->userModel->checkUserPassword($_POST['login'], $_POST['password']) == 1)
                            {
                                $hash = md5(md5($_POST['login'].$_POST['password']));
                                $this->userModel->userSetHash($hash, $_POST['login'], $_POST['password']);
                                setcookie("hash", $hash, time()+3600);
                                $this->view->refreshPage();
                            }
                            else
                            {
                                $this->view->showNotCorrectPassword();
                            }
                        } 
                        
                        break;
                    case 'addTask':
                        $listTasks = $this->taskModel->addTask($_COOKIE['hash'], $_POST['textTask']);
                        $this->view->refreshPage();
                        break;
                    case 'deleteOneTask':
                        $listTasks = $this->taskModel->deleteOneTask($_COOKIE['hash'], $_GET['id']);
                        $this->view->refreshPage();
                        break;
                    case 'deleteAllTask':
                            $listTasks = $this->taskModel->deleteAllTask($_COOKIE['hash']);
                            $this->view->refreshPage();
                            break;
                    case 'editStatusOneTask':
                        $listTasks = $this->taskModel->editStatusOneTask($_COOKIE['hash'], $_GET['id']);
                        $this->view->refreshPage();
                        break;
                    case 'editStatusAllTask':
                        $listTasks = $this->taskModel->editStatusAllTask($_COOKIE['hash']);
                        $this->view->refreshPage();
                        break;
                    default:
                        # code...
                        break;
                }
            }
        }

        
    }
?>
