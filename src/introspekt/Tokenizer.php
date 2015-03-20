<?php

namespace introspekt;

abstract class Tokenizer {

   const TOKENS = "/(@[\w-]+) *(\((.*?)\))?/s"; // s stands for PCRE_DOTALL

   /**
    * Wrapper for preg_match_all, that's it!
    * @param type $re
    * @param type $str
    * @return array
    */
   static private function pregMatchAll($re, $str) {
      $match = array();
      preg_match_all($re, $str, $match);
      return $match;
   }

   /**
    * "Null", "null" (and uppercased/lowercased variations) 
    * and the empty string ("") too 
    * must all be the same thing.
    * @param string $str
    * @return string 
    */
   static private function value($str) {
      if ($str === "" || strtolower($str) === "null") {
         $str = "null";
      }
      return $str;
   }

   /**
    * Identify the tokens of ALL the annotations contained in a string (tipically a documentation comment block)
    * Allows annotations with the same name to be stacked on top of each other with NO REPEATED VALUES!
    * @param string $str
    * @return array
    */
   static public function getAnnotationLanguageTokens($str) {
      $annotationsMap = array();
      $matches = self::pregMatchAll(self::TOKENS, $str);
      if (count($matches[0]) > 0) {
         $annotationNames = $matches[1];
         $annotationValues = $matches[3];
         for ($i = 0; $i < count($matches[0]); $i++) {
            $key = $annotationNames[$i];
            $value = self::value($annotationValues[$i]);
            if (key_exists($key, $annotationsMap)) {
               if (is_string($annotationsMap[$key])) {
                  if ($value !== $annotationsMap[$key]) {
                     $string = $annotationsMap[$key];
                     $annotationsMap[$key] = array($string, $value);
                  }
               } else {
                  // it's already an array then!
                  if (false === array_search($value, $annotationsMap[$key], true)) {
                     $annotationsMap[$key][] = $value;
                  }
               }
            } else {
               $annotationsMap[$key] = $value;
            }
         }
      }
      return $annotationsMap;
   }
}