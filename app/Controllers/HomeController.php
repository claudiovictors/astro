<?php

namespace App\Controllers;

use Core\Https\App;

/**
 * Class HomeController
 *
 * Controlador responsável por gerenciar as ações relacionadas à página inicial.
 * Estende a classe base `App` para acessar os métodos principais do framework.
 */
class HomeController extends App {

    /**
     * Método responsável por renderizar a página inicial.
     *
     * Este método utiliza o sistema de templates para renderizar a view
     * localizada em `app/Views/pages/home.php`, enviando os dados necessários
     * para a renderização da página.
     *
     * @return void
     */
    public function index() {
        $this->render('/pages/home', [
            'message' => 'Hello World!' // Mensagem que será exibida na view.
        ]);
    }
}
