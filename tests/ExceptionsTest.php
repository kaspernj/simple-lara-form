<?php

require_once dirname(__FILE__) . "/TestHelper.php";

class ExceptionsTest extends TestCase{
  function testExceptions(){
    try{
      $html = SimpleLaraform::form_for("test", array("url" => "test_url"), function($f){
        echo $f->input("list", array("as" => "Select", "value" => 2, "collection" => array(1 => "1test", 2 => "2test", 3 => "3test")));
        throw new exception("test");
        echo $f->submit();
      });
      
      $this->assertNull(true);
    }catch(exception $e){
      $this->assertEquals("test", $e->getMessage());
    }
  }
}
