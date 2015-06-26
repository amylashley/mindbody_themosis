<?php



class MindBodyUserModel 
{
   
        protected static $tablename = 'mindbodyusers';
        /*
         * Get the Mindbody Account info from DB
         * if dev=true then we'll get the -99 acount info
         * otherwise we'll get the live info
         */
        public static function getUserCreds($dev=true){
            global $wpdb;
            $user = new stdClass();
            // Default values.
            $user->source = '';
            $user->key = '';
            $user->siteID = '';
            
            //TODO: add functionality to get dev vs prod.
            $table = $wpdb->prefix.self::$tablename;
            $results = $wpdb->get_results( "SELECT * FROM ". $table );
            $results = $results[0];
            $user->source = $results->source;
            $user->key = $results->key;
            $user->siteID = $results->siteID;
            
            return $user;
        }

        
	
}

?>