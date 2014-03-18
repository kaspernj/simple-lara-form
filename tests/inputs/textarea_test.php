<?php

require_once dirname(__FILE__) . "/../test_helper.php";

class TextareaTest extends TestCase{
  function testBasicHTML(){
    $html = SimpleLaraform::form_for("test", array("url" => "test"), function($f){
      $f->input("name");
      $f->input("description", array("as" => "textarea", "value" => "TestValue"));
      $f->submit();
    });
    
    if (!strpos($html, "<textarea name=\"test[description]\">TestValue</textarea>")) throw new exception("Expected textarea test[description] to exist in: " . $html);
    if (!strpos($html, "<label for=\"test_description\"")) throw new exception("Expected label for test_description to exist in: " . $html);
  }
}
