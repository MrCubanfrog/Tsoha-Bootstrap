<?php

  class GameUser extends BaseModel{

    public $user_id, $game_id, $gamemaster;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function findForGame($game_id) {
        $query = DB::connection()->prepare("SELECT * FROM game_users WHERE game_id = :game_id");
        $query->execute(array('game_id'=>$game_id));
        $rows = $query->fetchAll();

        $game_users = array();

        foreach($rows as $row) {
            $game_users[] = new GameUser(array(
                'user_id' => $row['user_id'],
                'game_id' => $row['game_id'],
                'gamemaster' => $row['gamemaster'],
            ));
        }
        return $game_users;
    }
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM game_users WHERE game_id = :game_id AND user_id = :user_id');
        $query->execute(array('game_id'=>$this->game_id, 'user_id'=>$this->user_id));
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE game_users SET gamemaster = :gamemaster WHERE game_id = :game_id AND user_id = :user_id');
        $query->execute(array('gamemaster'=>$this->gm_note, 'game_id' => $this->game_id, 'user_id' => $this->user_id));
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO game_users (game_id, user_id, gamemaster) VALUES (:game_id, :user_id, :gamemaster)');
        $query->execute(array('game_id' => $this->game_id, 'user_id' => $this->user_id, 'gamemaster' => $this->gamemaster));
        $row = $query->fetch();
    }


}
