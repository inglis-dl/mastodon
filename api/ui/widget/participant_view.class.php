<?php
/**
 * participant_view.class.php
 * 
 * @author Patrick Emond <emondpd@mcmaster.ca>
 * @package mastodon\ui
 * @filesource
 */

namespace mastodon\ui\widget;
use cenozo\lib, cenozo\log, mastodon\util;

/**
 * widget participant view
 * 
 * @package mastodon\ui
 */
class participant_view extends \cenozo\ui\widget\base_view
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
    parent::__construct( 'participant', 'view', $args );
    
    // create an associative array with everything we want to display about the participant
    $this->add_item( 'active', 'boolean', 'Active' );
    $this->add_item( 'uid', 'constant', 'Unique ID' );
    $this->add_item( 'first_name', 'string', 'First Name' );
    $this->add_item( 'last_name', 'string', 'Last Name' );
    $this->add_item( 'source_id', 'enum', 'Source' );
    $this->add_item( 'cohort', 'constant', 'Cohort' );
    $this->add_item( 'default_site', 'constant', 'Default Site' );
    $this->add_item( 'site_id', 'enum', 'Prefered Site' );
    $this->add_item( 'gender', 'enum', 'Gender' );
    $this->add_item( 'date_of_birth', 'date', 'Date of Birth' );
    $this->add_item( 'language', 'enum', 'Preferred Language' );
    $this->add_item( 'email', 'string', 'Email' );
    $this->add_item( 'status', 'enum', 'Condition' );
    $this->add_item( 'eligible', 'boolean', 'Eligible' );
    $this->add_item( 'no_in_home', 'boolean', 'No in Home' );
    $this->add_item( 'prior_contact_date', 'date', 'Prior Contact Date' );

    try
    {
      // create the address sub-list widget
      $this->address_list = lib::create( 'ui\widget\address_list', $args );
      $this->address_list->set_parent( $this );
      $this->address_list->set_heading( 'Addresses' );
    }
    catch( \cenozo\exception\permission $e )
    {
      $this->address_list = NULL;
    }

    try
    {
      // create the phone sub-list widget
      $this->phone_list = lib::create( 'ui\widget\phone_list', $args );
      $this->phone_list->set_parent( $this );
      $this->phone_list->set_heading( 'Phone numbers' );
    }
    catch( \cenozo\exception\permission $e )
    {
      $this->phone_list = NULL;
    }

    try
    {
      // create the availability sub-list widget
      $this->availability_list = lib::create( 'ui\widget\availability_list', $args );
      $this->availability_list->set_parent( $this );
      $this->availability_list->set_heading( 'Availability' );
    }
    catch( \cenozo\exception\permission $e )
    {
      $this->availability_list = NULL;
    }

    try
    {
      // create the consent sub-list widget
      $this->consent_list = lib::create( 'ui\widget\consent_list', $args );
      $this->consent_list->set_parent( $this );
      $this->consent_list->set_heading( 'Consent information' );
    }
    catch( \cenzo\exception\permission $e )
    {
      $this->consent_list = NULL;
    }

    try
    {
      // create the alternate sub-list widget
      $this->alternate_list = lib::create( 'ui\widget\alternate_list', $args );
      $this->alternate_list->set_parent( $this );
      $this->alternate_list->set_heading( 'Alternate contacts' );
    }
    catch( \cenozo\exception\permission $e )
    {
      $this->alternate_list = NULL;
    }
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

    // create enum arrays
    $participant_class_name = lib::get_class_name( 'database\participant' );
    $source_class_name = lib::get_class_name( 'database\source' );
    $record = $this->get_record();

    $sites = array();
    $site_class_name = lib::get_class_name( 'database\site' );
    $site_mod = lib::create( 'database\modifier' );
    $site_mod->where( 'cohort', '=', $record->cohort );
    foreach( $site_class_name::select( $site_mod ) as $db_site )
      $sites[$db_site->id] = $db_site->name;
    $db_site = $record->get_site();
    $site_id = is_null( $db_site ) ? '' : $db_site->id;
    $sources = array();
    foreach( $source_class_name::select() as $db_source )
      $sources[$db_source->id] = $db_source->name;
    $genders = $participant_class_name::get_enum_values( 'gender' );
    $genders = array_combine( $genders, $genders );
    $languages = $participant_class_name::get_enum_values( 'language' );
    $languages = array_combine( $languages, $languages );
    $statuses = $participant_class_name::get_enum_values( 'status' );
    $statuses = array_combine( $statuses, $statuses );

    // set the view's items
    $this->set_item( 'active', $record->active, true );
    $this->set_item( 'uid', $record->uid, true );
    $this->set_item( 'first_name', $record->first_name );
    $this->set_item( 'last_name', $record->last_name );
    $this->set_item( 'source_id', $record->source_id, false, $sources );
    $this->set_item( 'cohort', $record->cohort );
    $this->set_item( 'default_site', $record->get_default_site()->name );
    $this->set_item( 'site_id', $site_id, false, $sites );
    $this->set_item( 'gender', $record->gender, true, $genders );
    $this->set_item( 'date_of_birth', $record->date_of_birth );
    $this->set_item( 'language', $record->language, false, $languages );
    $this->set_item( 'email', $record->email, false );
    $this->set_item( 'status', $record->status, false, $statuses );
    $this->set_item( 'eligible', $record->eligible, true );
    $this->set_item( 'no_in_home', $record->no_in_home, true );
    $this->set_item( 'prior_contact_date', $record->prior_contact_date, false );

    // add a contact form download action
    $db_contact_form = $record->get_contact_form();
    if( !is_null( $db_contact_form ) )
      $this->set_variable( 'contact_form_id', $db_contact_form->id );
    $this->add_action( 'contact_form', 'Contact Form', NULL,
      'Download this participant\'s contact form, if available' );

    $this->finish_setting_items();

    if( !is_null( $this->address_list ) )
    {
      $this->address_list->finish();
      $this->set_variable( 'address_list', $this->address_list->get_variables() );
    }

    if( !is_null( $this->phone_list ) )
    {
      $this->phone_list->finish();
      $this->set_variable( 'phone_list', $this->phone_list->get_variables() );
    }

    if( !is_null( $this->availability_list ) )
    {
      $this->availability_list->finish();
      $this->set_variable( 'availability_list', $this->availability_list->get_variables() );
    }

    if( !is_null( $this->consent_list ) )
    {
      $this->consent_list->finish();
      $this->set_variable( 'consent_list', $this->consent_list->get_variables() );
    }

    if( !is_null( $this->alternate_list ) )
    {
      $this->alternate_list->finish();
      $this->set_variable( 'alternate_list', $this->alternate_list->get_variables() );
    }
  }
  
  /**
   * The address list widget.
   * @var address_list
   * @access protected
   */
  protected $address_list = NULL;
  
  /**
   * The phone list widget.
   * @var phone_list
   * @access protected
   */
  protected $phone_list = NULL;
  
  /**
   * The availability list widget.
   * @var availability_list
   * @access protected
   */
  protected $availability_list = NULL;
  
  /**
   * The consent list widget.
   * @var consent_list
   * @access protected
   */
  protected $consent_list = NULL;
  
  /**
   * The alternate contact person list widget.
   * @var alternate_list
   * @access protected
   */
  protected $alternate_list = NULL;
}
?>
