<?php

namespace App\Controllers;

use App\Views\MainView;

/**
 * 
 */
class ErroController
{
	public function __construct()
	{
		$this->view = new MainView('erro');
	}

	public function executar()
	{
		$this->view->render(array('titulo'=>'Form | Erro404'));
	}
}

?>