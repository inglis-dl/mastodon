<?php
/**
 * site_delete_access.class.php
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
 * push: site delete_access
 * 
 * @package mastodon\ui
 */
class site_delete_access extends base_delete_record
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
          !array_key_exists( 'user.name', $noid ) ||
          !array_key_exists( 'role.name', $noid ) ||
          !array_key_exists( 'site.name', $noid ) ||
          !array_key_exists( 'site.cohort', $noid ) )
        throw new exc\argument( 'noid', $noid, __METHOD__ );

      $db_site = db\site::get_unique_record(
        array( 'name', 'cohort' ),
        array( $noid['site.name'], $noid['site.cohort'] ) );
      if( !$db_site ) throw new exc\argument( 'noid', $noid, __METHOD__ );
      $args['id'] = $db_site->id;

      // replace the arguments role, site and cohort with an access id
      $access_mod = new db\modifier();
      $access_mod->where( 'site_id', '=', $db_site->id );
      $access_mod->where( 'role.name', '=', $noid['role.name'] );
      $access_mod->where( 'user.name', '=', $noid['user.name'] );
      $db_access = current( db\access::select( $access_mod ) );
      if( !$db_access ) throw exc\argument( 'noid', $noid, __METHOD__ );
      $args['remove_id'] = $db_access->id;
    }

    parent::__construct( 'site', 'access', $args );
  }
}
?>
