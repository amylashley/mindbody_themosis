<?php
class MindBodyProductModel 
{
  
   protected static $tablename = "mindbodyproducts";
        
        /*
         * TODO: Implement
         */
        public static function getProductById($dev=true){
           
        }
        
        /**
	 * Return all books.
	 * 
	 * @return \WP_Query
	*/
	public static function all()
	{
            global $wpdb;
	    $table = $table = $wpdb->prefix.self::$tablename;
            $results = $wpdb->get_results( "SELECT * FROM ". $table );
            return $results;
	}
        
        /*
         * This function will loop through an array of products and then 
         * call insert on each one
         * 
         */
        public static function saveProducts($creds = false){
            $classService = new MBSaleService(false);
            $classService->SetDefaultCredentials($creds);

            $result = $classService->GetProducts();
            $products = toArray($result->GetProductsResult->Products->Product);
            
            if ($products){
                foreach($products as $product){
                    $tmp_arr = array("price" => $product->Price,
                                     "tax_rate" => $product->TaxRate,
                                     "ID" => $product->ID,
                                     "group_id" => $product->GroupID,
                                     "name" => $product->Name,
                                     "online_price" => $product->OnlinePrice,
                                    // "short_desc" => $product->ShortDesc,
                                     //"long_desc" => $product->LongDesc,
                                     "color" => json_encode($product->Color),
                                     "size" => json_encode($product->Size),
                    ); //end tmp_arr
                    self::replace($tmp_arr);
                }
                return true;
            }
            return false;
        }
        
        
        /*
         * This function will insert new rows or update on duplicate
         */
        private static function replace($product = false){
            global $wpdb;
            $table = $wpdb->prefix.self::$tablename;
            
            /*
             * TODO: how do we properly PREPARE this statement?
             */
            if ($product){
                try {
                    $wpdb->replace( $table, $product);
                } catch (Exception $ex) {
                    die($ex);
                }
                return true;
            }
            return false;
        }

        
        
	
}

?>