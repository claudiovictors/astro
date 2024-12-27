<?php

/**
 * Arquivo principal de inicialização do sistema.
 * 
 * Este arquivo é responsável por carregar as dependências do Composer,
 * configurar as rotas e iniciar o despachamento das mesmas.
 */

// Carrega o autoloader gerado pelo Composer para gerenciar namespaces e classes automaticamente.
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\HomeController; // Importa o controlador HomeController.
use Core\Https\Router;            // Importa a classe Router para manipular as rotas.

/**
 * Cria uma nova instância da classe Router para gerenciar as rotas da aplicação.
 */
$routes = new Router();

/**
 * Define uma rota HTTP GET para o caminho '/' (raiz).
 * 
 * - O controlador associado é `HomeController`.
 * - A ação executada será o método `index()` dentro do controlador.
 */
$routes->get('/', [HomeController::class, 'index']);

/**
 * Despacha as rotas para verificar se alguma corresponde à requisição atual.
 * Caso encontre, executa o controlador e o método associado.
 */
$routes->dispatch();
