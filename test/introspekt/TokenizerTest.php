<?php

use introspekt\Tokenizer;

class TokenizerTest extends PHPUnit_Framework_TestCase {

   private $str = "";
   private $tokens = null;

   public function setUp() {
      $this->str = file_get_contents(__DIR__ . "/../artifacts/annotations.txt");
      $this->tokens = Tokenizer::getAnnotationLanguageTokens($this->str);
   }

   public function testCountTokens() {
      $this->assertEquals(10, count($this->tokens));
   }

   public function testTokensNames() {
      $this->assertTrue(array_key_exists("@Z1", $this->tokens));
      $this->assertTrue(array_key_exists("@Z2", $this->tokens));
      $this->assertTrue(array_key_exists("@Z_3", $this->tokens));
      $this->assertTrue(array_key_exists("@Z-4", $this->tokens));
   }
}