<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {
		// rotas
		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		); 

		$routes['login'] = array(
			'route' => '/login',
			'controller' => 'indexController',
			'action' => 'login'
		); 

		$routes['cadastro'] = array(
			'route' => '/cadastro',
			'controller' => 'indexController',
			'action' => 'cadastro'
		); 

		$routes['registrar'] = array(
			'route' => '/registrar',
			'controller' => 'indexController',
			'action' => 'registrar'
		);

		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);
		
		$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AuthController',
			'action' => 'sair'
		);

		$routes['main'] = array(
			'route' => '/main',
			'controller' => 'AppController',
			'action' => 'main'
		);

		$routes['salvarContato'] = array(
			'route' => '/salvarContato',
			'controller' => 'AppController',
			'action' => 'salvarContato'
		);

		$routes['pesquisar'] = array(
			'route' => '/pesquisar',
			'controller' => 'AppController',
			'action' => 'pesquisar'
		);

		$routes['listarModal'] = array(
			'route' => '/listarModal',
			'controller' => 'AppController',
			'action' => 'listarModal'
		);

		$routes['apagarContato'] = array(
			'route' => '/apagarContato',
			'controller' => 'AppController',
			'action' => 'apagarContato'
		);

		$this->setRoutes($routes);
	}

}

?>