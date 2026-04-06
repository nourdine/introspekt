<?php

declare(strict_types=1);

use artifacts\NotAnnotated;
use PHPUnit\Framework\TestCase;
use Introspekt\Introspekt;
use artifacts\Person;
use Introspekt\Exception\AnnotationNotFoundException;

class AnnotationNotFoundTest extends TestCase
{
   public function testRetrievalWhenAnnotationIsMissingAtClassLevel()
   {
      $this->expectException(AnnotationNotFoundException::class);
      Introspekt::get(new Person())->getAnnotation("@Not");
   }

   public function testRetrievalWhenAnnotationIsMissingAtMethodLevel()
   {
      $this->expectException(AnnotationNotFoundException::class);
      Introspekt::get(new Person())->getAnnotation("@Not", "getSurname");
   }

   public function testRetrievalWhenMethodDoesNotexist()
   {
      $this->expectException(AnnotationNotFoundException::class);
      Introspekt::get(new Person())->getAnnotation("@Name", "not");
   }

   public function testRetrievalWhenDocBlockIsMissingAtClassLevel()
   {
      $this->expectException(AnnotationNotFoundException::class);
      Introspekt::get(new NotAnnotated())->getAnnotation("@Greeting");
   }

   public function testRetrievalWhenDocBlockIsMissingAtMethodLevel()
   {
      $this->expectException(AnnotationNotFoundException::class);
      Introspekt::get(new NotAnnotated())->getAnnotation("@Greeting", "greet");
   }
}
