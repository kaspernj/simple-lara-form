<?php

namespace simple_laraform\inputs;

class textarea extends BaseInput{
  function getElement(){
    $container = $this->getDom()->createElement("div");
    $container->setAttribute("class", "simple_laraform_element_container");
    
    $label = $this->getDom()->createElement("label");
    $label->setAttribute("for", $this->getID());
    
    $label_container = $this->getDom()->createElement("div");
    $label_container->setAttribute("class", "simple_laraform_label_container");
    $label_container->appendChild($label);
    
    $container->appendChild($label_container);
    
    $input = $this->getDom()->createElement("textarea", $this->getValue());
    $input->setAttribute("name", $this->getName());
    
    $container->appendChild($input);
    
    return $container;
  }
}
