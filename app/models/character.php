<?php
    
    class Character extends BaseModel {

        public $id, $user_id, $game_id, $name, $description_short, $description, $history, $gma_note, $creation_info;

        public function __construct($attributes) {
            parent::__construct($attributes);
        }

        public static function find($id) {
            $query = DB::connection()->prepare('SELECT * FROM player_character WHERE id = :id');
            $query->execute(array('id'=>$id));
            $row = $query->fetch();

            if ($row) {
                $query = DB::connection()->prepare('SELECT * from creation_date WHERE id = :id');
                $query->execute(array('id'=>$row['creation_id']));
                $creation_info = $query->fetch();

                $character = new Character(array(
                    'id' => $row['id'],
                    'user_id' => $row['user_id'],
                    'game_id' => $row['game_id'],
                    'name' => $row['name'],
                    'description_short' => $row['description_short'],
                    'description' => $row['description'],
                    'history' => $row['history'],
                    'gm_note' => $row['gm_note'],
                    'creation_info' => array('id'=>$creation_info['id'], 'creation_date'=>$creation_info['creation_date'])
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
                $query = DB::connection()->prepare('SELECT * from creation_date WHERE id = :id');
                $query->execute(array('id'=>$row['creation_id']));
                $creation_info = $query->fetch();

                $characters[] = new Character(array(
                    'id' => $row['id'],
                    'user_id' => $row['user_id'],
                    'game_id' => $row['game_id'],
                    'name' => $row['name'],
                    'description_short' => $row['description_short'],
                    'description' => $row['description'],
                    'history' => $row['history'],
                    'gm_note' => $row['gm_note'],
                    'creation_info' => array('id'=>$creation_info['id'], 'creation_date'=>$creation_info['creation_date'])
                ));

            }
            return $characters;
        }
    }
