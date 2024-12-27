<?php

namespace Core\Https;

use PDO;
use Exception;

/**
 * Class Model
 *
 * Classe abstrata que fornece a base para interação com o banco de dados.
 * Inclui a configuração de conexão usando PDO.
 */
abstract class Model {

    /**
     * @var string $table_name Nome da tabela associada ao modelo.
     */
    protected string $table_name;

    /**
     * @var array|object|string $instance Instância da conexão PDO.
     */
    protected array|object|string $instance;

    /**
     * Estabelece a conexão com o banco de dados.
     *
     * Este método utiliza as configurações armazenadas em `config.php` para criar
     * uma conexão PDO segura. Ele também define atributos adicionais para o PDO.
     *
     * @return array|object|string Retorna a instância de conexão PDO.
     * @throws Exception Se ocorrer um erro ao conectar ao banco de dados.
     */
    public function getConnect(): array|object|string {
        // Carrega as configurações do banco de dados.
        $config = require_once __DIR__ . '/../Configs/config.php';

        try {
            // Cria uma nova instância de conexão PDO usando os detalhes da configuração.
            $this->instance = new PDO(
                $config['DB-PDO']['dsn'], 
                $config['DB-PDO']['username'], 
                $config['DB-PDO']['password']
            );

            // Define atributos para o objeto PDO, incluindo o modo de erro.
            $this->instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (Exception $e) {
            // Finaliza a execução se houver erro ao conectar e exibe a mensagem.
            die('Error to connect to database: ' . $e->getMessage());
        }

        return $this->instance;
    }
}
