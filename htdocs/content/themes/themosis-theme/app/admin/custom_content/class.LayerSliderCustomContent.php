<?php
//This base class will be extended by several different kinds of data types
//This is abstract and thus should not be implemented. Just used to show structure
class LayerSliderCustomContent extends CustomContent {
	
        function createHtml($meta_data){
            $html='';
            
            
            //Does this block have a custom class assigned? 
            if ($meta_data['custom_class'] && $meta_data['custom_class']!=''){
                $html .= '<div class="'.$meta_data['custom_class'].'">';
            }
            if (isset($meta_data['container_id']) && $meta_data['container_id']!=''){
                $html .= '<div id="'.$meta_data['container_id'].'">';
            }
            if (isset($meta_data['custom_title']) && $meta_data['custom_title']!=''){
                $html .= '<h2>'.$meta_data['custom_title'].'</h2>';
            }
           // $html .= '<div class="row">';
           // $html .='<div class="col-sm-8 col-sm-offset-2">';
           try {
               if(isset($meta_data['layer_slider'])){ 
                   $html .= do_shortcode($meta_data['layer_slider']);
                   
               }  
            } catch (Exception $ex) {$html .= 'No Slider Selected';}

            $html .= '</div>'; //end container-fluid
            //Does this block have a custom class assigned? 
            if ($meta_data['custom_class'] && $meta_data['custom_class']!=''){
                $html .= '</div>'; //end custom div class
            }
            return $html;
	}
	
}
?>