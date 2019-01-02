<?php

/**
 * Utility class for sesion utilities
 *
 * THIS CLASS SHOULD NEVER BE INSTANTIATED
 */
class RFQTK_WP_Session_Utils {
	/**
	 * Count the total sessions in the database.
	 *
	 * @global wpdb $wpdb
	 *
	 * @return int
	 */
	public static function count_sessions() {
		global $wpdb;

		$query = "SELECT COUNT(*) FROM $wpdb->options WHERE option_name LIKE '_rfqtk_wp_session_expires_%'";

		/**
		 * Filter the query in case tables are non-standard.
		 *
		 * @param string $query Database count query
		 */
		$query = apply_filters( '_rfqtk_wp_session_count_query', $query );

		$sessions = $wpdb->get_var( $query );

		return absint( $sessions );
	}

	/**
	 * Create a new, random session in the database.
	 *
	 * @param null|string $date
	 */
	public static function create_dummy_session( $date = null ) {
		// Generate our date
		if ( null !== $date ) {
			$time = strtotime( $date );

			if ( false === $time ) {
				$date = null;
			} else {
				$expires = date( 'U', strtotime( $date ) );
			}
		}

		// If null was passed, or if the string parsing failed, fall back on a default
		if ( null === $date ) {
			/**
			 * Filter the expiration of the session in the database
			 *
			 * @param int
			 */
			$expires = time() + (int) apply_filters( '_rfqtk_wp_session_expiration', 30 * 60 );
		}

		$session_id = self::generate_id();

		// Store the session
		add_option( "_rfqtk_wp_session_{$session_id}", array(), '', 'no' );
		add_option( "_rfqtk_wp_session_expires_{$session_id}", $expires, '', 'no' );
	}

	/**
	 * Delete old sessions from the database.
	 *
	 * @param int $limit Maximum number of sessions to delete.
	 *
	 * @global wpdb $wpdb
	 *
	 * @return int Sessions deleted.
	 */
	public static function delete_old_sessions( $limit = 1000 ) {



	    global $wpdb;

		$limit = absint( $limit );
		$keys = $wpdb->get_results( "SELECT option_name, option_value FROM 
        $wpdb->options WHERE option_name LIKE '%_rfqtk_wp_session_expires_%' ORDER BY option_value ASC LIMIT 0, {$limit}" );
      //  write_log($keys);
		$now = time();
		$expired = array();
		$count = 0;

		foreach( $keys as $Objectkey=>$expiration ) {

           // write_log($expiration);
		    $key = $expiration->option_name;
			$expires = $expiration->option_value;

			//write_log($now.' '.$expiration->option_value);

			if ( $now > $expiration->option_value )
			{
				$session_id = str_replace("_rfqtk_wp_session_expires_", '',$expiration->option_name );

				$expired[] = $expiration->option_name;
				$expired[] = "_rfqtk_wp_session_".$session_id;

				$count += 1;
			}
		}
       // write_log($expired);
		// Delete expired sessions
		if ( isset( $expired ) ) {

		    //$placeholders = array_fill( 0, count( $expired ), '%s' );
            foreach($expired as $item) {
               // write_log("DELETE FROM options WHERE option_name = '".$item."'");
                $count = $wpdb->query( "DELETE FROM $wpdb->options WHERE option_name = '".$item."'" );
               // write_log($count );
            }
		}


	}



    public static function delete_empty_sessions( $limit = 1000 ) {
        global $wpdb;

        $limit = absint( $limit );
        $keys = $wpdb->get_results( "SELECT option_name, option_value FROM 
        $wpdb->options WHERE option_name LIKE '_rfqtk_wp_session_%' and option_value='a:0:{}' ORDER BY option_value ASC LIMIT 0, {$limit}" );
        //  write_log($keys);
        $now = time();
        $expired = array();
        $count = 0;

        foreach( $keys as $Objectkey=>$expiration ) {

            // write_log($expiration);
            $key = $expiration->option_name;
            $expires = $expiration->option_value;

            //write_log($now.' '.$expiration->option_value);

          //  if ( $now > $expiration->option_value )
            {
                $session_id = str_replace("_rfqtk_wp_session_", '',$expiration->option_name );

                $expired[] = $expiration->option_name;
                $expired[] = $session_id;

                $count += 1;
            }
        }
        // write_log($expired);
        // Delete expired sessions
       // if ( isset( $expired ) )
        {

            //$placeholders = array_fill( 0, count( $expired ), '%s' );
            foreach($expired as $item) {
                 //write_log("DELETE FROM options WHERE option_name = '".$item."'");
                $count = $wpdb->query( "DELETE FROM $wpdb->options WHERE option_name like '%".$item."%'" );
                // write_log($count );
            }
        }


    }



	/**
	 * Remove all sessions from the database, regardless of expiration.
	 *
	 * @global wpdb $wpdb
	 *
	 * @return int Sessions deleted
	 */
	public static function delete_all_sessions() {
		global $wpdb;

		$count = $wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE '_rfqtk_wp_session_%'" );
       // write_log($count);
		return (int) ( $count );
	}

	/**
	 * Generate a new, random session ID.
	 *
	 * @return string
	 */
	public static function generate_id() {
		require_once( ABSPATH . 'wp-includes/class-phpass.php' );
		$hash = new \PasswordHash( 8, false );
//echo md5( $hash->get_random_bytes( 32 ) );
		return md5( $hash->get_random_bytes( 32 ) );
	}

}