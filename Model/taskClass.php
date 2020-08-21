<?php
class Task {
    public $Name;
    public $Status;
    public $ID;

    function __construct($task,$ID)
    {
        $this -> Name = $task;
        $this -> Status = "В работе";
        $this -> ID = $ID;
    }
    
    public function getTask()
    {
        
        echo "Задача: ".$this ->Name.", Статус: ".$this ->Status;
    }

    public function getID()
    {
        return $this ->ID;
    }
    
    public function setStatusSuccess()
    {
        $this -> Status = "Выполнено";
    }
    
    
}
?>