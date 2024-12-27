# Astro Framework MVC

O Astro Framework é um projeto baseado no padrão MVC (Model-View-Controller), desenvolvido com PHP, que oferece uma estrutura simples e eficiente para criar aplicações web dinâmicas.

## Funcionalidades

1. **Rotas**

    Gerenciamento de rotas `GET` e `POST`.
    Suporte a parâmetros dinâmicos, como IDs nas URLs.
    Fácil integração com controladores e ações.

2. #### ORM (Object-Relational Mapping)

    ### Métodos disponíveis:
    - `create()`: Inserir dados no banco de dados.

    - `getAll()`: Recuperar todos os registros.
    - `findById()`: Recuperar registros por ID.
    - `update()`: Atualizar registros existentes.
    - `delete()`: Deletar registros por ID.

3. #### Templates Views

    - Renderização de páginas HTML organizadas na pasta `app/Views`.
    - Suporte a reutilização de layouts e componentes.

**Exemplo de Configuração de Rotas:**

Na pasta public/, contém o arquivo de inicialização do sistema public/index.php, onde as rotas são definidas.

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Core\Https\Route;
use App\Controllers\HomeController;

$routes = new Route(); // Instanciando a classe Route

$routes->get('/', [HomeController::class, 'index']); // Definindo uma rota GET

$routes->dispatch(); // Despachando as rotas que correspondem ao método e path sugerido
```

No exemplo acima, definimos uma rota para a página principal `/`.

## Uso de Funções Anônimas

O Astro Framework permite o uso de funções anônimas para manipular rotas:

```php
<?php

$route->get('/', function(){
    echo 'Olá, Mundo!';
});

$route->dispatch(); 
```

## Parâmetros Dinâmicos

O Astro Framework suporta parâmetros dinâmicos para rotas:
```php
<?php

use Core\Https\App;

$route->get('/api/users/{id}', function($id) use ($app) {
    $id = [
        'nome' => 'Astro',
        'linguagem' => 'PHP'
    ];

    $app->json($id); # Mostra os dados em formato json
});

$route->dispatch(); 
```

## Templates Views

O Astro Framework oferece suporte a templates organizados na pasta `views`.

Exemplo de uso no `HomeController.php`

```php

<?php

class HomeController extends App {

    public function index(){
        $this->render('/pages/home', ['title' => 'Astro', 'description' => 'Mini-framework mvc em PHP.'])
    }
}

```
Arquivo `/pages/home.php` que exibirá os dados enviados:

```html
<!DOCTYPE html>
<html lang="pt-AO" dir="ltr">
<head>
    <meta charset="utf-8">
    <title><?= $title; ?></title>
</head>
<body>
    <?= "<h1>$title</h1>"; ?>
    <?= '<p>'. $description .'</p>'; ?>
</body>
</html>
```

No navegador, ao acessar `http://localhost:3000/`, ele irá para a view home.php e exibirá os dados fornecidos.