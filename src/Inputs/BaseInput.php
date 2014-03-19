<?php

namespace SimpleLaraForm\Inputs;

class BaseInput{
  private $args;
  private $dom;
  
  function __construct($args){
    if (!array_key_exists("args", $args)) throw new exception("No arguments was given.");
    if (!array_key_exists("dom", $args)) throw new exception("No DOM was given.");
    $this->args = $args;
  }
  
  function getArgs(){ return $this->args["args"]; }
  function getDOM(){ return $this->args["dom"]; }
  function getName(){ return $this->args["name"]; }
  function getID(){ return $this->args["id"]; }
  function getValue(){ return $this->args["value"]; }
  
  function containerWithLabel(){
    $container = $this->getDom()->createElement("div");
    $container->setAttribute("class", "simple_laraform_element_container");
    
    $label = $this->getDom()->createElement("label");
    $label->setAttribute("for", $this->getID());
    
    $label_container = $this->getDom()->createElement("div");
    $label_container->setAttribute("class", "simple_laraform_label_container");
    $label_container->appendChild($label);
    
    $container->appendChild($label_container);
    
    $input_container = $this->getDom()->createElement("div");
    $input_container->setAttribute("class", "simple_laraform_input_container");
    $container->appendChild($input_container);
    
    return array(
      "container" => $container,
      "input_container" => $input_container
    );
  }
}
