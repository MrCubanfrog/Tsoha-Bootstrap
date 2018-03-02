<?php

  class SessionController extends BaseController{

    public static function show($id) {
        $session = Session::find($id);
        $game_users = GameUser::findForGame($session->game_id);
        View::make('session/session.html', array('session'=>$session, 'game_users'=> $game_users));
    }

    public static function edit($id) {
        self::check_logged_in();
        $session = Session::find($id);
        $game_users = GameUser::findForGame($session->game_id);
        View::make('session/session_edit.html', array('session'=>$session, 'game_users'=> $game_users));
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
            'gm_note' => $gm_note
        );

        $session = new Session($attributes);
        $errors = $session->errors();

        if (count($errors) == 0) {
            $session->update();
            Redirect::to('/session/' . $id, array('message' => 'Sessiota on muokattu onnistuneesti!'));
        } else {
            View::make('session/session_edit.html', array('errors'=> $errors, 'attributes'=>$attributes)); 
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $session = Session::find($id);
        $game_id = $session->game_id;
        $session->destroy();

        Redirect::to('/game/' . $game_id, array('message' => 'Sessio on poistettu onnistuneesti!'));
    }

    public static function store($game_id) {
        self::check_logged_in();
        $params = $_POST;
        $gm_note = "";

        if (array_key_exists('gm_note', $params)) {
            $gm_note = $params['gm_note'];
        } 

        $attributes = array(
            'game_id' => $game_id,
            'name' => $params['name'],
            'description_short' => $params['description_short'],
            'description' => $params['description'],
            'gm_note' => $gm_note
        );

        $session = new Session($attributes);
        $errors = $session->errors();

        if (count($errors) == 0) {
            $session->save();
            Redirect::to('/session/' . $session->id, array('message' => 'Sessio on lisätty peliin!'));

        } else {
            View::make('session/session_new.html', array('errors'=> $errors, 'attributes'=>$attributes)); 
        }
    }
    
    public static function create($game_id) {
        self::check_logged_in();
        View::make('session/session_new.html', array('game_id'=>$game_id));
    }
  }
