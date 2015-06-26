<?php
//This base class will be extended by several different kinds of data types
//This is abstract and thus should not be implemented. Just used to show structure
abstract class CustomContent {
	function get(){
		throw new Exception("Don\'t call select here! Call it from a child class", 1);
	}
        function createHtml($meta_data){
		throw new Exception("Don\'t call select here! Call it from a child class", 1);
	}
	
}
?>