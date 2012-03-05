<?php
/**
 * contact_form_download.class.php
 * 
 * @author Patrick Emond <emondpd@mcmaster.ca>
 * @package mastodon\ui
 * @filesource
 */

namespace mastodon\ui\pull;
use cenozo\lib, cenozo\log, mastodon\util;

/**
 * Contact form download data.
 * 
 * @package mastodon\ui
 */
class contact_form_download extends \cenozo\ui\pull\base_download
{
  /**
   * Constructor
   * 
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @param array $args Pull arguments.
   * @access public
   */
  public function __construct( $args )
  {
    parent::__construct( 'contact_form', $args );
    
    // determine the file to upload to the user
    $participant_class_name = lib::get_class_name( 'database\participant' );
    $db_participant = lib::create( 'database\participant', $this->get_argument( 'id' ) );
    $this->set_file_name( NULL ); // TODO: forms are now in the database
  }
}
?>
