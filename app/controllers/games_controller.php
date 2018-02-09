<?php

  require 'app/models/game.php';
  class GamesController extends BaseController{

    public static function index() {
        $games = Game::all();
        View::make('game/index.html', array('games' => $games));
    }

    public static function show($id) {
        $game = Game::find($id);
        $characters = Character::findAllInGame($id);
        View::make('game/game.html', array('game' => $game, 'characters' => $characters));
    }

    public static function edit($id) {
        $game = Game::find($id);
        View::make('game/game_edit.html', array('game' => $game));
    }

    public static function update($id){
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'system' => $params['system'],
            'description_short' => $params['description_short'],
            'description' => $params['description'],
            'gm_note' => $params['gm_note']
        );

        $game = new Game($attributes);
        $errors = $game->errors();

        if (count($errors) == 0) {
            $game->update();
            Redirect::to('/game/' . $id, array('message' => 'Peliä on muokattu onnistuneesti!'));
        } else {
            View::make('game/game_edit.html', array('errors'=> $errors, 'attributes'=>$attributes)); 
        }
    }

    public static function destroy($id) {
        $game = new Game(array('id' => $id));
        $game->destroy();

        Redirect::to('/game', array('message' => 'Peliä on poistettu onnistuneesti!'));

    }

    public static function store() {
        $params = $_POST;
        $attributes = array(
            'name' => $params['name'],
            'system' => $params['system'],
            'description_short' => $params['description_short'],
            'description' => $params['description'],
            'gm_note' => $params['gm_note']
        );

        $game = new Game($attributes);
        $errors = $game->errors();

        if (count($errors) == 0) {
            $game->save();
            Redirect::to('/game/' . $game->id, array('message' => 'Peli on lisätty sivulle!'));

        } else {
            View::make('game/game_new.html', array('errors'=> $errors, 'attributes'=>$attributes)); 
        }
    }
    
    public static function create() {
        View::make('game/game_new.html');
    }
  }
