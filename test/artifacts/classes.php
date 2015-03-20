<?php

namespace artifacts;

/**
 * This is a comment
 * @A("hello")
 * @B(["a", 1, "abc"])
 * @C
 */
class MultiAnnotated {
   
}

/**
 * This is the class DBBean
 * @Persisted
 * @Cool()
 * @Yeah(null)
 */
class DBBean {
   
}

/**
 * @PI(3.14159)
 * @ShapeSides(5)
 */
class Geometry {

   public function doSomething() {
      
   }
}

/**
 * This is the class Person
 * @Name("Laurent")
 */
class Person {
   
}

/**
 * This is the class Hacker
 * @Languages(["php", "java", "javascript"])
 */
class Hacker {

   /**
    * @Target("microsoft")
    * @Technologies([
     "telnet",
     "python"
     ])
    */
   function hackit() {
      
   }
}

/**
 * This is the class WebService
 * @ServiceData({
  "URI": "http://www.something.com/api/",
  "port": 8001,
  "user": "fabs",
  "passw": "hello123"
  })
 */
class WebService {
   
}

/**
 * @Email("admin@yahoo.com")
 */
class Danger {
   
}

/**
 * @Nationality("Italian")
 * @Nationality("English")
 * @Nationality("English")
 * @Nationality("English")
 * @Nationality("French")
 */
class StackedString {
   
}

/**
 * @Languages(["php", "java", "javascript"])
 * @Languages(["python", "haskell"])
 * @Languages(["python", "haskell"])
 */
class StackedArray {

}

/**
 * @Nill
 * @Nill()
 * @Nill(null)
 * @Nill(Null)
 */
class StackedNull {
   
}

/**
 * @QueryParam( { "name" : "fabs" } )
 * @QueryParam( { "surname" : "text" } )
 * @QueryParam( { "nationality" : "nowhere" } )
 */
class StackedObject {

}