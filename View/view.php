<?php
    class view
    {
        function showAuthorization()
        {
            echo '<html>
                    <head>
                        <meta charset="UTF-8" />
                        <title>Task List</title>
                    </head>
                    <body>
                    <p>Авторизация</p>
                    <div style="display: flex;">
                        <form action="../Controller/Controller.php?request=registerOrCheckUser" method="post">
                        <p>
                        <input name="login">
                        <input name="password"> 
                        <input type="submit" value="Войти"></p>
                        </form>
                        &emsp;
                    </div>
                    </body>
                </html>';
        }

        function showNotCorrectPassword()
        {
            echo "Пароль неверный";
        }

        function showListTasks($AllTask){
            
            echo '<html>
                    <head>
                        <meta charset="UTF-8" />
                        <title>Task List</title>
                    </head>
                    <body>
                    <div style="display: flex;">
                        <form action="../Controller/Controller.php?request=addTask" method="post">
                        <p><input name="textTask"> <input type="submit" value="Добавить"></p>
                        </form>
                        &emsp;
                        <form action="../Controller/Controller.php?request=deleteAllTask" method="post">
                        <p><input type="submit" value="Удалить все задачи"></p>
                        </form>
                        &emsp;
                        <form action="../Controller/Controller.php?request=editStatusAllTask" method="post">
                        <p><input type="submit" value="Все задачи выполнены"></p>
                        </form>
                    </div>
                    </body>
                    </html>';

            for($i=0;$i<count($AllTask);$i++)
            {
                echo '<div style="display: flex;">';
                $form = '<form action="../Controller/Controller.php?request=editStatusOneTask&id='.$AllTask[$i]->getID().'" method="post">
                        <input type="submit" value="Выполнено">
                        </form>
                        &emsp;
                        <form action="../Controller/Controller.php?request=deleteOneTask&id='.$AllTask[$i]->getID().'" method="post">
                        <input type="submit" value="Удалить">
                        </form>';
                echo "&emsp;".$AllTask[$i]->getTask(); 
                echo $form;
                echo '</div>';
            }
            
        }

        function refreshPage()
        {
            echo '<meta http-equiv="refresh" content="0;URL=../Controller/Controller.php">';
        }
    }
?>