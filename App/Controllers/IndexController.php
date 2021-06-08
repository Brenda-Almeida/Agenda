<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {
		$this->render('index');
	}

	public function login() {
		$this->view->sucessoCadastro = false;
		$this->view->login = isset($_GET['login']) ? $_GET['login'] : "";

		$this->render('login');
	}

	public function cadastro() {
		$this->view->usuario = array(
			'nome' => '',
			'email' => '',
		);

		$this->view->erroCadastro = false;
		$this->view->erroCadastroEmail = false;
		$this->render('cadastro');
	}

	public function registrar() {
		$usuario = Container::getModel('usuario');

		$usuario->__set('nome', $_POST['nome']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', md5($_POST['senha']));
		
		if($usuario->validarCadastro()) {
			if(count($usuario->getUsuarioPoremail()) == 0) {
				
				$usuario->salvar();

				$this->view->sucessoCadastro = true;
				$this->view->login = isset($_GET['login']) ? $_GET['login'] : "";
				$this->render('login');
			}	
			else {
				$this->view->usuario = array(
					'nome' => $_POST['nome'],
					'email' => $_POST['email']
				);
				$this->view->erroCadastro = false;
				$this->view->erroCadastroEmail = true;
				$this->render('cadastro');
			}	
		}else {
			$this->view->usuario = array(
				'nome' => $_POST['nome'],
				'email' => $_POST['email']
			);

			$this->view->erroCadastroEmail = false;
			$this->view->erroCadastro = true;
			$this->render('cadastro');
		}
	}

}
?>