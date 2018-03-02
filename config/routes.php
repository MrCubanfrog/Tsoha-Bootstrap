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

    $routes->post('/character/new/:id', function($id){
        CharacterController::store($id);
    });

    $routes->get('/character/new/:id', function($id){
        CharacterController::create($id);
    });

    $routes->get('/character/:id/edit', function($id){
        CharacterController::edit($id);
    });

    $routes->post('/character/:id/edit', function($id){
        CharacterController::update($id);
    });

    $routes->post('/character/:id/destroy', function($id){
        CharacterController::destroy($id);
    });

    $routes->get('/character/:id', function($id){
        CharacterController::show($id);
    });

    $routes->post('/session/new/:id', function($id){
        SessionController::store($id);
    });

    $routes->get('/session/new/:id', function($id){
        SessionController::create($id);
    });

    $routes->get('/session/:id/edit', function($id){
        SessionController::edit($id);
    });

    $routes->post('/session/:id/edit', function($id){
        SessionController::update($id);
    });

    $routes->post('/session/:id/destroy', function($id){
        SessionController::destroy($id);
    });

    $routes->get('/session/:id', function($id){
        SessionController::show($id);
    });

    $routes->post('/article/new/:id', function($id){
        ArticleController::store($id);
    });

    $routes->get('/article/new/:id', function($id){
        ArticleController::create($id);
    });

    $routes->get('/article/:id/edit', function($id){
        ArticleController::edit($id);
    });

    $routes->post('/article/:id/edit', function($id){
        ArticleController::update($id);
    });

    $routes->post('/article/:id/destroy', function($id){
        ArticleController::destroy($id);
    });

    $routes->get('/article/:id', function($id){
        ArticleController::show($id);
    });

    $routes->get('/login', function(){
        UserController::login();
    });
   
    $routes->post('/login', function(){
        UserController::handle_login();
    });

    $routes->post('/logout', function(){
        UserController::logout();
    });

    $routes->get('/game/:id/users', function($id){
        UserController::handle_user_screen($id);
    });

    $routes->post('/game/:id/add_user/:user_id', function($id, $user_id){
        UserController::add_user_to_game($id, $user_id);
    });

    $routes->post('/game/:id/remove_user/:user_id', function($id, $user_id){
        UserController::remove_user_from_game($id, $user_id);
    });

