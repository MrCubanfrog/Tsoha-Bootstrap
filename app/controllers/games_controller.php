<?php

  require 'app/models/game.php';
  class GamesController extends BaseController{

    public static function index() {
        $games = Game::all();
        View::make('game/index.html', array('games' => $games));
    }

    public static function show($id) {
        $game = Game::find($id);
        View::make('game/game.html', array('game' => $game));
    }

    public static function store() {
        $params = $_POST;
        $game = new Game(array(
            'name' => $params['name'],
            'system' => $params['system'],
            'description_short' => $params['description_short'],
            'description' => $params['description'],
            'gm_note' => $params['gm_note'],
            'creation_id' => null
        ));

        Kint::dump($params);

        $game->save();
    }
  }
