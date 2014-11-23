<?php

$ds       = DIRECTORY_SEPARATOR;
$test_dir = dirname(__FILE__);
$root_dir = dirname($test_dir);
require $root_dir.$ds."vendor".$ds."autoload.php";

use SimplerPie\SimplerPie;

class SimplerPieTests extends PHPUnit_Framework_TestCase{
    
    public function testIntance(){
        
        $pie = new SimplerPie;
        $this->assertEquals(get_class($pie), "SimplerPie\SimplerPie");
        $this->assertTrue($pie instanceof SimplePie);

    }
    
    public function testItemToArray(){
        
        $pie = new SimplerPie;
        
        $pie->set_feed_url(array(
           'http://feeds.feedburner.com/meme-meme' 
        ));
        
        $pie->set_cache_location(dirname(__FILE__).DIRECTORY_SEPARATOR.'cache');
        
        $pie->init();
        
        $items = $pie->get_items();
        
        $this->assertNotEmpty($items);
        
        $item = $items[0];
        
        $this->assertInternalType('array', $item->to_array());
        
        $items = $pie->get_items_array();
        
        $this->assertInternalType('array', $items[0]);
        
        $this->assertInternalType('string', $item->to_json(), json_last_error_msg( ));
        
    }
    
}
