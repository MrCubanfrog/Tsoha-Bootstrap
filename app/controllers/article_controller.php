<?php

  class ArticleController extends BaseController{

    public static function show($id) {
        $article = Article::find($id);
        $game_users = GameUser::findForGame($article->game_id);
        View::make('article/article.html', array('article'=>$article, 'game_users'=> $game_users));
    }

    public static function edit($id) {
        self::check_logged_in();
        $article = Article::find($id);
        $game_users = GameUser::findForGame($article->game_id);
        View::make('article/article_edit.html', array('article'=>$article, 'game_users'=> $game_users));
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

        $article = new Article($attributes);
        $errors = $article->errors();

        if (count($errors) == 0) {
            $article->update();
            Redirect::to('/article/' . $id, array('message' => 'Artikkeli on muokattu onnistuneesti!'));
        } else {
            View::make('article/article_edit.html', array('errors'=> $errors, 'attributes'=>$attributes)); 
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $article = Article::find($id);
        $game_id = $article->game_id;
        $article->destroy();

        Redirect::to('/game/' . $game_id, array('message' => 'Artikkeli on poistettu onnistuneesti!'));
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

        $article = new Article($attributes);
        $errors = $article->errors();

        if (count($errors) == 0) {
            $article->save();
            Redirect::to('/article/' . $article->id, array('message' => 'Artikkeli on lisätty peliin!'));

        } else {
            View::make('article/article_new.html', array('errors'=> $errors, 'attributes'=>$attributes)); 
        }
    }
    
    public static function create($game_id) {
        self::check_logged_in();
        View::make('article/article_new.html', array('game_id'=>$game_id));
    }
  }
