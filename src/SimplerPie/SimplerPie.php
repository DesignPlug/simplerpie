<?php namespace SimplerPie;


class SimplerPie extends \SimplePie{


    /**
     * Set which class SimplePie uses for handling feed items
     */
    
    public function set_item_class($class = 'SimplerPie\SimplerPie_Item')
    {
        return $this->registry->register('Item', $class, true);
    }    
    
    
    public function get_items_array($start = 0, $end = 0){
        
        $items       = $this->get_items($start, $end);
        
        $item_arrays = array_map(function($itm){
            
            return $itm->to_array();
            
        }, $items);
        
        return $item_arrays;
        
    }
   
    
    
}
