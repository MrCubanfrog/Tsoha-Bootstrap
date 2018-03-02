<?php
    
    class Article extends BaseModel {

        public $id, $game_id, $name, $description_short, $description, $gm_note;

        public function __construct($attributes) {
            parent::__construct($attributes);
            $this->validators = array();

        }

        public static function find($id) {
            $query = DB::connection()->prepare('SELECT * FROM article WHERE id = :id');
            $query->execute(array('id'=>$id));
            $row = $query->fetch();

            if ($row) {
                $article = new Article(array(
                    'id' => $row['id'],
                    'game_id' => $row['game_id'],
                    'name' => $row['name'],
                    'description_short' => $row['description_short'],
                    'description' => $row['description'],
                    'gm_note' => $row['gm_note'],
                ));

                return $article;
            }

            return null;
        }

        public static function findAllInGame($game_id) {
            $query = DB::connection()->prepare('SELECT * FROM article WHERE game_id = :game_id');
            $query->execute(array('game_id'=>$game_id));
            $rows = $query->fetchAll();
            $articles = array();

            foreach($rows as $row) {
                $articles[] = new Article(array(
                    'id' => $row['id'],
                    'game_id' => $row['game_id'],
                    'name' => $row['name'],
                    'description_short' => $row['description_short'],
                    'description' => $row['description'],
                    'gm_note' => $row['gm_note'],
                ));

            }
            return $articles;
        }

        public function destroy() {
            $query = DB::connection()->prepare('DELETE FROM article WHERE id = :id');
            $query->execute(array('id'=>$this->id));
        }

        public function update() {
            $query = DB::connection()->prepare('UPDATE article SET name = :name, description_short = :description_short, description = :description, gm_note = :gm_note WHERE id = :id');
            $query->execute(array('name' => $this->name,  'description_short' => $this->description_short, 'description' => $this->description, 'gm_note' => $this->gm_note, 'id' => $this->id));
        }

        public function save() {
            $query = DB::connection()->prepare('INSERT INTO article (game_id, name, description_short, description, gm_note) VALUES (:game_id, :name, :description_short, :description, :gm_note) RETURNING id');
            $query->execute(array('game_id' => $this->game_id, 'name' => $this->name, 'description_short' => $this->description_short, 'description' => $this->description, 'gm_note' => $this->gm_note));
            $row = $query->fetch();

            $this->id = $row['id'];
        }
    }
