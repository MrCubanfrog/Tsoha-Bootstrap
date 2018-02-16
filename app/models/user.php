<?php

    class User extends BaseModel{

        public $id, $name, $password, $admin;

        public function __construct($attributes) {
            parent::__construct($attributes);
            $this->validators = array('validate_name', 'validate_password');
        }
   
        public function validate_name(){
            $errors = $this->validate_string_len("Name", $this->name, 3, 32);
            return $errors;
        }
    
        public function validate_password(){
            $errors = $this->validate_string_len("Password", $this->password, 3, 64);
            return $errors;
        }

        public static function find($user_id) {
            $query = DB::connection()->prepare('SELECT * FROM site_user WHERE id = :id');
            $query->execute(array('id'=>$user_id));
            $row = $query->fetch();
        
            if ($row) {
                $user = new User(array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'password' => $row['password'],
                    'admin' => $row['admin'],
                ));

                return $user;
            }
            return null;

        }
 
        public static function authenticate($username, $password) {
            $query = DB::connection()->prepare('SELECT * FROM site_user WHERE name = :name AND password = :password LIMIT 1;');
            $query->execute(array('name'=>$username, 'password'=>$password));
            $row = $query->fetch();

            if ($row) {
                $site_user = New User(array(
                    'id'=>$row['id'],                   
                    'name'=>$row['name'],
                    'password'=>$row['password'],
                    'admin'=>$row['admin'],
                ));                
                return $site_user;
            } else {
                return null;
            }
        }
    }

