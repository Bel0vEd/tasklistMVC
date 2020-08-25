<?php

/*
Класс-маршрутизатор для определения запрашиваемой страницы.
> цепляет классы контроллеров и моделей;
> создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
*/
class route
{

	static function start()
	{
		// контроллер и действие по умолчанию
		if(!isset($_COOKIE['hash']))
		{
			$controller_name = 'authentification';
		}
		else
		{
			$controller_name = 'task';
		}
		$action_name = 'index';
		
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		//print_r($routes) ;
		// получаем имя контроллера
		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
			if(!isset($_COOKIE['hash']))
			{
				$host = 'http://'.$_SERVER['HTTP_HOST'];
            	header('Location:'.$host);
			}
		}
		
		

		// получаем имя экшена
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}

		if ( !empty($routes[3]) )
		{
			$action_idTask = $routes[3];
		}

		

		// добавляем префиксы
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		/*
		echo "Model: $model_name <br>";
		echo "Controller: $controller_name <br>";
		echo "Action: $action_name <br>";
		*/

		// подцепляем файл с классом модели (файла модели может и не быть)

		$model_file = strtolower($model_name).'.php';
		//echo $model_file;
		$model_path = "application/models/".$model_file;
		//echo $model_path;
		if(file_exists($model_path))
		{
			
			include "application/models/".$model_file;
		}

		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "application/controllers/".$controller_file;
		//echo $controller_path;
		if(file_exists($controller_path))
		{
			//echo "application/controllers/".$controller_file;
			include "application/controllers/".$controller_file;
		}
		else
		{
			/*
			правильно было бы кинуть здесь исключение,
			но для упрощения сразу сделаем редирект на страницу 404
			*/
			Route::ErrorPage404();
		}
		
		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;
		// echo $controller_name." ";
		// echo $action;

		//echo method_exists($controller, $action);
		if(method_exists($controller, $action))
		{
			if(!empty($action_idTask))
			{
				$controller->$action($action_idTask);
			}
			else
			{
				$controller->$action();
			}
		}
		else
		{
			// здесь также разумнее было бы кинуть исключение
			Route::ErrorPage404();
		}
	
	}

	function ErrorPage404()
	{

		$host = 'http://'.$_SERVER['HTTP_HOST'].'/'.$_SERVER['REQUEST_URI'].'/';
		//echo $host;
		
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
    
}