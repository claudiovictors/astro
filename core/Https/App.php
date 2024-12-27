<?php

namespace Core\Https;

/**
 * Class App
 *
 * Classe base que estende a funcionalidade do roteador (`Router`) e oferece métodos utilitários
 * para renderizar templates e manipular respostas em JSON.
 */
class App extends Router {

    /**
     * Renderiza um template da aplicação.
     *
     * Este método localiza o arquivo de template especificado na pasta `app/Views` e
     * insere os dados passados como variáveis na view.
     * 
     * @param string $template O caminho relativo para o template dentro da pasta `Views` (sem extensão `.php`).
     * @param array $data [opcional] Dados a serem extraídos e disponibilizados como variáveis no template.
     * @return void
     */
    public function render(string $template, array $data = []) {
        // Converte os elementos do array $data em variáveis.
        extract($data);

        // Define o caminho completo para o arquivo de template.
        $directory_path = __DIR__ . "/../../app/Views{$template}.php";

        // Verifica se o arquivo existe. Caso contrário, dispara um erro 404.
        if (!file_exists($directory_path)):
            $this->handlError(404); // Método para lidar com erros (404 no caso).
        endif;

        // Inclui o arquivo de template.
        require_once $directory_path;
    }

    /**
     * Envia uma resposta em formato JSON.
     *
     * Este método define o cabeçalho apropriado e converte um array PHP para o formato JSON.
     *
     * @param array $data Dados a serem convertidos e enviados como resposta JSON.
     * @return void
     */
    public function json(array $data) {
        // Define o cabeçalho da resposta como JSON.
        header('Content-Type: application/json');

        // Converte os dados para JSON e os exibe.
        echo json_encode($data);
    }
}
