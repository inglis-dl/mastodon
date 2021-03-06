<?php
/**
 * operator_end_break.class.php
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
 * push: operator end_break
 *
 * Start the current user on a break (away_time)
 * @package mastodon\ui
 */
class operator_end_break extends \mastodon\ui\push
{
  /**
   * Constructor.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @param array $args Push arguments
   * @access public
   */
  public function __construct( $args )
  {
    parent::__construct( 'operator', 'end_break', $args );
  }
  
  /**
   * Executes the push.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @access public
   */
  public function finish()
  {
    $db_user = bus\session::self()->get_user();

    // find this user's open break and record the end time
    $modifier = new db\modifier();
    $modifier->where( 'end_datetime', '=', NULL );
    $away_time_list = $db_user->get_away_time_list( $modifier );
    
    // report an error of there isn't exactly 1 one open away time
    if( 1 != count( $away_time_list ) )
      log::alert( sprintf(
        'When attempting to close away time, user "%s" has %d instead of 1 open away times!',
        $db_user->name,
        count( $away_time_list ) ) );
    
    foreach( $away_time_list as $db_away_time )
    {
      $date_obj = util::get_datetime_object();
      $db_away_time->end_datetime = $date_obj->format( 'Y-m-d H:i:s' );
      $db_away_time->save();
    }
  }
}
?>
