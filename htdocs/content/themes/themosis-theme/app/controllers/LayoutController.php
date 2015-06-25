<?php
/*This class controls the layout for the pages. Especially for those
 * using the layout editor in the admin
 */
class LayoutController extends BaseController
{
    /**
     * Does this page contain custom content?
     *
     * @var
     */
    protected $has_custom_content;
    
    /**
     * Does this page contain custom content?
     *
     * @var
     */
    protected $custom_content;
    
    
     public function __construct()
    {
        $this->has_custom_content = false; //default to false
        $this->custom_content = '';
    }
   
     /*
     * This function checks for data entered via the layout editor
      * in the admin tool. If there is data, then the view will know
      * to display the custom content blocks.
     */
    public function checkForCustomContent($post){
        
        //https://codex.wordpress.org/Function_Reference/get_post_meta
        $meta_values = Meta::get($post->ID, '_npp_custom_content_meta', false); //false so we return all meta values
        
             
        if (!empty($meta_values)){
            //foreach  npp_content_blocks do this:
            $this_content_factory = new ContentFactory();
            foreach ($meta_values[0]['npp_content_blocks'] as $this_block){
                $this_content = $this_content_factory->getContent($this_block);
                if ($this_content){
                   $this->custom_content .= $this_content;
                }
                $this->has_custom_content = TRUE;
            }
            
            
            //Should we do the processing here?
        }
        
        return View::make('templates.page')->with(array(
            'custom_content'     => $this->custom_content,
        ));
    }
    
    
    public function getCustomContent($meta_values) {
        
    }
}



?>