<?php

  class Game extends BaseModel{

    public $id, $name, $system, $description_short, $description, $gm_note, $creation_info;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM game');
    
        $query->execute();

        $rows = $query->fetchAll();
        $games = array();

        foreach($rows as $row) {
            $query = DB::connection()->prepare('SELECT * from creation_date WHERE id = :id');
            $query->execute(array('id'=>$row['creation_id']));
            $creation_info = $query->fetch();

            $games[] = new Game(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'system' => $row['system'],
                'description_short' => $row['description_short'],
                'description' => $row['description'],
                'gm_note' => $row['gm_note'],
                'creation_info' => array('id'=>$creation_info['id'], 'creation_date'=>$creation_info['creation_date'])
            ));
        }
        return $games;
    }

    public static function save() {
        $creation_query = DB::connection()->prepare('INSERT INTO creation_date DEFAULT VALUES RETURNING id');
        $creation_query()->execute()
        $creation_date = $query->fetchone()

        $query = DB::connection()->prepare('INSERT INTO game (name, system, short_description, description, gm_note, creation_id) VALUES (:name, :system, :short_description, :description, :gm_note, :creation_id)');

        $query->execute(array('name' => $this.name, 'system' => $this.system, 'short_description' => $this.short_description, 'description' => $this.description, 'gm_note' => $this.gm_note, 'creation_id' => $creation_date['id']));

        $row = $query->fetch();
        Kint::trace();
        Kint::dump($row);
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM game WHERE id = :id');
        $query->execute(array('id'=>$id));
        $row = $query->fetch();
    
        if ($row) {
            $query = DB::connection()->prepare('SELECT * from creation_date WHERE id = :id');
            $query->execute(array('id'=>$row['creation_id']));
            $creation_info = $query->fetch();

            $game = new Game(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'system' => $row['system'],
                'description_short' => $row['description_short'],
                'description' => $row['description'],
                'gm_note' => $row['gm_note'],
                'creation_info' => array('id'=>$creation_info['id'], 'creation_date'=>$creation_info['creation_date'])
            ));

            return $game;
        }
        return null;
    }

  }
