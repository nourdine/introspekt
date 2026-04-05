<?php

declare(strict_types=1);

use artifacts\Entity;
use PHPUnit\Framework\TestCase;
use Introspekt\Introspekt;

class TypeNullAnnotationTest extends TestCase
{
   private $annotations = null;

   public function setUp(): void
   {
      $this->annotations = Introspekt::get(new Entity());
   }

   public function testRetrievedValueWithNoBrackets()
   {
      $value = $this->annotations->getAnnotation("@Persisted");
      $this->assertTrue(is_null($value));
   }

   public function testRetrievedValueWithEmptyBrackets()
   {
      $value = $this->annotations->getAnnotation("@Cool");
      $this->assertTrue(is_null($value));
   }

   public function testRetrievedValueWithNull()
   {
      $value = $this->annotations->getAnnotation("@Yeah");
      $this->assertTrue(is_null($value));
   }
}
