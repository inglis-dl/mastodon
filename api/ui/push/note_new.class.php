<?php
/**
 * note_new.class.php
 * 
 * @author Patrick Emond <emondpd@mcmaster.ca>
 * @package mastodon\ui
 * @filesource
 */

namespace mastodon\ui\push;
use cenozo\lib, cenozo\log, cenozo\util;

/**
 * Extends the parent class to send machine requests.
 * @package mastodon\ui
 */
class note_new extends \cenozo\ui\push\note_new
{
  /**
   * Constructor.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @param array $args Push arguments
   * @access public
   */
  public function __construct( $args )
  {
    parent::__construct( $args );

    // only send a machine request if the participant has been synched
    if( 'participant' == $this->get_argument( 'category' ) )
    {
      $db_participant = lib::create( 'database\participant', $this->get_argument( 'category_id' ) );
      $this->set_machine_request_enabled( !is_null( $db_participant ) &&
                                          !is_null( $db_participant->sync_datetime ) );
      $this->set_machine_request_url( !is_null( $db_participant )
           ? ( 'comprehensive' == $db_participant->cohort ? BEARTOOTH_URL : SABRETOOTH_URL )
           : NULL );
    }
  }
}
?>
