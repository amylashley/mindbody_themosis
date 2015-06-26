jQuery(document).ready( function() {

   jQuery(".update-prod").click( function() {
      
   /* post_id = jQuery(this).attr("data-post_id")
    nonce = jQuery(this).attr("data-nonce")
    */
   var data = {
        action: 'UPDATE_PROD',
           // Whatever: '1234',
           // _ajax_nonce: '<?php echo wp_create_nonce( 'my_ajax_nonce' ); 

    };
    
    jQuery.post(ajaxurl, data, function(response) {
        alert('Got this from the server: ' + response);
    });
    
    /*  jQuery.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajaxurl,
         data : {action: "my_user_vote", post_id : post_id, nonce: nonce},
         success: function(response) {
            if(response.type == "success") {
               jQuery("#vote_counter").html(response.vote_count)
            }
            else {
               alert("Your vote could not be added")
            }
         }
      })  */ 

   })

})