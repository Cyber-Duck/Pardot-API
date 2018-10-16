<?php

use stdClass;

/**
 * Trait to allow the reading of a specific object by ID in a generic way
 * 
 * @category   PardotApi
 * @package    PardotApi
 * @author     Andrew Mc Cormack <andy@cyber-duck.co.uk>
 * @copyright  Copyright (c) 2018, Andrew Mc Cormack
 * @license    https://github.com/Cyber-Duck/Pardot-API/license
 * @version    1.0.0
 * @link       https://github.com/Cyber-Duck/Pardot-API
 * @since      1.0.0
 */
trait Readable
{
    /**
     * Sends the request to retrieve the object and returns it from the API
     * 
     * /api/{operator}/version/{version}/do/read/id/<id>?...
     * 
     * required: user_key, api_key, id
     */
    public function read(int $id):? stdClass
    {
        return $this->setOperator(sprintf('read/id/%s', $id));
    }
}