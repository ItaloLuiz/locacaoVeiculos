<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

require 'config/configs.php';
//require 'src/funcoes.php';
require 'src/controllers/veiculos.php';
require 'src/controllers/locacao.php';



$app = new \Slim\App([['settings' => $config]]);


$app->get('/veiculos', VeiculoController::class . ':listar');
$app->get('/veiculosDisponiveis', VeiculoController::class . ':listarDisponiveis');
$app->post('/veiculo', VeiculoController::class . ':insert');
$app->put('/veiculo/{id}', VeiculoController::class . ':update');
$app->delete('/veiculo/{id}', VeiculoController::class . ':delete');


$app->get('/veiculosLocados', LocacaoController::class . ':listar');
$app->post('/locarVeiculo', LocacaoController::class . ':locar');
$app->put('/devolverVeiculo/{id}', LocacaoController::class . ':devolver');





$app->run();
