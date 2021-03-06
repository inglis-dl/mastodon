<?php
/**
 * phone_add.class.php
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
 * widget phone add
 * 
 * @package mastodon\ui
 */
class phone_add extends base_view
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
    parent::__construct( 'phone', 'add', $args );
    
    // add items to the view
    $this->add_item( 'person_id', 'hidden' );
    $this->add_item( 'address_id', 'enum', 'Associated address' );
    $this->add_item( 'active', 'boolean', 'Active' );
    $this->add_item( 'rank', 'enum', 'Rank' );
    $this->add_item( 'type', 'enum', 'Type' );
    $this->add_item( 'number', 'string', 'Phone' );
    $this->add_item( 'note', 'text', 'Note' );
  }

  /**
   * Finish setting the variables in a widget.
   * 
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @access public
   */
  public function finish()
  {
    parent::finish();
    
    // this widget must have a parent, and it's subject must be a participant
    $subject = $this->parent->get_subject();
    if( is_null( $this->parent ) || ( 'participant' != $subject && 'alternate' != $subject ) )
      throw new exc\runtime(
        'Phone widget must have a parent with participant or alternate as the subject.',
        __METHOD__ );

    // create enum arrays
    $modifier = new db\modifier();
    $modifier->where( 'person_id', '=', $this->parent->get_record()->get_person()->id ); 
    $modifier->order( 'rank' );
    $addresses = array();
    foreach( db\address::select( $modifier ) as $db_address )
    {
      $db_region = $db_address->get_region();
      $addresses[$db_address->id] = sprintf( '%d. %s, %s, %s',
        $db_address->rank,
        $db_address->city,
        $db_region->name,
        $db_region->country );
    }
    $num_phones = $this->parent->get_record()->get_phone_count();
    $ranks = array();
    for( $rank = 1; $rank <= ( $num_phones + 1 ); $rank++ ) $ranks[] = $rank;
    $ranks = array_combine( $ranks, $ranks );
    end( $ranks );
    $last_rank_key = key( $ranks );
    reset( $ranks );
    $types = db\phone::get_enum_values( 'type' );
    $types = array_combine( $types, $types );

    // set the view's items
    $this->set_item( 'person_id', $this->parent->get_record()->get_person()->id );
    $this->set_item( 'address_id', '', false, $addresses );
    $this->set_item( 'active', true, true );
    $this->set_item( 'rank', $last_rank_key, true, $ranks );
    $this->set_item( 'type', key( $types ), true, $types );
    $this->set_item( 'number', '', true );
    $this->set_item( 'note', '' );

    $this->finish_setting_items();
  }
}
?>
