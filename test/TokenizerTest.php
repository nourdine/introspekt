<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Introspekt\Tokenizer;

class TokenizerTest extends TestCase
{
   private $tokens = null;

   public function setUp(): void
   {
      $this->tokens = (new Tokenizer(file_get_contents(__DIR__ . "/artifacts/annotations.txt")))->getAnnotationLanguageTokens();
   }

   public function testTokensNumber()
   {
      $this->assertEquals(10, count($this->tokens));
   }

   public function testTokensNames()
   {
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

   public function testTokensType()
   {
      $this->assertTrue(is_array($this->tokens["@A"]));
      $this->assertTrue(is_string($this->tokens["@B"]));
      $this->assertTrue(is_string($this->tokens["@C"]));
      
   }

   public function testTokensValues()
   {
      $this->assertEquals('"hello " ', $this->tokens["@A"][0]);
      $this->assertEquals('"ciao"', $this->tokens["@A"][1]);
      $this->assertEquals("null", $this->tokens["@C"]);
   }
}
