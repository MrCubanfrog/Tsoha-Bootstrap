<?php

  require 'app/models/game.php';
  class HelloWorldController extends BaseController{

    public static function index(){
   	  View::make('home.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
        $games = Game::all();
        $game = Game::find(1);
        Kint::dump($games);
        Kint::dump($game);
    }
    
    public static function games_list() {
        View::make('suunnitelmat/game_list_show.html');
    }

    public static function game() {
        View::make('suunnitelmat/game_show.html');
    }

    public static function games_mod() {
        View::make('suunnitelmat/game_mod_show.html');
    }

    public static function article() {
        View::make('suunnitelmat/article_show.html');
    }

    public static function article_mod() {
        View::make('suunnitelmat/article_mod_show.html');
    }

    public static function player() {
        View::make('suunnitelmat/player_show.html');
    }

    public static function player_mod() {
        View::make('suunnitelmat/player_mod_show.html');
    }

    public static function session() {
        View::make('suunnitelmat/session_show.html');
    }

    public static function session_mod() {
        View::make('suunnitelmat/session_mod_show.html');
    }

    public static function login() {
        View::make('suunnitelmat/login.html');
    }


  }
