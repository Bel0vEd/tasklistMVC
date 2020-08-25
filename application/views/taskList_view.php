<html>
                    <head>
                        <meta charset="UTF-8" />
                        <title>Task List</title>
                    </head>
                    <body>
                    <div style="display: flex;">
                        <form action="/task/addTask" method="post">
                        <p><input name="textTask"> <input type="submit" value="Добавить"></p>
                        </form>
                        &emsp;
                        <form action="/task/deleteAllTask" method="post">
                        <p><input type="submit" value="Удалить все задачи"></p>
                        </form>
                        &emsp;
                        <form action="/task/editStatusAllTask" method="post">
                        <p><input type="submit" value="Все задачи выполнены"></p>
                        </form>
                    </div>
                    </body>
</html>

<?php

            for($i=0;$i<count($data);$i++)
            {
                echo '<div style="display: flex;">';
                $form = '<form action="/task/editStatusOneTask/'.$data[$i]->getID().'" method="post">
                        <input type="submit" value="Выполнено">
                        </form>
                        &emsp;
                        <form action="/task/deleteOneTask/'.$data[$i]->getID().'" method="post">
                        <input type="submit" value="Удалить">
                        </form>';
                echo "&emsp;".$data[$i]->getTask(); 
                echo $form;
                echo '</div>';
            }
?>
        