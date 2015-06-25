<?php
//This base class will be extended by several different kinds of data types
//This is abstract and thus should not be implemented. Just used to show structure
class SingleColCustomContent extends CustomContent {
	
        function createHtml($meta_data){
            $html='';
            //Does this block have a custom class assigned? 
            if (isset($meta_data['custom_class']) && $meta_data['custom_class']!=''){
                $html .= '<div class="'.$meta_data['custom_class'].'">';
            }
            
            if (isset($meta_data['container_id']) && $meta_data['container_id']!= ''){
                $html .= '<div id="'.$meta_data['container_id'].'" class="container-fluid">';
            }else {
                 $html .= '<div class="container-fluid">';
            }
            $html .= '<div class="row">';
            $html .= '<div class="col-sm-10 col-sm-offset-1">';
            $html .= $meta_data['textarea-0'];
            $html .= '</div>'; //end col-sm-10
            $html .= '</div>'; //end row
            $html .= '</div>'; //end container-fluid
            //Does this block have a custom class assigned? 
            if (isset($meta_data['custom_class']) && $meta_data['custom_class']!=''){
                $html .= '</div>'; //end custom div class
            }
            return $html;
	}
	
}
?>