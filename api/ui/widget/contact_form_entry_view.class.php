<?php
/**
 * contact_form_entry_view.class.php
 * 
 * @author Patrick Emond <emondpd@mcmaster.ca>
 * @package mastodon\ui
 * @filesource
 */

namespace mastodon\ui\widget;
use cenozo\lib, cenozo\log, mastodon\util;

/**
 * widget contact_form_entry view
 * 
 * @package mastodon\ui
 */
class contact_form_entry_view extends base_form_entry_view
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
    parent::__construct( 'contact', $args );

    // add the entry values
    $this->add_item( 'first_name', 'string', 'First Name' );
    $this->add_item( 'last_name', 'string', 'Last Name' );
    $this->add_item( 'apartment_number', 'string', 'Apartment #' );
    $this->add_item( 'street_number', 'string', 'Street #' );
    $this->add_item( 'street_name', 'string', 'Street Name' );
    $this->add_item( 'box', 'string', 'Post Office Box #' );
    $this->add_item( 'rural_route', 'string', 'Rural Route #' );
    $this->add_item( 'address_other', 'string', 'Other Address' );
    $this->add_item( 'city', 'string', 'City' );
    $this->add_item( 'region_id', 'enum', 'Province' );
    $this->add_item( 'postcode', 'string', 'Postal Code' );
    $this->add_item( 'address_note', 'text', 'Address Note' );
    $this->add_item( 'home_phone', 'string', 'Home Phone' );
    $this->add_item( 'home_phone_note', 'text', 'Home Phone Note' );
    $this->add_item( 'mobile_phone', 'string', 'Mobile Phone' );
    $this->add_item( 'mobile_phone_note', 'text', 'Home Mobile Note' );
    $this->add_item( 'phone_preference', 'enum', 'Phone Preference' );
    $this->add_item( 'email', 'string', 'Email Address' );
    $this->add_item( 'gender', 'enum', 'Sex' );
    $this->add_item( 'age_bracket', 'enum', 'Age Bracket' );
    $this->add_item( 'monday', 'boolean', 'Monday' );
    $this->add_item( 'tuesday', 'boolean', 'Tuesday' );
    $this->add_item( 'wednesday', 'boolean', 'Wednesday' );
    $this->add_item( 'thursday', 'boolean', 'Thursday' );
    $this->add_item( 'friday', 'boolean', 'Friday' );
    $this->add_item( 'saturday', 'boolean', 'Saturday' );
    $this->add_item( 'time_9_10', 'boolean', '9am to 10am' );
    $this->add_item( 'time_10_11', 'boolean', '10am to 11am' );
    $this->add_item( 'time_11_12', 'boolean', '11am to 12pm' );
    $this->add_item( 'time_12_13', 'boolean', '12pm to 1pm' );
    $this->add_item( 'time_13_14', 'boolean', '1pm to 2pm' );
    $this->add_item( 'time_14_15', 'boolean', '2pm to 3pm' );
    $this->add_item( 'time_15_16', 'boolean', '3pm to 4pm' );
    $this->add_item( 'time_16_17', 'boolean', '4pm to 5pm' );
    $this->add_item( 'time_17_18', 'boolean', '5pm to 6pm' );
    $this->add_item( 'time_18_19', 'boolean', '6pm to 7pm' );
    $this->add_item( 'time_19_20', 'boolean', '7pm to 8pm' );
    $this->add_item( 'time_20_21', 'boolean', '8pm to 9pm' );
    $this->add_item( 'language', 'enum', 'Language' );
    $this->add_item( 'date', 'date', 'Date Signed' );
    $this->add_item( 'cohort', 'enum', 'Cohort' );
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

    $region_class_name = lib::get_class_name( 'database\region' );
    $contact_form_entry_class_name = lib::get_class_name( 'database\contact_form_entry' );

    // create enum arrays
    $region_mod = lib::create( 'database\modifier' );
    $region_mod->where( 'country', '=', 'Canada' );
    $region_list = array();
    foreach( $region_class_name::select( $region_mod ) as $db_region )
      $region_list[$db_region->id] = $db_region->name.', '.$db_region->country;
    $phone_preference_list = $contact_form_entry_class_name::get_enum_values( 'phone_preference' );
    $phone_preference_list = array_combine( $phone_preference_list, $phone_preference_list );
    $gender_list = $contact_form_entry_class_name::get_enum_values( 'gender' );
    $gender_list = array_combine( $gender_list, $gender_list );
    $age_bracket_list = $contact_form_entry_class_name::get_enum_values( 'age_bracket' );
    $age_bracket_list = array_combine( $age_bracket_list, $age_bracket_list );
    $language_list = $contact_form_entry_class_name::get_enum_values( 'language' );
    $language_list = array_combine( $language_list, $language_list );
    $cohort_list = $contact_form_entry_class_name::get_enum_values( 'cohort' );
    $cohort_list = array_combine( $cohort_list, $cohort_list );

    // set the entry values
    $this->set_item( 'first_name', $this->get_record()->first_name, false );
    $this->set_item( 'last_name', $this->get_record()->last_name, false );
    $this->set_item( 'apartment_number', $this->get_record()->apartment_number, false );
    $this->set_item( 'street_number', $this->get_record()->street_number, false );
    $this->set_item( 'street_name', $this->get_record()->street_name, false );
    $this->set_item( 'box', $this->get_record()->box, false );
    $this->set_item( 'rural_route', $this->get_record()->rural_route, false );
    $this->set_item( 'address_other', $this->get_record()->address_other, false );
    $this->set_item( 'city', $this->get_record()->city, false );
    $this->set_item( 'region_id', $this->get_record()->region_id, false, $region_list );
    $this->set_item( 'postcode', $this->get_record()->postcode, false );
    $this->set_item( 'home_phone', $this->get_record()->home_phone, false );
    $this->set_item( 'mobile_phone', $this->get_record()->mobile_phone, false );
    $this->set_item(
      'phone_preference', $this->get_record()->phone_preference, true, $phone_preference_list );
    $this->set_item( 'email', $this->get_record()->email, false );
    $this->set_item( 'gender', $this->get_record()->gender, false, $gender_list );
    $this->set_item( 'age_bracket', $this->get_record()->age_bracket, false, $age_bracket_list );
    $this->set_item( 'monday', $this->get_record()->monday, true );
    $this->set_item( 'tuesday', $this->get_record()->tuesday, true );
    $this->set_item( 'wednesday', $this->get_record()->wednesday, true );
    $this->set_item( 'thursday', $this->get_record()->thursday, true );
    $this->set_item( 'friday', $this->get_record()->friday, true );
    $this->set_item( 'saturday', $this->get_record()->saturday, true );
    $this->set_item( 'time_9_10', $this->get_record()->time_9_10, true );
    $this->set_item( 'time_10_11', $this->get_record()->time_10_11, true );
    $this->set_item( 'time_11_12', $this->get_record()->time_11_12, true );
    $this->set_item( 'time_12_13', $this->get_record()->time_12_13, true );
    $this->set_item( 'time_13_14', $this->get_record()->time_13_14, true );
    $this->set_item( 'time_14_15', $this->get_record()->time_14_15, true );
    $this->set_item( 'time_15_16', $this->get_record()->time_15_16, true );
    $this->set_item( 'time_16_17', $this->get_record()->time_16_17, true );
    $this->set_item( 'time_17_18', $this->get_record()->time_17_18, true );
    $this->set_item( 'time_18_19', $this->get_record()->time_18_19, true );
    $this->set_item( 'time_19_20', $this->get_record()->time_19_20, true );
    $this->set_item( 'time_20_21', $this->get_record()->time_20_21, true );
    $this->set_item( 'language', $this->get_record()->language, true, $language_list );
    $this->set_item( 'date', $this->get_record()->date, false );
    $this->set_item( 'cohort', $this->get_record()->cohort, false, $cohort_list );
    $this->set_item( 'note', $this->get_record()->note, false );

    $this->finish_setting_items();
  }
}
?>
