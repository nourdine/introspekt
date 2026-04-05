<?php

include_once __DIR__ . "/../vendor/autoload.php";

use Introspekt\Introspekt;

class AI { 
   
   /**
    * @Default(42)
    */
   public function getAnswer() {
      return (Introspekt::get($this))->getAnnotation("@Default", "getAnswer");
   } 
}

echo (new AI())->getAnswer();