<?php

namespace Core\Https;

/**
 * Class Router
 *
 * Classe responsável por gerenciar rotas de uma aplicação web.
 * Suporta métodos HTTP como GET e POST, parâmetros dinâmicos e tratamento de erros.
 */
class Router {

    /**
     * @var array $routes Armazena todas as rotas definidas.
     */
    private array $routes = [];

    /**
     * Adiciona uma nova rota.
     *
     * @param string $method Método HTTP da rota (e.g., GET, POST).
     * @param string $path Caminho da rota.
     * @param array $handle Manipulador da rota (classe e método ou função anônima).
     * @return void
     */
    public function add(string $method, string $path, array $handle): void {
        $this->routes[] = [
            'method' => mb_strtoupper($method), // Transforma o método em maiúsculas.
            'path'   => $path,
            'handle' => $handle
        ];
    }

    /**
     * Define uma rota com o método GET.
     *
     * @param string $path Caminho da rota.
     * @param array $handle Manipulador da rota.
     * @return void
     */
    public function get(string $path, array $handle): void {
        $this->add('GET', $path, $handle);
    }

    /**
     * Define uma rota com o método POST.
     *
     * @param string $path Caminho da rota.
     * @param array $handle Manipulador da rota.
     * @return void
     */
    public function post(string $path, array $handle): void {
        $this->add('POST', $path, $handle);
    }

    /**
     * Processa a rota correspondente à requisição atual.
     *
     * Faz a correspondência entre a URL requisitada e as rotas definidas.
     * Suporta parâmetros dinâmicos e executa o manipulador correspondente.
     *
     * @return void
     */
    public function dispatch() {
        $method_type = $_SERVER['REQUEST_METHOD']; // Obtém o método HTTP da requisição.
        $path_uri = htmlspecialchars(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), ENT_QUOTES, 'UTF-8'); // Sanitiza o URI.

        // Itera pelas rotas registradas.
        foreach ($this->routes as $route):
            // Substitui parâmetros dinâmicos {param} por regex.
            $pattern = preg_replace('/{([^}]+)}/', '(?P<$1>[^/]+)', $route['path']);

            // Verifica se o método e o caminho correspondem.
            if ($route['method'] === $method_type && preg_match('#^' . $pattern . '$#', $path_uri, $matches)):
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY); // Filtra apenas os parâmetros nomeados.

                // Verifica se o manipulador é uma classe e método.
                if (is_array($route['handle'])):
                    [$classCurent, $methodAction] = $route['handle'];
                    call_user_func_array([new $classCurent, $methodAction], $params); // Chama o método da classe.
                    return;

                // Verifica se o manipulador é uma função anônima.
                elseif (is_callable($route['handle'])):
                    call_user_func($route['handle'], $params); // Executa a função.
                    return;

                // Caso o manipulador seja inválido.
                else:
                    $this->handlError(500);
                endif;
            endif;
        endforeach;

        // Retorna erro 404 caso nenhuma rota corresponda.
        $this->handlError(404);
    }

    /**
     * Trata erros HTTP.
     *
     * @param int $code Código de status HTTP (e.g., 404, 500).
     * @return void
     */
    protected function handlError(int $code) {
        http_response_code($code); // Define o código de status HTTP.

        switch ($code):
            case 404:
                die("Error 404 - Page not found!"); // Erro de rota não encontrada.
                break;

            case 500:
                die("Error 500 - Internal Server!"); // Erro interno do servidor.
                break;

            default:
                die("Error Processing Request"); // Erro genérico.
                break;
        endswitch;
    }

}
