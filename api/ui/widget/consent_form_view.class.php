<?php
/**
 * consent_form_view.class.php
 * 
 * @author Patrick Emond <emondpd@mcmaster.ca>
 * @package mastodon\ui
 * @filesource
 */

namespace mastodon\ui\widget;
use cenozo\lib, cenozo\log, mastodon\util;

/**
 * widget consent_form view
 * 
 * @package mastodon\ui
 */
class consent_form_view extends base_form_view
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
    parent::__construct( 'consent_form', $args );

    // add entry values
    $this->add_item( 'uid', 'CLSA ID' );
    $this->add_item( 'option_1', 'Option #1' );
    $this->add_item( 'option_2', 'Option #2' );
    $this->add_item( 'date', 'Date' );
    $this->add_item( 'note', 'Note' );
  }
}
?>
