<?php

require dirname(__FILE__) . "/inputs/base_input.php";

use simple_laraform\inputs;

class SimpleLaraform{
  static function form_for($element, $args, $func){
    if (array_key_exists("url", $args)){
      $url = $args["url"];
    }else{
      $url = null;
    }
    
    if (is_object($element) && is_a($element)){
      $model = $element;
      $namespace = get_class($model);
      $method = "PUT";
      if (!$url) $url = SimpleLaraform::getUrlForModel($model);
    }else{
      $model = null;
      $namespace = $element;
      $method = "POST";
      if (!$url) throw new exception("No URL was given.");
    }
    
    $form = new SimpleLaraForm(array(
      "model" => $model,
      "namespace" => $namespace,
      "method" => $method,
      "url" => $url
    ));
    
    $func($form);
    
    return $form->html();
  }
  
  private static function getUrlForModel($model){
    $url = "/" . get_class($model);
    if ($model->getKey() == null) $url .= "/" . $model->getKey();
    return $url;
  }
  
  function __construct($args){
    $this->args = $args;
    if (!array_key_exists("url", $args)) throw new exception("No URL was given: " . print_r($args, true));
    
    $this->dom = new DOMDocument();
    
    $this->form = $this->dom->createElement("form");
    $this->form->setAttribute("method", $this->args["method"]);
    $this->form->setAttribute("action", $args["url"]);
    
    $this->dom->appendChild($this->form);
  }
  
  function input($name, $args = array()){
    if (array_key_exists("as", $args)){
      $as = $args["as"];
    }else{
      $as = "text";
    }
    
    if (array_key_exists("name", $args)){
      $input_name = $args["name"];
    }else{
      $input_name = $this->args["namespace"] . "[" . $name . "]";
    }
    
    if (array_key_exists("id", $args)){
      $id = $args["id"];
    }else{
      $id = $this->args["namespace"] . "_" . $name;
    }
    
    if (array_key_exists("value", $args)){
      $value = $args["value"];
    }elseif($this->args["model"]){
      $value = $this->args["model"]->$name;
    }else{
      $value = null;
    }
    
    require_once dirname(__FILE__) . "/inputs/" . $as . ".php";
    
    $class_name = "simple_laraform\\inputs\\" . $as;
    $input_object = new $class_name(array(
      "args" => $args,
      "dom" => $this->dom,
      "name" => $input_name,
      "id" => $id,
      "value" => $value
    ));
    $this->form->appendChild($input_object->getElement());
  }
  
  function submit($text = "Save"){
    $container = $this->dom->createElement("div");
    $container->setAttribute("class", "simple_laraform_submit");
    
    $this->form->appendChild($container);
    
    $input = $this->dom->createElement("input");
    $input->setAttribute("type", "submit");
    $input->setAttribute("value", $text);
    $container->appendChild($input);
  }
  
  function html(){
    return $this->dom->saveHtml();
  }
}
