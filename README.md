Introspekt
==========

### 1. Intro

**Introspekt** is an **annotations** library for php.

Annotations allow to add metadata to classes and methods that can then be used at runtime to modify the behaviour of such entities.

### 2. It's all in the DocBlocks!

Introspekt annotations need to be defined inside the [DocBlock](http://en.wikipedia.org/wiki/PHPDoc#DocBlock) of a class or method. Here's an example of a DocBlock in php:

```php
/**
 * This is a documentation block. Not yet an annotation though :(
 */
class Foo { }
```

Obviously, that doesn't contain any annotation yet. Here's what a simple string annotations would look like:

```php
/**
 * @Author("nourdine")
 */
class Foo { }
```

Now let's talk about the supported types of Introspekt annotations and then move on to see (in paragraph 4) how they can be retrieved and used programmatically.

### 3. Types and scopes

There are four allowed types of annotations:

  1. **Null annotations (or marker annotations as they are called in java):** the value contained by this type of annotations is `null` and can have the following forms:

```php
/**
 * @MyAnnotation
 * @MyAnnotation()
 * @MyAnnotation(null)
 */
class Foo { }
```

  2. **Primitive type annotations:** the value contained by this type of annotation is of type `string|integer|double`. Here's an example:

```php
/**
 * @MyName("nourdine")
 * @MyAge(18)
 * @MyHeight(175.33)
 */
class Foo { }
```

  3. **Array annotations:** the value contained by this type of annotation is of type `array` (non associative). Here's an example:

```php
/**
 * @MyAnnotation(["hi", "how", "are", "you", "?"])
 */
class Foo { }
```

  4. **Associative Array annotations:** the value contained by this type of annotation is of type `array` (associative). Here's an example: 

```php
/**
 * @MyAnnotation({
      "name": "nourdine",
      "languages": [
         "JavaScript",
         "php",
         "java"
      ]
   })
 */
class Foo { }
```

**Note:** When using arrays (associative and non) you are allowed to indent your annotation's code (instead of singleline it) provided that you **DO NOT** use the asterisk character (`*`) at the beginning of each new line.

Finally, let's quickly point out how there are just two scopes you can target with your annotations:
  
  * Class scope
  * Method scope
  
Here's some code that shows the two options:

```php
/**
 * @Author("Nourdine")
 */
class AI { 
   
   /**
    * @Default(42)
    */
   public function answer() {
      
   } 
}
```

### 4. Retrieve and use annotations

To gain access to our annotations, we need to obtain a `Introspekt\AnnotationsParcel` object containing a representation of the annotated data.

There are two possible ways to do this:

  1. Via an instance of the annotted class
  2. Using the name of the class

Here's an example of the first type of access (we will use the class `AI` defined above for ease of exposition):

```php
$hal = new AI();
// get an interface to the annotated class
$annotatedHal = Introspekt::get($hal);
// and now do cool things ...
$annotatedHal->getAnnotation("@Author"); // return "Nourdine": this is a class annotation 
$annotatedHal->getAnnotation("@Default", "answer"); // return 42 - this is a method annotation
```

The second access technique (access through the class name) requires that you specify the _name_ of the class itself:

```php
$annotatedHal = Introspekt::get("AI");
// and now do cool things as above ...
```

If your classes are namespaced (who doesn't use namespaces these days?) you have to specify the **fully qualified name of the class**, namely the class name preceded by the full namespace.

In this very case you might need to double-escape certain backslashes that would otherwise be interpreted as _new line_ or _return_ characters (or anythig else of that sort). Suppose in fact you were trying to access the namespaced class `package\name\Foo`. As you can see there is a `\n` (newline) in the fully-qualified name of the class and that would cause a problem to the interpreter. Therefore, this is how you must escape the backslash symbols in order for the script to work:

```php
$annotatedFoo = Introspekt::get("package\\name\\Foo");
```

Finally, remember that trying to access a non-existing annotation (both at the class or at the method's level) results in a `Introspekt\AnnotationNotFoundException` exception being thrown. Have a look: 

```php
try {
   $annotatedHal->getAnnotation("@Not"); // this will raise and exception ...
} catch (AnnotationNotFoundException $e) {
   echo $e->getMessage(); // ... and hence execution will get to this point!
}
```

### 5. Stacked annotations

When adding a certain annotation multiple times to a class or a method you get what we call a _stacked annotation_. This will result in an array containg the different values you assigned to that annotation. So for instance you will have that:

```php
/**
 * @Name("Nourdine")
 * @Name("Enidruon")
 */
class Foo {

}

$annotated = Introspekt::get("Foo");
$annotated->getAnnotation("@Name"); // this will return ["Nourdine", "Enidruon"]
```

In some cases this feature con be really useful. Also bear in mind that **repeated values won't be stacked together** and only a single instance of the value will be recorded:

```php
/**
 * @Name("Nourdine")
 * @Name("Nourdine")
 */
class Foo {

}

$annotated = Introspekt::get("Foo");
$annotated->getAnnotation("@Name"); // this will return "Nourdine"
```

### 6. Format your JSON annotations well!

Because Introspekt interbally relies on the usage of [json_decode](http://ch2.php.net/manual/en/function.json-decode.php), you have to remember to carefully format your JSON annotation values.

Here's [an excerpt taken from php.net](http://www.php.net/manual/en/function.json-decode.php#example-3422) that shows possible issues related to the way you will format your JSON annotations:

```php
// the name and value must be enclosed in double quotes
// single quotes are not valid 
$bad_json = "{ 'bar': 'baz' }";
json_decode($bad_json); // null

// the name must be enclosed in double quotes
$bad_json = '{ bar: "baz" }';
json_decode($bad_json); // null

// trailing commas are not allowed
$bad_json = '{ bar: "baz", }';
json_decode($bad_json); // null
```

### 7. Running Unit Tests

```
composer install
composer run-script test
```
