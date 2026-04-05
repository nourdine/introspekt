<?php

declare(strict_types=1);

namespace artifacts;

/**
 * @A("hello")
 * @B(["a", 1, "abc"])
 * @C
 */
class MultiAnnotated {}

/**
 * @Persisted
 * @Cool()
 * @Yeah(null)
 */
class Entity {}

/**
 * @PI(3.14159)
 * @ShapeSides(5)
 */
class Geometry
{
   public function doSomething() {}
}

/**
 * @Name("Laurent")
 */
class Person {}

/**
 * @Languages(["php", 
       "java",       "JavaScript"     ]     )
 */
class Hacker
{
   /**
    * @Target("microsoft")
    * @Technologies([
         "telnet",
         "python"
      ])
    */
   function hackit() {}
}

/**
 * @ServiceData({
      "URI": "http://www.something.blabla/api/",
      "port": 8080
  })
 */
class WebService {}

/**
 * @Nationality("Italian")
 * @Nationality("English")
 * @Nationality("English")
 * @Nationality("English")
 * @Nationality("French")
 */
class StackedString {}

/**
 * @Languages(["php", "java", "JavaScript"])
 * @Languages(["python", "haskell"])
 * @Languages(["python", "haskell"])
 */
class StackedArray {}

/**
 * @Nill
 * @Nill()
 * @Nill(null)
 * @Nill(Null)
 */
class StackedNull {}

/**
 * @QueryParam( { "name" : "Nou" } )
 * @QueryParam( { "surname" : "White" } )
 * @QueryParam( { "surname" : "White" } )
 * @QueryParam( { "nationality" : "nowhere" } )
 */
class StackedObject {}
