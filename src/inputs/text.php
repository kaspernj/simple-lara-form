<?php

namespace simple_laraform\inputs;

class Text extends BaseInput{
  function getElement(){
    $data = $this->containerWithLabel();
    
    $input = $this->getDom()->createElement("input");
    $input->setAttribute("type", "text");
    $input->setAttribute("name", $this->getName());
    $input->setAttribute("value", $this->getValue());
    
    $data["input_container"]->appendChild($input);
    
    return $data["container"];
  }
}
