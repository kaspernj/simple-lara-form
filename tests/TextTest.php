<?php

require_once dirname(__FILE__) . "/TestHelper.php";

class TextTest extends TestCase{
  function testDefaultInput(){
    $html = SimpleLaraform::form_for("test", array("url" => "test"), function($f){
      echo $f->input("name");
      echo $f->input("age");
      echo $f->submit();
    });
    
    if (!strpos($html, "<input type=\"text\" name=\"test[name]\"")) throw new exception("Expected input test[name] to exist in: " . $html);
    if (!strpos($html, "<label for=\"test_name\"")) throw new exception("Expected label simple_laraform_test_name to exist in: " . $html);
  }
}
