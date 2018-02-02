<?php

    $routes->get('/', function() {
        GamesController::index();
    });

    $routes->get('/game', function(){
        GameController::index();
    });

    $routes->get('/game/:id', function($id){
        GamesController::show($id);
    });

    $routes->get('/game_mod/1', function(){
        HelloWorldController::game_mod();
    });

    $routes->get('/article/1', function(){
        HelloWorldController::article();
    });

    $routes->get('/article_mod/1', function(){
        HelloWorldController::article_mod();
    });

    $routes->get('/player/1', function(){
        HelloWorldController::player();
    });

    $routes->get('/player_mod/1', function(){
        HelloWorldController::player_mod();
    });

    $routes->get('/session/1', function(){
        HelloWorldController::session();
    });

    $routes->get('/session_mod/1', function(){
        HelloWorldController::session_mod();
    });

    $routes->get('/login', function(){
        HelloWorldController::login();
    });
   
