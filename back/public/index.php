<?php
require __DIR__ . '/../vendor/autoload.php';

//todo: vérification authentification BEARER ?

use App\Database;
use App\Request;

//Chargement du .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

//Gestion des routes de l'API
$router = new AltoRouter();
$router->map('GET', '/', 'PeakController#listAction');
$router->map('POST', '/create', 'PeakController#createAction');
$router->map('GET', '/read/[i:id]', 'PeakController#readAction');
$router->map('POST', '/update/[i:id]', 'PeakController#updateAction');
$router->map('DELETE', '/delete/[i:id]', 'PeakController#deleteAction');

$match = $router->match();

// On match sur une route
if ( true === is_array($match) ) {
    // Récupération du controller et de la méthode à appeler
    list($controller, $action) = explode('#', $match['target']);
    $database = new Database();
    $request = new Request();
    $controller = new ('App\Controller\\' . $controller)($database, $request);

    header("Access-Control-Allow-Origin: *");
    if (is_callable([$controller, $action])) {
        try {
            header('Content-Type: application/json; charset=utf-8');
            echo call_user_func_array([$controller, $action], $match['params'] );
        } catch (Exception $e) {
            header('Content-Type: text/html; charset=utf-8');
            throw new Exception($e->getMessage());
        }
    }
} else {
    //Pas de match sur la route = 404
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found', true, 404);
    include('404.html');
}
