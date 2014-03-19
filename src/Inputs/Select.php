<?php

namespace SimpleLaraForm\Inputs;

class Select extends BaseInput{
  function getElement(){
    $data = $this->containerWithLabel();
    $select = $this->getDom()->createElement("select");
    $select->setAttribute("name", $this->getName());
    
    foreach($this->getArgs()["collection"] as $key => $value){
      $this->spawnOption($select, $key, $value);
    }
    
    $data["input_container"]->appendChild($select);
    return $data["container"];
  }
  
  private function spawnOption($select, $key, $value){
    $option = $this->getDom()->createElement("option", $value);
    $option->setAttribute("value", $key);
    if ($this->getValue() == $key) $option->setAttribute("selected", "selected");
    
    $select->appendChild($option);
  }
}
