<?php
/**
 * quota.class.php
 * 
 * @author Patrick Emond <emondpd@mcmaster.ca>
 * @filequota
 */

namespace mastodon\database;
use cenozo\lib, cenozo\log, mastodon\util;

/**
 * quota: record
 */
class quota extends \cenozo\database\quota
{
  /**
   * Call parent method without restricting records by service.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @param database\modifier $modifier Modifications to the selection.
   * @param boolean $count If true the total number of records instead of a list
   * @param boolean $distinct Whether to use the DISTINCT sql keyword
   * @param boolean $full Do not use, parameter ignored.
   * @access public
   * @static
   */
  public static function select( $modifier = NULL, $count = false, $distinct = true, $full = false )
  {
    return parent::select( $modifier, $count, $distinct, true );
  }
}
