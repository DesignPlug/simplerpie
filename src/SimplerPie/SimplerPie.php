<?php namespace SimplerPie;


class SimplerPie extends \SimplePie{
 
    
    public function __construct(){
        
        call_user_func_array(array('parent', '__construct'), func_get_args());
        
        $this->set_item_class('SimplerPie\SimplerPie_Item');
    }
    
    
    public function get_items_array($start = 0, $end = 0){
        
        $items       = $this->get_items($start, $end);
        
        $item_arrays = array_map(function($itm){
            
            return $itm->to_array();
            
        }, $items);
        
        return $item_arrays;
        
    }
   
    
    
}
