<?php

    $routes->get('/', function() {
        GamesController::index();
    });

    $routes->get('/game', function(){
        GamesController::index();
    });

    $routes->post('/game', function(){
        GamesController::store();
    });
    $routes->get('/game/new', function(){
        GamesController::create();
    });

    $routes->get('/game/:id/edit', function($id){
        GamesController::edit($id);
    });

    $routes->post('/game/:id/edit', function($id){
        GamesController::update($id);
    });

    $routes->post('/game/:id/destroy', function($id){
        GamesController::destroy($id);
    });

    $routes->get('/game/:id', function($id){
        GamesController::show($id);
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
    
   
