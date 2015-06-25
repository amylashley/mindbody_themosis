<?php
/*This class controls the layout for the pages. Especially for those
 * using the layout editor in the admin
 */
class CustomContentController extends BaseController
{
    /**
     * type of custom content
     *
     * @var
     */
    protected $content_type;
    

    
     public function __construct()
    {
        $this->has_custom_content = false; //default to false
    }
   
     /*
     * This function checks for data entered via the layout editor
      * in the admin tool. If there is data, then the view will know
      * to display the custom content blocks.
     */
    public function checkForCustomContent($post){
        
        //https://codex.wordpress.org/Function_Reference/get_post_meta
        $meta_values = Meta::get($post->ID, '_npp_custom_content_meta', false); //false so we return all meta values
        
        $this_content_factory = new ContentFactory();
       // echo ($this_content_factory->getContent(7)); die();
        
        //var_dump($meta_values); die();
        
        if (!empty($meta_values)){
            $this->has_custom_content = TRUE;
            
            //Should we do the processing here?
        }
        
        $html = "<div>CUSTOM CONTENT HERE</div>";
        return View::make('templates.page')->with(array(
            'custom_content'     => $this->has_custom_content,
        ));
    }
    
    
    public function getCustomContent($meta_values) {
        
    }
}



?>