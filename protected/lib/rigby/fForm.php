<?php
  
class fForm {
  
  private $id;
  private $method;
  private $action;
  private $csrf;
  private $css;
  private $children;
  
  private function __construct($id, $method, $action) {
    $this->id = $id;
    $this->method = $method;
    $this->action = $action;
    $this->children = array();
    $this->css = array('rigby-form');
    $this->csrf = fRequest::generateCSRFToken($this->action);
  }
  
  static function get($id = null, $action = SELF_URL) {
    return new fForm($id, 'get', $action);
  }
  
  static function post($id = null, $action = SELF_URL) {
    return new fForm($id, 'post', $action);
  }
  
  function add($child) {
    $this->children[] = $child;
    return $this;
  }
  
  function css($class) {
    $this->css[] = $class;
  }
  
  function render() {
    $id = ($this->id ? 'id="'. $this->id . '" ' : '');
    
    $css = ' class="' . implode(' ', $this->css) . '" ';
    
    $result = "\n\n" . '<form ' . $id . $css . 'action="' . $this->action . '" method="' . $this->method . '">' . "\n";
      $result .= "\t" . '<input type="hidden" name="rigby-csrf-token" value="' . $this->csrf . '" />' . "\n";
      foreach($this->children as $child) {
        $result .= $child . "\t<br />\n";
      }
    $result .= '</form>' . "\n\n";
    
    return $result;
  }
  
  function __toString() {
    return $this->render();
  }
  
  //Factory functions
  static function hidden($id, $value = null) {
    return new fFormInput('hidden', false, $id, $value);
  }
  
  static function password($label, $id = null, $value = null) {
    return new fFormInput('password', $label, $id, $value);
  }
  
  static function text($label, $id = null, $value = null) {
    return new fFormInput('text', $label, $id, $value);
  }
  
  static function submit($value = 'Submit') {
    return new fFormInput('submit', false, false, $value);
  }
  
}