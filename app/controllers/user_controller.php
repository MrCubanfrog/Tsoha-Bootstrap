<?php

    class UserController extends BaseController {

        public static function login(){
            View::make('user/login.html');
        }

        public static function handle_login() {
            $params = $_POST;

            $user = User::authenticate($params['username'], $params['password']);

            if (!$user) {
                View::make('user/login.html', array('error'=>'Väärä tunnus tai salasana', 'username'=>$params['username']));
            } else {
                $_SESSION['user'] = $user->id;
                Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->name . '!'));
            }
        }
    
        public static function logout() {
            $_SESSION['user'] = null;
            Redirect::to('/login', array('message'=>'Olet kirjautunut ulos!'));
        }

        public static function handle_user_screen($game_id) {
            $game_users = GameUser::findForGame($game_id);
            $users = User::findAll();
            View::make('user/users.html', array('game_id' => $game_id, 'game_users' => $game_users, 'users' => $game_users, 'users'=> $users));
        }

        public static function add_user_to_game($game_id, $user_id) {
            $game = Game::find($game_id);
            $game->add_user($user_id);
            Redirect::to('/game/' . $game_id . '/users', array('message' => 'Pelaaja lisätty peliin mukaan!'));
        }
    
        public static function remove_user_from_game($game_id, $user_id) {
            $game = Game::find($game_id);
            $game->remove_user($user_id);
            Redirect::to('/game/' . $game_id . '/users', array('message' => 'Pelaaja lisätty peliin mukaan!'));
        }
    }
