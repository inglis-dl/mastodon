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
define( 'ARGUMENT_MASTODON_BASE_ERRNO',   140000 );
define( 'DATABASE_MASTODON_BASE_ERRNO',   240000 );
define( 'LDAP_MASTODON_BASE_ERRNO',       340000 );
define( 'NOTICE_MASTODON_BASE_ERRNO',     440000 );
define( 'PERMISSION_MASTODON_BASE_ERRNO', 540000 );
define( 'RUNTIME_MASTODON_BASE_ERRNO',    640000 );
define( 'SYSTEM_MASTODON_BASE_ERRNO',     740000 );
define( 'TEMPLATE_MASTODON_BASE_ERRNO',   840000 );

/**
 * "argument" error codes
 */
define( 'ARGUMENT__MASTODON_BUSINESS_SETTING_MANAGER____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 1 );
define( 'ARGUMENT__MASTODON_UI_PULL_PARTICIPANT_LIST_ALTERNATE____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 2 );
define( 'ARGUMENT__MASTODON_UI_PULL_PARTICIPANT_LIST_CONSENT____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 3 );
define( 'ARGUMENT__MASTODON_UI_PULL_PARTICIPANT_PRIMARY____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 4 );
define( 'ARGUMENT__MASTODON_UI_PULL_PARTICIPANT_PRIMARY__FINISH__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 5 );
define( 'ARGUMENT__MASTODON_UI_PUSH_ACCESS_DELETE____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 6 );
define( 'ARGUMENT__MASTODON_UI_PUSH_ADDRESS_DELETE____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 7 );
define( 'ARGUMENT__MASTODON_UI_PUSH_ADDRESS_EDIT____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 8 );
define( 'ARGUMENT__MASTODON_UI_PUSH_ADDRESS_NEW____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 9 );
define( 'ARGUMENT__MASTODON_UI_PUSH_AVAILABILITY_DELETE____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 10 );
define( 'ARGUMENT__MASTODON_UI_PUSH_AVAILABILITY_EDIT____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 11 );
define( 'ARGUMENT__MASTODON_UI_PUSH_AVAILABILITY_NEW____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 12 );
define( 'ARGUMENT__MASTODON_UI_PUSH_CONSENT_DELETE____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 13 );
define( 'ARGUMENT__MASTODON_UI_PUSH_CONSENT_EDIT____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 14 );
define( 'ARGUMENT__MASTODON_UI_PUSH_CONSENT_NEW____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 15 );
define( 'ARGUMENT__MASTODON_UI_PUSH_PARTICIPANT_DELETE_ADDRESS____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 16 );
define( 'ARGUMENT__MASTODON_UI_PUSH_PARTICIPANT_DELETE_AVAILABILITY____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 17 );
define( 'ARGUMENT__MASTODON_UI_PUSH_PARTICIPANT_DELETE_CONSENT____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 18 );
define( 'ARGUMENT__MASTODON_UI_PUSH_PARTICIPANT_DELETE_PHONE____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 19 );
define( 'ARGUMENT__MASTODON_UI_PUSH_PARTICIPANT_EDIT____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 20 );
define( 'ARGUMENT__MASTODON_UI_PUSH_PHONE_DELETE____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 21 );
define( 'ARGUMENT__MASTODON_UI_PUSH_PHONE_EDIT____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 22 );
define( 'ARGUMENT__MASTODON_UI_PUSH_PHONE_NEW____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 23 );
define( 'ARGUMENT__MASTODON_UI_PUSH_SELF_SET_ROLE____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 24 );
define( 'ARGUMENT__MASTODON_UI_PUSH_SELF_SET_SITE____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 25 );
define( 'ARGUMENT__MASTODON_UI_PUSH_SITE_DELETE_ACCESS____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 26 );
define( 'ARGUMENT__MASTODON_UI_PUSH_SITE_NEW_ACCESS____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 27 );
define( 'ARGUMENT__MASTODON_UI_PUSH_USER_DELETE____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 28 );
define( 'ARGUMENT__MASTODON_UI_PUSH_USER_DELETE_ACCESS____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 29 );
define( 'ARGUMENT__MASTODON_UI_PUSH_USER_EDIT____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 30 );
define( 'ARGUMENT__MASTODON_UI_PUSH_USER_NEW____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 31 );
define( 'ARGUMENT__MASTODON_UI_PUSH_USER_NEW_ACCESS____CONSTRUCT__ERRNO',
        ARGUMENT_MASTODON_BASE_ERRNO + 32 );

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
define( 'NOTICE__MASTODON_UI_PUSH_ADDRESS_EDIT__FINISH__ERRNO',
        NOTICE_MASTODON_BASE_ERRNO + 1 );
define( 'NOTICE__MASTODON_UI_PUSH_ADDRESS_NEW__FINISH__ERRNO',
        NOTICE_MASTODON_BASE_ERRNO + 2 );
define( 'NOTICE__MASTODON_UI_PUSH_ALTERNATE_NEW__FINISH__ERRNO',
        NOTICE_MASTODON_BASE_ERRNO + 3 );
define( 'NOTICE__MASTODON_UI_PUSH_CONSENT_NEW__FINISH__ERRNO',
        NOTICE_MASTODON_BASE_ERRNO + 4 );
define( 'NOTICE__MASTODON_UI_PUSH_PARTICIPANT_DELETE_ALTERNATE__FINISH__ERRNO',
        NOTICE_MASTODON_BASE_ERRNO + 5 );
define( 'NOTICE__MASTODON_UI_PUSH_PARTICIPANT_NEW__FINISH__ERRNO',
        NOTICE_MASTODON_BASE_ERRNO + 6 );
define( 'NOTICE__MASTODON_UI_PUSH_PHONE_EDIT__FINISH__ERRNO',
        NOTICE_MASTODON_BASE_ERRNO + 7 );
define( 'NOTICE__MASTODON_UI_PUSH_PHONE_NEW__FINISH__ERRNO',
        NOTICE_MASTODON_BASE_ERRNO + 8 );

/**
 * "permission" error codes
 */

/**
 * "runtime" error codes
 */
define( 'RUNTIME__MASTODON_BUSINESS_SETTING_MANAGER____CONSTRUCT__ERRNO',
        RUNTIME_MASTODON_BASE_ERRNO + 1 );
define( 'RUNTIME__MASTODON_DATABASE_QUEXF_RECORD____CALL__ERRNO',
        RUNTIME_MASTODON_BASE_ERRNO + 2 );
define( 'RUNTIME__MASTODON_UI_PULL_PARTICIPANT_PRIMARY____CONSTRUCT__ERRNO',
        RUNTIME_MASTODON_BASE_ERRNO + 3 );
define( 'RUNTIME__MASTODON_UI_PUSH_CONSENT_NEW__FINISH__ERRNO',
        RUNTIME_MASTODON_BASE_ERRNO + 4 );
define( 'RUNTIME__MASTODON_UI_WIDGET_ADDRESS_ADD__FINISH__ERRNO',
        RUNTIME_MASTODON_BASE_ERRNO + 5 );
define( 'RUNTIME__MASTODON_UI_WIDGET_ALTERNATE_ADD__FINISH__ERRNO',
        RUNTIME_MASTODON_BASE_ERRNO + 6 );
define( 'RUNTIME__MASTODON_UI_WIDGET_AVAILABILITY_ADD__FINISH__ERRNO',
        RUNTIME_MASTODON_BASE_ERRNO + 7 );
define( 'RUNTIME__MASTODON_UI_WIDGET_CONSENT_ADD__FINISH__ERRNO',
        RUNTIME_MASTODON_BASE_ERRNO + 8 );
define( 'RUNTIME__MASTODON_UI_WIDGET_PHONE_ADD__FINISH__ERRNO',
        RUNTIME_MASTODON_BASE_ERRNO + 9 );

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
