<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'config/configs.php';
require 'src/controllers/veiculos.php';
require 'src/controllers/locacao.php';

$app = new \Slim\App([['settings' => $config]]);

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});


$app->get('/veiculos', VeiculoController::class . ':listar');
$app->get('/veiculo/{id}', VeiculoController::class . ':listarPorId');
$app->get('/veiculosDisponiveis', VeiculoController::class . ':listarDisponiveis');
$app->post('/veiculo', VeiculoController::class . ':insert');
$app->get('/veiculosLocados', VeiculoController::class . ':listarLocados');
$app->put('/veiculo/{id}', VeiculoController::class . ':update');
$app->delete('/veiculo/{id}', VeiculoController::class . ':delete');


$app->get('/locacoes', LocacaoController::class . ':listar');
$app->get('/historicoLocacoes', LocacaoController::class . ':listarHistorico');
$app->post('/locarVeiculo', LocacaoController::class . ':locar');
$app->put('/devolverVeiculo/{id}', LocacaoController::class . ':devolver');

$app->run();
