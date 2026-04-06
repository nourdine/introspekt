<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Introspekt\Introspekt;
use artifacts\Entity;
use artifacts\NotAnnotated;
use artifacts\Person;

class HasAnnotationTest extends TestCase
{
   public function testExistence()
   {
      $this->assertTrue(Introspekt::get(new Entity())->hasAnnotation("@Persisted"));
      $this->assertFalse(Introspekt::get(new Entity())->hasAnnotation("@Not"));
      $this->assertTrue(Introspekt::get(new Person())->hasAnnotation("@Surname", "getSurname"));
      $this->assertFalse(Introspekt::get(new Person())->hasAnnotation("@Not", "getSurname"));
      $this->assertFalse(Introspekt::get(new NotAnnotated())->hasAnnotation("@Not"));
      $this->assertFalse(Introspekt::get(new NotAnnotated())->hasAnnotation("@Not", "greet"));
   }
}
