<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Introspekt\Introspekt;
use artifacts\Hacker;
use artifacts\Entity;
use artifacts\Geometry;

class HasAnnotationTest extends TestCase
{
   public function testExistence()
   {
      $this->assertTrue(Introspekt::get(new Entity())->hasAnnotation("@Persisted"));
      $this->assertTrue(Introspekt::get(new Entity())->hasAnnotation("@Cool"));
      $this->assertTrue(Introspekt::get(new Entity())->hasAnnotation("@Yeah"));
      $this->assertTrue(Introspekt::get(new Hacker())->hasAnnotation("@Languages"));
      $this->assertTrue(Introspekt::get(new Geometry())->hasAnnotation("@PI"));
      $this->assertTrue(Introspekt::get(new Geometry())->hasAnnotation("@ShapeSides"));
   }
}
