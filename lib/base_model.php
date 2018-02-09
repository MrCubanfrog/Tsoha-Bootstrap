<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
            $errors = array_merge($this->{$validator}(), $errors);
      }

      return $errors;
    }

    public function validate_string_len($muuttuja, $string, $min_len, $max_len) {
        $errors = array();
        if ($string == '' || $string == null) {
            $errors[] = "$muuttuja ei saa olla tyhjä";
        }
        if ($max_len != -1 && strlen($string) > $max_len) {
            $errors[] = "$muuttuja pituuden pitää olla enintään $max_len merkkiä";
        }
        if ($min_len != -1 && strlen($string) < $min_len) {
            $errors[] = "$muuttuja pituuden pitää olla vähintään $min_len merkkiä";
        }

        return $errors;
    }

    public function validate_id($id) {
        $errors = array();
        if ($id == null) {
            return $errors;
        }
        
        if (!is_int($id)) {
            $errors[] = "Id ei saa olla muu kuin int muuttuja";
        }

        return $errors;
    }
  }
