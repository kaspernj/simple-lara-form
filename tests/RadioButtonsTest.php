<?php

require_once dirname(__FILE__) . "/TestHelper.php";

class RadioButtonsTest extends TestCase{
  function testRadioButtons(){
    $html = SimpleLaraForm::form_for("test", array("url" => "test_url"), function($f){
      echo $f->input("radio_test", array("as" => "RadioButtons", "collection" => array(1 => "1test", 2 => "2test", 3 => "3test")));
      echo $f->submit();
    });
    
    if (!strpos($html, "<input type=\"radio\" name=\"test[radio_test]\" value=\"1\"")) throw new exception("Could not find the first radio element.");
  }
}
