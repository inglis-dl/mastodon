#!/usr/bin/php
<?php
/**
 * This file will search through the code to find all methods which throw exceptions.
 * It uses this information to rebuild the api/exception/error_codes.inc.php file.
 */

function print_exception_block( $lists, $type )
{
  if( !array_key_exists( $type, $lists ) ) return;
  $list = $lists[$type];

  // now print out the lines
  $counter = 1;
  ksort( $list );
  foreach( $list as $class_name => $method_list )
  {
    ksort( $method_list );
    $method_list = array_unique( $method_list );
    foreach( $method_list as $method_name )
    {
      printf( "define( '%s__%s__%s__ERRNO',\n".
              "        %s_MASTODON_BASE_ERRNO + %d );\n",
              strtoupper( $type ),
              strtoupper( $class_name ),
              strtoupper( $method_name ),
              strtoupper( $type ),
              $counter++ );
    }
  }
}

// if we are in the aux/ directory then back out
if( preg_match( '#/aux$#', getcwd() ) ) chdir( '..' );

// grep for all method declarations and new exceptions in the api/ directory
$return_status = -1;
$grep_line_list = array();
exec( sprintf( 'grep -Hrn "\(%s\)\|\(%s\)" api/*',
               '^ *\(public\|private\|protected\)\( static\| final\)* function',
               "::create( 'exception" ),
      $grep_line_list,
      $return_status );

if( 0 != $return_status ) die( 'There was an error when fetching method list.' );

$error_codes = array();
$current_class_name = NULL;
$current_method_name = NULL;

foreach( $grep_line_list as $grep_line )
{
  if( preg_match( "#::create\\( 'exception#", $grep_line ) )
  { // this line is a new exception
    // make sure we have a class and method name
    if( is_null( $current_class_name ) || is_null( $current_method_name ) )
      die( 'An exception was found without knowing the '.
           'class and/or method name that it belongs to.' );

    // get the exception type
    $start_match = 'exception\\';
    $start = strpos( $grep_line, $start_match );
    if( false === $start ) continue;
    $start += strlen( $start_match );

    $end_match = "'";
    $end = strpos( $grep_line, $end_match, $start );
    
    // make sure a match was found
    if( false === $start || false === $end ) continue;
    $exception_type = substr( $grep_line, $start, $end - $start );
    
    // now add the error code
    if( !array_key_exists( $exception_type, $error_codes ) )
      $error_codes[$exception_type] = array();
    if( !array_key_exists( $current_class_name, $error_codes[$exception_type] ) )
      $error_codes[$exception_type][$current_class_name] = array();
    $error_codes[$exception_type][$current_class_name][] = $current_method_name;
  }
  else
  { // this line is a new method
    // get the class name

    // find the first / before the first :
    $colon_position = strpos( $grep_line, ':' );
    if( false === $colon_position ) continue;
    $start_match = 'api/';
    $end_match = '.class';
    $start = strpos( substr( $grep_line, 0, $colon_position ), $start_match ) +
             strlen( $start_match );
    $end = strpos( $grep_line, $end_match, $start );
    
    // make sure a match was found
    if( false === $start || false === $end ) continue;
    $class_name =
      'mastodon_'.str_replace( '/', '_', substr( $grep_line, $start, $end - $start ) );

    // get the method name
    $start_match = 'function ';
    $end_match = '(';
    $start = strpos( $grep_line, $start_match ) + strlen( $start_match );
    $end = strpos( $grep_line, $end_match, $start );

    // make sure a match was found
    if( false === $start || false === $end ) continue;
    $method_name = substr( $grep_line, $start, $end - $start );
    
    $current_class_name = $class_name;
    $current_method_name = $method_name;
  }
}

// now print out the file
print <<<OUTPUT
<?php
/**
 * error_codes.inc.php
 * 
 * This file is where all error codes are defined.
 * All error code are named after the class and function they occur in.
 */

/**
 * Error number category defines.
 */
define( 'ARGUMENT_MASTODON_BASE_ERRNO',   150000 );
define( 'DATABASE_MASTODON_BASE_ERRNO',   250000 );
define( 'LDAP_MASTODON_BASE_ERRNO',       350000 );
define( 'NOTICE_MASTODON_BASE_ERRNO',     450000 );
define( 'PERMISSION_MASTODON_BASE_ERRNO', 550000 );
define( 'RUNTIME_MASTODON_BASE_ERRNO',    650000 );
define( 'SYSTEM_MASTODON_BASE_ERRNO',     750000 );
define( 'TEMPLATE_MASTODON_BASE_ERRNO',   850000 );

/**
 * "argument" error codes
 */

OUTPUT;

// now print all argument exceptions
print_exception_block( $error_codes, 'argument' );

print <<<OUTPUT

/**
 * "database" error codes
 * 
 * Since database errors already have codes this list is likely to stay empty.
 */

/**
 * "ldap" error codes
 * 
 * Since ldap errors already have codes this list is likely to stay empty.
 */

/**
 * "notice" error codes
 */

OUTPUT;

// now print all notice exceptions
print_exception_block( $error_codes, 'notice' );

print <<<OUTPUT

/**
 * "permission" error codes
 */

OUTPUT;

// now print all permission exceptions
print_exception_block( $error_codes, 'permission' );

print <<<OUTPUT

/**
 * "runtime" error codes
 */

OUTPUT;

// now print all runtime exceptions
print_exception_block( $error_codes, 'runtime' );

print <<<OUTPUT

/**
 * "system" error codes
 * 
 * Since system errors already have codes this list is likely to stay empty.
 * Note the following PHP error codes:
 *      1: error,
 *      2: warning,
 *      4: parse,
 *      8: notice,
 *     16: core error,
 *     32: core warning,
 *     64: compile error,
 *    128: compile warning,
 *    256: user error,
 *    512: user warning,
 *   1024: user notice
 */

/**
 * "template" error codes
 * 
 * Since template errors already have codes this list is likely to stay empty.
 */

?>

OUTPUT;

?>