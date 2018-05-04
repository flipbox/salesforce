<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Helpers;

use Flipbox\Skeleton\Helpers\ArrayHelper;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 1.0.0
 */
class ErrorHelper
{
    /**
     * @param $errorMessage
     * @return string|null
     */
    public static function getFieldNameFromMessage(&$errorMessage)
    {
        // Get the field label between the single quotes
        if (preg_match_all('~\'(.*?)\'~', $errorMessage, $m)) {
            return ArrayHelper::getFirstValue($m[1]);
        }

        return null;
    }

    /**
     * @param $errorMessage
     * @return string|null
     */
    public static function getFieldNamesFromRequiredMessage(&$errorMessage)
    {
        // Get the field label between the single quotes
        if (preg_match_all('~\[(.*?)\]~', $errorMessage, $m)) {
            $errorMessage = "Required field missing";
            return $m[1];
        }

        return null;
    }

    /**
     * @param array $errors
     * @return bool
     */
    public static function hasSessionExpired(array $errors): bool
    {
        foreach ($errors as $error) {
            if (ArrayHelper::getValue($error, 'errorCode') === 'INVALID_SESSION_ID' &&
                ArrayHelper::getValue($error, 'message') === 'Session expired or invalid'
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $errorMessage
     * @param string $errorCode
     * @param array $fields
     * @return array
     */
    public static function interpretSObjectError(string $errorMessage, string $errorCode, array $fields = []): array
    {
        $errorKeys = ($fields ?: $errorCode);

        switch ($errorCode) {
            // error message looks similar to: No such column 'Foo' on sobject of type Bar
            case 'INVALID_FIELD':
                $errorKeys = static::getFieldNameFromMessage($errorMessage);
                break;

            case 'REQUIRED_FIELD_MISSING':
                $errorKeys = static::getFieldNamesFromRequiredMessage($errorMessage);
                break;

            case 'FIELD_CUSTOM_VALIDATION_EXCEPTION':
                if (empty($fields)) {
                    $errorKeys = $errorCode;
                }
        }

        return [$errorKeys, $errorMessage, $errorCode];
    }
}
