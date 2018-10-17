<?php

namespace CyberDuck\PardotApi\Query;

use stdClass;

/**
 * Account object representation
 * 
 * @category   PardotApi
 * @package    PardotApi
 * @author     Andrew Mc Cormack <andy@cyber-duck.co.uk>
 * @copyright  Copyright (c) 2018, Andrew Mc Cormack
 * @license    https://github.com/cyber-duck/pardot-api/license
 * @version    1.0.0
 * @link       https://github.com/cyber-duck/pardot-api
 * @since      1.0.0
 */
class AccountsQuery extends Query
{
    /**
     * Object name
     *
     * @var string
     */
    protected $object = 'account';

    /**
     * Returns the data for the account of the currently logged in user.
     * 
     * /api/account/version/{version}/do/read
     * 
     * required: user_key, api_key
     */
    public function read():? stdClass
    {
        return $this->setOperator('read')->request($this->object);
    }
}