<?php

namespace SimpleLaraForm\Inputs;

class RadioButtons extends BaseInput{
  function getElement(){
    $data = $this->containerWithLabel();
    
    foreach($this->getArgs()["collection"] as $key => $value){
      $this->createRadioOption($data["input_container"], $key, $value);
    }
    
    return $data["container"];
  }
  
  private function createRadioOption($input_container, $key, $value){
    $radio_container = $this->getDom()->createElement("div");
    $radio_container->setAttribute("class", "simple_laraform_radio_container");
    
    $radio_input = $this->getDom()->createElement("input");
    $radio_input->setAttribute("type", "radio");
    $radio_input->setAttribute("name", $this->getName());
    $radio_input->setAttribute("value", $key);
    $radio_container->appendChild($radio_input);
    
    $text = $this->getDom()->createElement("div", $value);
    $text->setAttribute("class", "simple_laraform_radio_text");
    $radio_container->appendChild($text);
    
    $input_container->appendChild($radio_container);
  }
}
