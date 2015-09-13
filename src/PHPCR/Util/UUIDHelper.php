<?php

namespace PHPCR\Util;

/**
 * Static helper functions to deal with Universally Unique IDs (UUID).
 *
 * @license http://www.apache.org/licenses Apache License Version 2.0, January 2004
 * @license http://opensource.org/licenses/MIT MIT License
 */
class UUIDHelper
{
    /**
     * Checks if the string could be a UUID.
     *
     * @param  string  $id Possible uuid
     * @return boolean True if the test was passed, else false.
     */
    public static function isUUID($id)
    {
        // UUID is HEX_CHAR{8}-HEX_CHAR{4}-HEX_CHAR{4}-HEX_CHAR{4}-HEX_CHAR{12}
        if (1 === preg_match('/^[[:xdigit:]]{8}-[[:xdigit:]]{4}-[[:xdigit:]]{4}-[[:xdigit:]]{4}-[[:xdigit:]]{12}$/', $id)) {
            return true;
        }

        return false;
    }

    /**
     * Generate a UUID.
     *
     * This UUID can not be guaranteed to be unique within the repository.
     * Ensuring this is the responsibility of the repository implementation.
     *
     * See: http://stackoverflow.com/a/15875555/1316350
     *
     * @return string a random UUID
     */
    public static function generateUUID()
    {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
