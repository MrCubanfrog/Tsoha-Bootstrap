<?php

  class CharacterController extends BaseController{

    public static function show($id) {
        $character = Character::find($id);
        $game_users = GameUser::findForGame($character->game_id);
        View::make('character/character.html', array('character'=>$character, 'game_users'=> $game_users));
    }

    public static function edit($id) {
        self::check_logged_in();
        $character = Character::find($id);
        $game_users = GameUser::findForGame($character->game_id);
        View::make('character/character_edit.html', array('character'=>$character, 'game_users'=> $game_users));
    }

    public static function update($id){
        self::check_logged_in();
        $params = $_POST;
        $gm_note = "";
        

        if (array_key_exists('gm_note', $params)) {
            $gm_note = $params['gm_note'];
        } 

        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'description_short' => $params['description_short'],
            'description' => $params['description'],
            'history' => $params['history'],
            'gm_note' => $gm_note
        );

        $character = new Character($attributes);
        $errors = $character->errors();

        if (count($errors) == 0) {
            $character->update();
            Redirect::to('/character/' . $id, array('message' => 'Peliä on muokattu onnistuneesti!'));
        } else {
            View::make('character/character_edit.html', array('errors'=> $errors, 'attributes'=>$attributes)); 
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $character = Character::find($id);
        $game_id = $character->game_id;
        $character->destroy();

        Redirect::to('/game/' . $game_id, array('message' => 'Hahmo on poistettu onnistuneesti!'));
    }

    public static function store($game_id) {
        self::check_logged_in();
        $params = $_POST;
        $user = self::get_user_logged_in();
        $gm_note = "";

        if (array_key_exists('gm_note', $params)) {
            $gm_note = $params['gm_note'];
        } 

        $attributes = array(
            'user_id' => $user->id,
            'game_id' => $game_id,
            'name' => $params['name'],
            'description_short' => $params['description_short'],
            'description' => $params['description'],
            'history' => $params['history'],
            'gm_note' => $gm_note
        );

        $character = new Character($attributes);
        $errors = $character->errors();

        if (count($errors) == 0) {
            $character->save();
            Redirect::to('/character/' . $character->id, array('message' => 'Hahm on lisätty peliin!'));

        } else {
            View::make('character/character_new.html', array('errors'=> $errors, 'attributes'=>$attributes)); 
        }
    }
    
    public static function create($game_id) {
        self::check_logged_in();
        View::make('character/character_new.html', array('game_id'=>$game_id));
    }
  }
