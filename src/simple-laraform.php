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
    
    ob_start();
    $func($form);
    $html = ob_get_contents();
    ob_end_clean();
    
    $html_form = $form->getForm()["dom"]->saveHtml();
    $total_html = str_replace("</form>", ($html . "</form>"), $html_form);
    
    return $total_html;
  }
  
  private static function getUrlForModel($model){
    $url = "/" . get_class($model);
    if ($model->getKey() == null) $url .= "/" . $model->getKey();
    return $url;
  }
  
  function __construct($args){
    $this->args = $args;
    if (!array_key_exists("url", $args)) throw new exception("No URL was given: " . print_r($args, true));
  }
  
  function getForm(){
    $dom = new DOMDocument();
    $form = $dom->createElement("form");
    $form->setAttribute("method", $this->args["method"]);
    $form->setAttribute("action", $this->args["url"]);
    $dom->appendChild($form);
    
    return array(
      "dom" => $dom,
      "form" => $form
    );
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
    
    $input_path = dirname(__FILE__) . "/inputs/" . $as . ".php";
    if (file_exists($input_path)) require_once $input_path;
    
    $dom = new DOMDocument();
    
    $class_name = "simple_laraform\\inputs\\" . $as;
    $input_object = new $class_name(array(
      "args" => $args,
      "dom" => $dom,
      "name" => $input_name,
      "id" => $id,
      "value" => $value
    ));
    $element = $input_object->getElement();
    if (!is_a($element, "DOMNode")) throw new exception("Returned element of '" . $as . "' was not a DOMNode.");
    
    $dom->appendChild($element);
    return $dom->saveHtml();
  }
  
  function submit($text = "Save"){
    $dom = new DOMDocument();
    
    $container = $dom->createElement("div");
    $container->setAttribute("class", "simple_laraform_submit");
    $dom->appendChild($container);
    
    $input = $dom->createElement("input");
    $input->setAttribute("type", "submit");
    $input->setAttribute("value", $text);
    $container->appendChild($input);
    
    return $dom->saveHtml();
  }
}
