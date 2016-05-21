<?php

namespace introspekt;

use introspekt\AnnotationsParcel;
use ReflectionClass;

/**
 * Core class allowing introspection of annotated classes and objects.
 */
abstract class Introspekt {

   static private $parcels = [];

   /**
    * Get an AnnotationsParcel containing the annotations of a certain class.
    * 
    * @param object|string $o An object or the name of a class
    * @return AnnotationsParcel
    */
   static public function get($o) {

      $cn = null;

      if (is_object($o)) {
         $cn = get_class($o);
      } else if (is_string($o)) {
         $cn = $o;
      }

      if (!array_key_exists($cn, self::$parcels)) {
         $klass = new ReflectionClass($cn);
         $parcel = new AnnotationsParcel($klass->getDocComment(), self::getMethodsDocComments($klass->getMethods()), $cn);
         self::$parcels[$cn] = $parcel;
      }

      return self::$parcels[$cn];
   }

   /**
    * Getter for testing purposes
    */
   static public function getAnnotationsParcels() {
      return self::$parcels;
   }

   /**
    * Getter for testing purposes
    */
   static public function getAnnotationsParcelByClassName($name) {
      return self::$parcels[$name];
   }

   static private function getMethodsDocComments(array $methods) {
      $docComments = [];

      foreach ($methods as $m) {
         $docComments[$m->getName()] = $m->getDocComment();
      }

      return $docComments;
   }
}
