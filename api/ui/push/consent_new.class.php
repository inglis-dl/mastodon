<?php
/**
 * consent_new.class.php
 * 
 * @author Patrick Emond <emondpd@mcmaster.ca>
 * @package mastodon\ui
 * @filesource
 */

namespace mastodon\ui\push;
use mastodon\log, mastodon\util;
use mastodon\business as bus;
use mastodon\database as db;
use mastodon\exception as exc;

/**
 * push: consent new
 *
 * Create a new consent.
 * @package mastodon\ui
 */
class consent_new extends base_new
{
  /**
   * Constructor.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @param array $args Push arguments
   * @access public
   */
  public function __construct( $args )
  {
    parent::__construct( 'consent', $args );
  }

  /**
   * Executes the push.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @access public
   */
  public function finish()
  {
    // make sure the date column isn't blank
    $columns = $this->get_argument( 'columns' );
    if( !array_key_exists( 'date', $columns ) || 0 == strlen( $columns['date'] ) )
      throw new exc\notice( 'The date cannot be left blank.', __METHOD__ );

    parent::finish();
  }
}
?>
