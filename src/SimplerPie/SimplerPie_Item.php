<?php namespace SimplerPie;

class SimplerPie_Item extends \SimplePie_Item{
    
    protected static $item_keys         = array(),
                     $exclude_item_keys = array("get_keys", 
                                                "get_item_tags",
                                                "get_enclosure",
                                                "get_enclosures");
    
    public function __toString(){
        
        return json_encode($this->to_json());
        
    }
    
    public function to_array(){
        
        $keys          = $this->get_keys();
        $item_array    = array();
        
        foreach($keys as $k){
            $v = $this->{"get_".$k}();
            if(is_object($v)){ 
                continue;
            }
            $item_array[$k] = $v;
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
            
            return strpos($v, "get_") === 0 && !in_array($v, static::$exclude_item_keys) ? substr($v, 4, strlen($v)) : null;
            
        }, $methods);
        
        return static::$item_keys = array_filter($keys);
        
    }
    
    
}
