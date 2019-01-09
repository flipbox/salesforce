<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Connections;

use Flipbox\Relay\Salesforce\AuthorizationInterface;
use Flipbox\Relay\Salesforce\InstanceInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 3.0.0
 */
interface ConnectionInterface extends InstanceInterface, AuthorizationInterface
{
    /**
     * The Salesforce Connection Instance URL
     *
     * @return string
     */
    public function getInstanceUrl(): string;
}
