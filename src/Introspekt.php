<?php

declare(strict_types=1);

namespace Introspekt;

use ReflectionClass;
use Introspekt\AnnotationsParcel;

/**
 * Core class allowing introspection of annotated classes and objects.
 */
abstract class Introspekt
{
   static private $parcels = [];

   /**
    * Return an AnnotationsParcel containing the annotations of a certain class.
    * 
    * @param object|string $source An object or the name of a class
    * @return AnnotationsParcel
    */
   static public function get(object|string $source): AnnotationsParcel
   {
      $className = null;

      if (is_object($source)) {
         $className = get_class($source);
      } else if (is_string($source)) {
         $className = $source;
      }

      if (!array_key_exists($className, self::$parcels)) {
         $klass = new ReflectionClass($className);
         $parcel = new AnnotationsParcel(
            $klass->getDocComment(),
            self::getMethodsDocComments($klass->getMethods()),
            $className);
         self::$parcels[$className] = $parcel;
      }

      return self::$parcels[$className];
   }

   static public function countAnnotationsParcels(): int
   {
      return count(self::$parcels);
   }

   static private function getMethodsDocComments(array $methods): array
   {
      $docComments = [];
      foreach ($methods as $m) {
         $docComments[$m->getName()] = $m->getDocComment();
      }
      return $docComments;
   }
}
