<?php namespace SimplerPie;

class SimplerPie_Item extends SimplePie_Item{
    
    protected static $item_keys = array();
    
    public function __toString(){
        
        return $this->to_json();
        
    }
    
    public function to_array(){
        
        $keys          = $this->get_keys();
        $item_array    = array();
        
        foreach($keys as $k){
            $item_array[$k] = $this->{"get_".$k}();
        }
        return $item_array;
    }
    
    public function to_json(){

        return json_encode($this->to_array());
        
    }
    
    public function get_keys(){
        
        if (!empty(static::$item_keys)) {
            return static::$item_keys;
        }

        $methods     = get_class_methods($this);
        $keys        = array_map(function($v){
            
            return strpos($v, "get_") === 0 ? substr($v, 0, 4) : null;
            
        }, $methods);
        
        return static::$item_keys = array_filter($keys);
        
    }
    
    
}
