<?php

/**
 * Configurações de conexão com o banco de dados e parâmetros gerais.
 */

/**
 * Host do banco de dados.
 */
const HOSTNAME = 'localhost';

/**
 * Porta utilizada para conexão com o banco de dados.
 */
const PORT = 3306;

/**
 * Nome do banco de dados.
 */
const DBNAME = 'mvc';

/**
 * Nome de usuário para autenticação no banco de dados.
 */
const USERNAME = 'root';

/**
 * Senha para autenticação no banco de dados.
 * Definida como `null` por padrão (sem senha).
 */
const PASSWORD = null;

/**
 * Conjunto de caracteres utilizado no banco de dados.
 */
const METACHARSET = 'utf8mb4';

/**
 * Retorna um array com as configurações gerais da aplicação.
 *
 * - `BASE_URL`: Define a URL base da aplicação.
 * - `DB-PDO`: Configurações específicas para conexão com o banco de dados usando PDO.
 *
 * @return array Configurações da aplicação.
 */
return [
    'BASE_URL' => 'localhost:3000', // URL base da aplicação.
    'DB-PDO'   => [
        'dsn' => 'mysql:host=' . HOSTNAME . ';port=' . PORT . ';dbname=' . DBNAME . ';charset=' . METACHARSET, // DSN do PDO.
        'username' => USERNAME, // Nome de usuário para o banco de dados.
        'password' => PASSWORD  // Senha do banco de dados.
    ]
];
