<?php

namespace Core;

// use App\Controllers\HomeController;
use App\Controllers\ErroController;

class Application
{

	public function executar()
	{

		$url = isset($_GET['url']) ? explode('/',$_GET['url'])[0] : 'Home';
		$url = ucfirst($url);
		$url.="Controller";
		
		if (file_exists('app/Controllers/'.$url.'.php')) {
			$className = 'App\\Controllers\\'.$url;
			$controler = new $className;
			$controler->executar();
		}else{
			$controler = new ErroController;
			$controler->executar();
			// die('<div class="container"><h2>Extá página não existe!</h2></div>');
		}
	}
}

?>