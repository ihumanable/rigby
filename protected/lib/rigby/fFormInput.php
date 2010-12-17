<?php

class fFormInput {
  
  private $type;
  private $label;
  private $id;
  private $value;
  private $attributes;
  
  function __construct($type, $label, $id = null, $value = null) {
    $this->type = $type;
    $this->label = $label;
    $this->id = ($id ? $id : str_replace('_', '-', fGrammar::underscorize($label)));
    $this->value = fValues::get($this->id, $value);
    $this->attributes = array();
  }
  
  function __call($attribute, $value) {
    if(count($value) == 0) {
      //Get an attribute
      if(array_key_exists($attribute, $this->attributes)) {
        return $this->attributes[$attribute];
      } else {
        return null;
      }
    } else if(count($value) == 1) {
      $this->attributes[$attribute] = $value[0];
      return $this;
    } else {
      throw new fProgrammerException('Attribute call must be get or set');
    }
  }
  
  function clear() {
    $this->value = null;
    return $this;
  }
  
  function render() {
    $result = "\t" . '<label for="' . $this->id . '">' . ($this->label ? $this->label : '&nbsp;') . '</label>' . "\n";
    
    $attributes = array();
    foreach($this->attributes as $key => $value) {
      $attributes[] = "$key=\"$value\"";
    }
    $attributes = implode(' ', $attributes) . ' ';
    
    $id = ($this->id ? ' id="' . $this->id . '" name="' . $this->id . '" ' : '');
    $value = ($this->value !== null ? ' value="' . $this->value . '" ' : '');
    
    $result .= "\t" . '<input type="' . $this->type . '"' . $id . $value . $attributes . '/>' . "\n";
    
    if($this->id) {
      $error = fErrors::get($this->id);
      if($error) {
        $result .= "\t" . '<span class="rigby-form-error">' . $error . '</span>' . "\n";
      }
    }
    
    return $result;
  }
  
  function __toString() {
    return $this->render();
  }
}