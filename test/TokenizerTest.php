<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Introspekt\Tokenizer;

function stripWS($str) {
   return preg_replace('/\s+(?=(?:[^"]*"[^"]*")*[^"]*$)/', '', $str);
}

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
      $this->assertTrue(array_key_exists("@Y", $this->tokens));
      $this->assertTrue(array_key_exists("@Z1", $this->tokens));
      $this->assertTrue(array_key_exists("@Z_2", $this->tokens));
      $this->assertTrue(array_key_exists("@Z-3", $this->tokens));
   }

   public function testTokensType()
   {
      $this->assertTrue(is_array($this->tokens["@A"]));
      $this->assertTrue(is_string($this->tokens["@B"]));
      $this->assertTrue(is_string($this->tokens["@C"]));
      $this->assertTrue(is_string($this->tokens["@D"]));
      $this->assertTrue(is_string($this->tokens["@E"]));
      $this->assertTrue(is_string($this->tokens["@X"]));
      $this->assertTrue(is_string($this->tokens["@Y"]));
      $this->assertTrue(is_string($this->tokens["@Z1"]));
      $this->assertTrue(is_string($this->tokens["@Z_2"]));
   }

   public function testTokensValues()
   {
      $this->assertEquals('"hello " ', $this->tokens["@A"][0]);
      $this->assertEquals('"ciao"', $this->tokens["@A"][1]);
      $this->assertEquals('"yo"', $this->tokens["@B"]);
      $this->assertEquals("null", $this->tokens["@C"]);
      $this->assertEquals("null", $this->tokens["@D"]);
      $this->assertEquals(
         '{"name":"wab s","lang":"it"}',
         stripWS($this->tokens["@E"]));
      $this->assertEquals("null", $this->tokens["@X"]);
      $this->assertEquals(
         '{"name":["n","o","u"],"lang":1}',
         stripWS($this->tokens["@Y"]));
      $this->assertEquals("null", $this->tokens["@Z1"]);
      $this->assertEquals("null", $this->tokens["@Z_2"]);
      $this->assertEquals(
         '["yo","dude"]',
          stripWS($this->tokens["@Z-3"]));
   }
}
