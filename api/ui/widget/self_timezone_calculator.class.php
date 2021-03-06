<?php
/**
 * self_timezone_calculator.class.php
 * 
 * @author Patrick Emond <emondpd@mcmaster.ca>
 * @package mastodon\ui
 * @filesource
 */

namespace mastodon\ui\widget;
use mastodon\log, mastodon\util;
use mastodon\business as bus;
use mastodon\database as db;
use mastodon\exception as exc;

/**
 * widget self timezone_calculator
 * 
 * @package mastodon\ui
 */
class self_timezone_calculator extends \mastodon\ui\widget
{
  /**
   * Constructor
   * 
   * Defines all variables which need to be set for the associated template.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @param array $args An associative array of arguments to be processed by the widget
   * @access public
   */
  public function __construct( $args )
  {
    parent::__construct( 'self', 'timezone_calculator', $args );
    $this->show_heading( false );
  }

  /**
   * Define which timezones should be included in the tool
   * 
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @access public
   */
  public function finish()
  {
    parent::finish();

    // get all timezones from the site table
    $current_timezone = bus\session::self()->get_site()->timezone;
    $datetime_obj = util::get_datetime_object();
    $timezone_list = array();
    foreach( db\site::get_enum_values( 'timezone' ) as $timezone )
    {
      $timezone_obj = new \DateTimeZone( $timezone );
      $timezone_list[ preg_replace( '/\W/', '_', $timezone ) ] = array(
        'name' => $timezone,
        'offset' => $timezone_obj->getOffset( $datetime_obj ),
        'current' => $timezone == $current_timezone );
    }

    $this->set_variable( 'timezone_list', $timezone_list );
  }
}
?>
