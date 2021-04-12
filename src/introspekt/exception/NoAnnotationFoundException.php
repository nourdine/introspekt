<?php

namespace introspekt\exception;

use RuntimeException;

class NoAnnotationFoundException extends RuntimeException {

   const MSG_MISSING_CLASS_ANNO = 'Annotation %2$s not found in class %1$s';
   const MSG_MISSING_METHOD_ANNO = 'Annotation %2$s on method %3$s not found in class %1$s';

   public function __construct($className, $annotationName, $methodName) {
      if ($methodName === null) {
         parent::__construct(sprintf(self::MSG_MISSING_CLASS_ANNO, $className, $annotationName));
      } else {
         parent::__construct(sprintf(self::MSG_MISSING_METHOD_ANNO, $className, $annotationName, $methodName));
      }
   }
}