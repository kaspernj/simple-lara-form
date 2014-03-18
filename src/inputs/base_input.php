<?php

namespace simple_laraform\inputs;

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
}
