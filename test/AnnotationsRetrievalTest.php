<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use artifacts\Hacker;
use Introspekt\AnnotationsParcel;
use Introspekt\Introspekt;

class AnnotationsRetrievalTest extends TestCase
{
   public function testRetrievalUsingObject()
   {
      $parcel = Introspekt::get(new Hacker());
      $this->assertTrue($parcel instanceof AnnotationsParcel);
   }

   public function testRetrievalUsingClassName()
   {
      $parcel = Introspekt::get("artifacts\Hacker");
      $this->assertTrue($parcel instanceof AnnotationsParcel);
   }
}
