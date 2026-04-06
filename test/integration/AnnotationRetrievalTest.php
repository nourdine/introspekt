<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use artifacts\Person;
use Introspekt\Output\AnnotationsParcel;
use Introspekt\Introspekt;

class AnnotationRetrievalTest extends TestCase
{
   public function testRetrievalUsingObject()
   {
      $parcel = Introspekt::get(new Person());
      $this->assertTrue($parcel instanceof AnnotationsParcel);
   }

   public function testRetrievalUsingClassName()
   {
      $parcel = Introspekt::get("artifacts\Person");
      $this->assertTrue($parcel instanceof AnnotationsParcel);
   }
}
