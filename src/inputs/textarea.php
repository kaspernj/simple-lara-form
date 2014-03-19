<?php

namespace simple_laraform\inputs;

class textarea extends BaseInput{
  function getElement(){
    $data = $this->containerWithLabel();
    $input = $this->getDom()->createElement("textarea", $this->getValue());
    $input->setAttribute("name", $this->getName());
    $data["input_container"]->appendChild($input);
    return $data["container"];
  }
}
