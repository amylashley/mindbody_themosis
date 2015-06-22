<?php
/*This class assumes that you have a table setup with default
 * Mindbody credentials
 */
class MindBodyController extends BaseController
{
    
   
    public function add($view)
    {
        $user = MindBodyUserModel::getUserCreds();
        $sourcename = $user->source; 
        $password = $user->key; 
        $siteID = $user->siteID; 

        /*
         * We need to make sure not to do this here. We should only
         * be displaying products from the DB, not from the SOAP results
         * This code should ultimately only be in the "update products" function
         */
        // initialize default credentials
        $creds = new SourceCredentials($sourcename, $password, array($siteID));
        

        $classService = new MBSaleService(false);
        $classService->SetDefaultCredentials($creds);

        $result = $classService->GetProducts();
        // Pass data to the view.
        $view->with('result', json_encode($result, JSON_PRETTY_PRINT));
    }

    // Default method used for a view composer.
    public function compose($view)
    {
    }
    
    /*
     * This function should be used to send data to the model to 
     * update the wp_mindbodyproducts table in the DB. It may be
     * used as part of the nightly cron, or on demand via the 
     * WP admin
     */
    public function updateProducts($view){
        
        $user = MindBodyUserModel::getUserCreds();
        $sourcename = $user->source; 
        $password = $user->key; 
        $siteID = $user->siteID; 
       
         // initialize default credentials
        $creds = new SourceCredentials($sourcename, $password, array($siteID));
        
        
        //Save to DB
        $product_model = MindBodyProductModel::saveProducts($creds);
        if (!$product_model){
            $view->with('html_result', "Something went wrong. :( No updates were made.");
        }else {
            $html = '';
            $all_products = MindBodyProductModel::all();
            foreach($all_products as $product){
                $html .= "Name: ".$product->name." , ";
                $html .= "Price: ".$product->price." , ";
                $html .= "<BR>";
            }
        
            $view->with('html_result', $html);
        }
        
        
    }
}



?>