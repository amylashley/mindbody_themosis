<?php

/*
 * You shouldn't be able to create an instance of a ContentFactory object.
 * It is simply used to route requests to the appropriate type of data
 */
class ContentFactory {
    
     public function __construct()
    {
        
    }
	
    public function getContent($meta_values){  
        $content_value = $meta_values['r_ex2'];
        switch (intval($content_value)) {
            case 1:      //single column			
                $this_content = new SingleColCustomContent();
                return $this_content->createHtml($meta_values);      				
                break;
            case 2:      //two columns     
              $this_content = new TwoColCustomContent();
              return $this_content->createHtml($meta_values);       
              break;    
            case 3:     //three columns    
              $this_content = new ThreeColCustomContent();
              return $this_content->createHtml($meta_values);             
              break;
            case 4:                       
                $this_content = new FourColCustomContent();
                return $this_content->createHtml($meta_values);             
              break;
            case 5:           
              //$this_text = new ImplementationStep();
              //return $this_text->get($plan, $step_name,$user);             
              break;
            case 6:           
              $this_content = new PageLinksCustomContent();
              return $this_content->createHtml($meta_values);             
              break;
            case 7:     //related content     
                $this_content = new RecentPromotionsCustomContent();
                return $this_content->createHtml($meta_values);
              break;
            case 8:
                $this_content = new LayerSliderCustomContent();
                return $this_content->createHtml($meta_values);
            break;
            case 9:
                $this_content = new IconDefinitionsCustomContent();
                return $this_content->createHtml($meta_values);
            break;
            case 10:
                $this_content = new TestimonialCustomContent();
                return $this_content->createHtml($meta_values);
            break;
            case 11:
                $this_content = new ProductLinksCustomContent();
                return $this_content->createHtml($meta_values);
            break;
            case 12:
                $this_content = new SinglePromotionCustomContent();
                return $this_content->createHtml($meta_values);
            break;
            default:
                    return false;
                    break;
      		}
    }
	
}
