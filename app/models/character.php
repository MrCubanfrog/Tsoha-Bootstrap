<?php
    
    class Character extends BaseModel {

        public $id, $user_id, $game_id, $name, $description_short, $description, $history, $gm_note;

        public function __construct($attributes) {
            parent::__construct($attributes);
            $this->validators = array();

        }

        public static function find($id) {
            $query = DB::connection()->prepare('SELECT * FROM player_character WHERE id = :id');
            $query->execute(array('id'=>$id));
            $row = $query->fetch();

            if ($row) {
                $character = new Character(array(
                    'id' => $row['id'],
                    'user_id' => $row['user_id'],
                    'game_id' => $row['game_id'],
                    'name' => $row['name'],
                    'description_short' => $row['description_short'],
                    'description' => $row['description'],
                    'history' => $row['history'],
                    'gm_note' => $row['gm_note'],
                ));

                return $character;
            }

            return null;
        }

        public static function findAllInGame($game_id) {
            $query = DB::connection()->prepare('SELECT * FROM player_character WHERE game_id = :game_id');
            $query->execute(array('game_id'=>$game_id));
            $rows = $query->fetchAll();
            $characters = array();

            foreach($rows as $row) {
                $characters[] = new Character(array(
                    'id' => $row['id'],
                    'user_id' => $row['user_id'],
                    'game_id' => $row['game_id'],
                    'name' => $row['name'],
                    'description_short' => $row['description_short'],
                    'description' => $row['description'],
                    'history' => $row['history'],
                    'gm_note' => $row['gm_note'],
                ));

            }
            return $characters;
        }

        public function destroy() {
            $query = DB::connection()->prepare('DELETE FROM player_character WHERE id = :id');
            $query->execute(array('id'=>$this->id));
        }

        public function update() {
            $query = DB::connection()->prepare('UPDATE player_character SET name = :name, description_short = :description_short, description = :description, history = :history, gm_note = :gm_note WHERE id = :id');
            $query->execute(array('name' => $this->name,  'description_short' => $this->description_short, 'description' => $this->description, 'history'=>$this->history, 'gm_note' => $this->gm_note, 'id' => $this->id));
        }

        public function save() {
            $query = DB::connection()->prepare('INSERT INTO player_character (user_id, game_id, name, description_short, description, history, gm_note) VALUES (:user_id, :game_id, :name, :description_short, :description, :history, :gm_note) RETURNING id');
            $query->execute(array('user_id' => $this->user_id, 'game_id' => $this->game_id, 'name' => $this->name, 'description_short' => $this->description_short, 'description' => $this->description, 'history'=> $this->history, 'gm_note' => $this->gm_note));
            $row = $query->fetch();

            $this->id = $row['id'];
        }
    }
