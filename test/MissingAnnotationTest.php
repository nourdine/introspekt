<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Introspekt\Introspekt;
use artifacts\Person;
use Introspekt\Exception\AnnotationNotFoundException;

class MissingAnnotationTest extends TestCase
{
   public function testRetrievalWhenAnnotationIsMissing()
   {
      $this->expectException(AnnotationNotFoundException::class);
      Introspekt::get(new Person())->getAnnotation("@Not");
   }

   // TODO test it at the method level as well
}
