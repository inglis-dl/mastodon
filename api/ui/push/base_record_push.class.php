<?php
/**
 * base_record_push.class.php
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
 * Base class for all push operations pertaining to a single record.
 * 
 * @package mastodon\ui
 */
abstract class base_record_push
  extends \mastodon\ui\push
  implements \mastodon\ui\contains_record
{
  /**
   * Constructor.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @param string $subject The widget's subject.
   * @param string $name The widget's name.
   * @param array $args Push arguments
   * @access public
   */
  public function __construct( $subject, $name, $args )
  {
    parent::__construct( $subject, $name, $args );
    $class_name = '\\mastodon\\database\\'.$this->get_subject();
    $this->set_record( new $class_name( $this->get_argument( 'id', NULL ) ) );
  }
  
  /**
   * Method required by the contains_record interface.
   * @author Patrick Emond
   * @return database\record
   * @access public
   */
  public function get_record()
  {
    return $this->record;
  }

  /**
   * Method required by the contains_record interface.
   * @author Patrick Emond
   * @param database\record $record
   * @access public
   */
  public function set_record( $record )
  {
    $this->record = $record;
  }

  /**
   * The record of the item being created.
   * @var record
   * @access private
   */
  private $record = NULL;
}
?>
