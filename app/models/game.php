<?php

  class Game extends BaseModel{

    public $id, $name, $system, $description_short, $description, $gm_note;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_system', 'validate_description', 'validate_description_short', 'validate_gm_note');
    }

    public function validate_name(){
        $errors = $this->validate_string_len("Name", $this->name, 0, 64);;
        return $errors;
    }

    public function validate_system(){
        $errors = $this->validate_string_len("System", $this->system, 0, 32);
        return $errors;
    }

    public function validate_description(){
        $errors = $this->validate_string_len("Description", $this->system, 0, -1);
        return $errors;
    }

    public function validate_description_short(){
        $errors = $this->validate_string_len("Description_short", $this->system, 0, 128);
        return $errors;
    }

    public function validate_gm_note(){
        $errors = $this->validate_string_len("Dm note", $this->gm_note, 0, -1);
        return $errors;
    }

    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM game');
    
        $query->execute();

        $rows = $query->fetchAll();
        $games = array();

        foreach($rows as $row) {
            $games[] = new Game(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'system' => $row['system'],
                'description_short' => $row['description_short'],
                'description' => $row['description'],
                'gm_note' => $row['gm_note'],
            ));
        }
        return $games;
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM game WHERE id = :id');
        $query->execute(array('id'=>$this->id));
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE game SET name = :name, system = :system, description_short = :description_short, description = :description, gm_note = :gm_note WHERE id = :id');
        $query->execute(array('name' => $this->name, 'system' => $this->system, 'description_short' => $this->description_short, 'description' => $this->description, 'gm_note' => $this->gm_note, 'id' => $this->id));
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO game (name, system, description_short, description, gm_note) VALUES (:name, :system, :description_short, :description, :gm_note) RETURNING id');
        $query->execute(array('name' => $this->name, 'system' => $this->system, 'description_short' => $this->description_short, 'description' => $this->description, 'gm_note' => $this->gm_note));
        $row = $query->fetch();

        $this->id = $row['id'];
    }

    public function remove_user($user_id) {
        $query = DB::connection()->prepare('DELETE FROM game_users WHERE game_id = :game_id AND user_id = :user_id');
        $query->execute(array('game_id' => $this->id, 'user_id' => $user_id));
    }

    public function add_user($user_id) {
        $query = DB::connection()->prepare('INSERT INTO game_users (user_id, game_id, gamemaster) VALUES (:user_id, :game_id, False)');
        $query->execute(array('game_id' => $this->id, 'user_id' => $user_id));
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM game WHERE id = :id');
        $query->execute(array('id'=>$id));
        $row = $query->fetch();
    
        if ($row) {
            $game = new Game(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'system' => $row['system'],
                'description_short' => $row['description_short'],
                'description' => $row['description'],
                'gm_note' => $row['gm_note'],
            ));

            return $game;
        }
        return null;
    }
  }
