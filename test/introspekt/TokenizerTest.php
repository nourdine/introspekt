<?php

use PHPUnit\Framework\TestCase;
use introspekt\Tokenizer;

class TokenizerTest extends TestCase {

   private $str = "";
   private $tokens = null;

   public function setUp() : void {
      $this->str = file_get_contents(__DIR__ . "/../artifacts/annotations.txt");
      $this->tokens = (new Tokenizer())->getAnnotationLanguageTokens($this->str);
   }

   public function testTokensNumber() {
      $this->assertEquals(10, count($this->tokens));
   }

   public function testTokensNames() {
      $this->assertTrue(array_key_exists("@A", $this->tokens));
      $this->assertTrue(array_key_exists("@B", $this->tokens));
      $this->assertTrue(array_key_exists("@C", $this->tokens));
      $this->assertTrue(array_key_exists("@D", $this->tokens));
      $this->assertTrue(array_key_exists("@E", $this->tokens));
      $this->assertTrue(array_key_exists("@X", $this->tokens));
      $this->assertTrue(array_key_exists("@Z1", $this->tokens));
      $this->assertTrue(array_key_exists("@Z2", $this->tokens));
      $this->assertTrue(array_key_exists("@Z_3", $this->tokens));
      $this->assertTrue(array_key_exists("@Z-4", $this->tokens));
   }

   public function testTokensType() {
      $this->assertTrue(is_array($this->tokens["@A"]));
      $this->assertTrue(is_string($this->tokens["@B"]));
   }

   public function testTokensValues() {
      $this->assertEquals('"hello " ', $this->tokens["@A"][0]);
      $this->assertEquals('"ciao"', $this->tokens["@A"][1]);
   }
}