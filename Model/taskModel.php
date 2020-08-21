<?php
    class taskModel
    {
        function getListTasks($userHash)
        {
            include 'connectDB.php';
            include 'taskClass.php';
            $userHash = $mysqli->real_escape_string($userHash);
            $query = "SELECT * FROM tasks WHERE user_id = (SELECT id FROM users WHERE user_hash = '$userHash')";
            $request = mysqli_query($link, $query) or die("Ошибка получения задач" . mysqli_error($link));
            
            $AllTask = array();
            while ($row = $request->fetch_assoc()) 
            {
                $newTask = new taskClass($row["description"], $row['id']);
                if ($row["status"]==1)
                {
                    $newTask->setStatusSuccess();
                }
                array_push($AllTask, $newTask);
            }   
            return $AllTask;
        }

        function addTask($hash, $textTask){
            include 'connectDB.php';
            $hash = $mysqli->real_escape_string($hash);
            $textTask = $mysqli->real_escape_string($textTask);
            $query = "INSERT INTO tasks (user_id, description) VALUES ( (SELECT id FROM users WHERE user_hash = '$hash') , '$textTask')";
            $request = mysqli_query($link, $query) or die("Ошибка добавления задачи" . mysqli_error($link));
            
        }

        function deleteOneTask($userHash, $idTask)
        {
            include 'connectDB.php';
            $userHash = $mysqli->real_escape_string($userHash);
            $idTask = $mysqli->real_escape_string($idTask);
            $query = "DELETE FROM tasks WHERE user_id = (SELECT id FROM users WHERE user_hash = '$userHash') AND id =".$idTask;
            $request = mysqli_query($link, $query) or die("Ошибка удаления задачи" . mysqli_error($link));   
        }

        function editStatusOneTask($userHash, $idTask)
        {
            include 'connectDB.php';
            $userHash = $mysqli->real_escape_string($userHash);
            $idTask = $mysqli->real_escape_string($idTask);
            $query = "UPDATE tasks SET status = 1 WHERE user_id = (SELECT id FROM users WHERE user_hash = '$userHash') AND id = ".$idTask;
            $request = mysqli_query($link, $query) or die("Ошибка изменения статуса задачи" . mysqli_error($link)); 
        }

        function deleteAllTask($userHash)
        {
            include 'connectDB.php';
            $userHash = $mysqli->real_escape_string($userHash);
            $query = "DELETE FROM tasks WHERE user_id = (SELECT id FROM users WHERE user_hash = '$userHash')";
            $request = mysqli_query($link, $query) or die("Ошибка удаления задач" . mysqli_error($link));
        }

        function editStatusAllTask($userHash)
        {
            include 'connectDB.php';
            $userHash = $mysqli->real_escape_string($userHash);
            $query = "UPDATE tasks SET status = 1 WHERE user_id = (SELECT id FROM users WHERE user_hash = '$userHash')";
            $request = mysqli_query($link, $query) or die("Ошибка удаления задач" . mysqli_error($link));
        }
        

        

    }
?>