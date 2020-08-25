<?php

class Controller_task extends Controller
{

    function __construct()
	{
		//$this->model = new Model_Portfolio();
        //
        $this->model = new Model_task();
        $this->view = new View();
	}

	function action_index()
	{	
		
        $hash = $_COOKIE['hash'];
        $data = $this->model->get_data($hash);
        
		$this->view->generate('taskList_view.php', $data);
	}

	function action_addTask()
	{
		
		$this->model->addTask($_COOKIE['hash'], $_POST['textTask']);
		$this->refrashPage();
	}

	function action_editStatusOneTask($id){
		$hash = $_COOKIE['hash'];
		$this->model->editStatusOneTask($hash, $id);
		$this->refrashPage();
	}
	
	function action_deleteOneTask($id)
	{
		$hash = $_COOKIE['hash'];
		$this->model->deleteOneTask($hash, $id);
		$this->refrashPage();
		
	}

	function action_deleteAllTask()
	{
		$hash = $_COOKIE['hash'];
		$this->model->deleteAllTask($hash);
		$this->refrashPage();
	}

	function action_editStatusAllTask(){
		$hash = $_COOKIE['hash'];
		$this->model->editStatusAllTask($hash);
		$this->refrashPage();
	}

	function refrashPage()
	{
		$host = 'http://'.$_SERVER['HTTP_HOST'];
		header('Location:'.$host);
	}
	 
}