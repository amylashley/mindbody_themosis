<?php

/*
 * This class is going to need to be replaced by our Mindbody API stuff
 */
class Mindbody {

	private static $initiated = false;
	
	
	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}

	/**
	 * Initializes WordPress hooks
	 */
	private static function init_hooks() {
                self::$initiated = true;

		
	}
        
        public static function view( $name, array $args = array() ) {
		$args = apply_filters( 'mindbody_view_arguments', $args, $name );
		
		foreach ( $args AS $key => $val ) {
			$$key = $val;
		}
		
		load_plugin_textdomain( 'mindbody' );

		$file = MB_PRODUCTS__PLUGIN_DIR . 'views/'. $name . '.php';

		include( $file );
	}
  
        
        /*
         * We need to create an external lookup table if it doesn't already exist
         */
        public static function create_lookup() {
            global $wpdb;
            $table_name = "mindbody_lookup";
            if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
                $charset_collate = $wpdb->get_charset_collate();
                $table_name = $wpdb->prefix . $table_name;
                $sql = "CREATE TABLE $table_name (
                id mediumint(9) NOT NULL,
                post_id mediumint(9)NOT NULL
                ) $charset_collate;";
                require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                dbDelta( $sql );
            }
        }
	
	public static function cron_recheck() {
		/*global $wpdb;

		$api_key = self::get_api_key();

		$status = self::verify_key( $api_key );
		if ( get_option( 'akismet_alert_code' ) || $status == 'invalid' ) {
			// since there is currently a problem with the key, reschedule a check for 6 hours hence
			wp_schedule_single_event( time() + 21600, 'akismet_schedule_cron_recheck' );
			do_action( 'akismet_scheduled_recheck', 'key-problem-' . get_option( 'akismet_alert_code' ) . '-' . $status );
			return false;
		}

		delete_option('akismet_available_servers');

		$comment_errors = $wpdb->get_col( "SELECT comment_id FROM {$wpdb->commentmeta} WHERE meta_key = 'akismet_error'	LIMIT 100" );
		
		load_plugin_textdomain( 'akismet' );

		foreach ( (array) $comment_errors as $comment_id ) {
			// if the comment no longer exists, or is too old, remove the meta entry from the queue to avoid getting stuck
			$comment = get_comment( $comment_id );
			if ( !$comment || strtotime( $comment->comment_date_gmt ) < strtotime( "-15 days" ) ) {
				delete_comment_meta( $comment_id, 'akismet_error' );
				delete_comment_meta( $comment_id, 'akismet_delayed_moderation_email' );
				continue;
			}

			add_comment_meta( $comment_id, 'akismet_rechecking', true );
			$status = self::check_db_comment( $comment_id, 'retry' );

			$msg = '';
			if ( $status == 'true' ) {
				$msg = __( 'Akismet caught this comment as spam during an automatic retry.' , 'akismet');
			} elseif ( $status == 'false' ) {
				$msg = __( 'Akismet cleared this comment during an automatic retry.' , 'akismet');
			}

			// If we got back a legit response then update the comment history
			// other wise just bail now and try again later.  No point in
			// re-trying all the comments once we hit one failure.
			if ( !empty( $msg ) ) {
				delete_comment_meta( $comment_id, 'akismet_error' );
				self::update_comment_history( $comment_id, $msg, 'cron-retry' );
				update_comment_meta( $comment_id, 'akismet_result', $status );
				// make sure the comment status is still pending.  if it isn't, that means the user has already moved it elsewhere.
				$comment = get_comment( $comment_id );
				if ( $comment && 'unapproved' == wp_get_comment_status( $comment_id ) ) {
					if ( $status == 'true' ) {
						wp_spam_comment( $comment_id );
					} elseif ( $status == 'false' ) {
						// comment is good, but it's still in the pending queue.  depending on the moderation settings
						// we may need to change it to approved.
						if ( check_comment($comment->comment_author, $comment->comment_author_email, $comment->comment_author_url, $comment->comment_content, $comment->comment_author_IP, $comment->comment_agent, $comment->comment_type) )
							wp_set_comment_status( $comment_id, 1 );
						else if ( get_comment_meta( $comment_id, 'akismet_delayed_moderation_email', true ) )
							wp_notify_moderator( $comment_id );
					}
				}
				
				delete_comment_meta( $comment_id, 'akismet_delayed_moderation_email' );
			} else {
				// If this comment has been pending moderation for longer than MAX_DELAY_BEFORE_MODERATION_EMAIL,
				// send a moderation email now.
				if ( ( intval( gmdate( 'U' ) ) - strtotime( $comment->comment_date_gmt ) ) < self::MAX_DELAY_BEFORE_MODERATION_EMAIL ) {
					delete_comment_meta( $comment_id, 'akismet_delayed_moderation_email' );
					wp_notify_moderator( $comment_id );
				}

				delete_comment_meta( $comment_id, 'akismet_rechecking' );
				wp_schedule_single_event( time() + 1200, 'akismet_schedule_cron_recheck' );
				do_action( 'akismet_scheduled_recheck', 'check-db-comment-' . $status );
				return;
			}
			delete_comment_meta( $comment_id, 'akismet_rechecking' );
		}

		$remaining = $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->commentmeta} WHERE meta_key = 'akismet_error'" );
		if ( $remaining && !wp_next_scheduled('akismet_schedule_cron_recheck') ) {
			wp_schedule_single_event( time() + 1200, 'akismet_schedule_cron_recheck' );
			do_action( 'akismet_scheduled_recheck', 'remaining' );
		}
                 * 
                 */
	}

	public static function fix_scheduled_recheck() {
		/*$future_check = wp_next_scheduled( 'akismet_schedule_cron_recheck' );
		if ( !$future_check ) {
			return;
		}

		if ( get_option( 'akismet_alert_code' ) > 0 ) {
			return;
		}

		$check_range = time() + 1200;
		if ( $future_check > $check_range ) {
			wp_clear_scheduled_hook( 'akismet_schedule_cron_recheck' );
			wp_schedule_single_event( time() + 300, 'akismet_schedule_cron_recheck' );
			do_action( 'akismet_scheduled_recheck', 'fix-scheduled-recheck' );
		}
                 * 
                 */
	}

	

	/**
	 * Attached to activate_{ plugin_basename( __FILES__ ) } by register_activation_hook()
	 * @static
	 */
	public static function plugin_activation() {
		/*if ( version_compare( $GLOBALS['wp_version'], AKISMET__MINIMUM_WP_VERSION, '<' ) ) {
			load_plugin_textdomain( 'akismet' );
			
			$message = '<strong>'.sprintf(esc_html__( 'Akismet %s requires WordPress %s or higher.' , 'akismet'), AKISMET_VERSION, AKISMET__MINIMUM_WP_VERSION ).'</strong> '.sprintf(__('Please <a href="%1$s">upgrade WordPress</a> to a current version, or <a href="%2$s">downgrade to version 2.4 of the Akismet plugin</a>.', 'akismet'), 'https://codex.wordpress.org/Upgrading_WordPress', 'http://wordpress.org/extend/plugins/akismet/download/');

			Akismet::bail_on_activation( $message );
		}*/
	}

	/**
	 * Removes all connection options
	 * @static
	 */
	public static function plugin_deactivation( ) {
		//tidy up
	}
	
	

	/**
	 * Log debugging info to the error log.
	 *
	 * Enabled when WP_DEBUG_LOG is enabled, but can be disabled via the akismet_debug_log filter.
	 *
	 * @param mixed $mindbody_debug The data to log.
	 */
	public static function log( $mindbody_debug ) {
		if ( apply_filters( 'mindbody_debug_log', defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG ) ) {
			error_log( print_r( compact( 'mindbody_debug' ), true ) );
		}
	}

	
}