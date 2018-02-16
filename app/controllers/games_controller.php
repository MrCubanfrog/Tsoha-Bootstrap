<?php

  require 'app/models/game.php';
  class GamesController extends BaseController{

    public static function index() {
        $games = Game::all();
        View::make('game/index.html', array('games' => $games));
    }

    public static function show($id) {
        $game = Game::find($id);
        $game_users = GameUser::findForGame($id);
        $characters = Character::findAllInGame($id);
        View::make('game/game.html', array('game' => $game, 'characters' => $characters, 'game_users' => $game_users));
    }

    public static function edit($id) {
        self::check_logged_in();
        $game = Game::find($id);
        View::make('game/game_edit.html', array('game' => $game));
    }

    public static function update($id){
        self::check_logged_in();
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
        self::check_logged_in();
        $game = new Game(array('id' => $id));
        $game->destroy();

        Redirect::to('/game', array('message' => 'Peli on poistettu onnistuneesti!'));

    }

    public static function store() {
        self::check_logged_in();
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
            $logged_user = self::get_user_logged_in();
            $game_user = new GameUser(array('game_id' => $game->id, 'user_id'=> $logged_user->id, 'gamemaster'=>true));
            $game_user->save();
            Redirect::to('/game/' . $game->id, array('message' => 'Peli on lisätty sivulle!'));

        } else {
            View::make('game/game_new.html', array('errors'=> $errors, 'attributes'=>$attributes)); 
        }
    }
    
    public static function create() {
        self::check_logged_in();
        View::make('game/game_new.html');
    }
  }
