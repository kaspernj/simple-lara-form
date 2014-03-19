<?php

require_once dirname(__FILE__) . "/../test_helper.php";

class SelectTest extends TestCase{
  function testSelectBasic(){
    $html = SimpleLaraform::form_for("test", array("url" => "test_url"), function($f){
      echo $f->input("list", array("as" => "select", "value" => 2, "collection" => array(1 => "1test", 2 => "2test", 3 => "3test")));
      echo $f->submit();
    });
    
    if (!strpos($html, "<select name=\"test[list]\">")) throw new exception("Could not find the select element in the list.");
    if (!strpos($html, "<option value=\"1\">1test</option>")) throw new exception("Could not find option 1.");
    if (!strpos($html, "<option value=\"2\" selected>2test</option>")) throw new exception("Could not find a selected option 2.");
  }
}
