<?php
/**
 * user_delete.class.php
 * 
 * @author Patrick Emond <emondpd@mcmaster.ca>
 * @package mastodon\ui
 * @filesource
 */

namespace mastodon\ui\push;
use cenozo\lib, cenozo\log, mastodon\util;

/**
 * push: user delete
 * 
 * @package mastodon\ui
 */
class user_delete extends \cenozo\ui\push\user_delete
{
  /**
   * Constructor.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @param array $args Push arguments
   * @access public
   */
  public function __construct( $args )
  {
    if( array_key_exists( 'noid', $args ) )
    {
      // use the noid argument and remove it from the args input
      $noid = $args['noid'];
      unset( $args['noid'] );

      // make sure there is sufficient information
      if( !is_array( $noid ) ||
          !array_key_exists( 'user.name', $noid ) )
        throw lib::create( 'exception\argument', 'noid', $noid, __METHOD__ );

      $db_user = db\user::get_unique_record( 'name', $noid['user.name'] );
      if( !$db_user ) throw lib::create( 'exception\argument', 'noid', $noid, __METHOD__ );
      $args['id'] = $db_user->id;
    }

    parent::__construct( $args );
  }
}
?>
