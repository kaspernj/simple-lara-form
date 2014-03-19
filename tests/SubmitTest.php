<?php

require_once dirname(__FILE__) . "/TestHelper.php";

class SubmitTest extends TestCase{
  function testSubmit(){
    $html = SimpleLaraform::form_for("test", array("url" => "test_url"), function($f){
      echo $f->input("list", array("as" => "Select", "value" => 2, "collection" => array(1 => "1test", 2 => "2test", 3 => "3test")));
      echo $f->submit();
    });
    
    if (!strpos($html, "<input type=\"submit\" value=\"Save\"")) throw new exception("Could not find the submit button.");
  }
}
