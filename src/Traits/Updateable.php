<?php

namespace CyberDuck\Pardot\Traits;

use stdClass;

/**
 * Trait to allow the updating of a specific object by ID in a generic way
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
trait Updateable
{
    /**
     * Sends the request to update the object and return it from the API
     * 
     * /api/{operator}/version/{version}/do/update/id/<id>?...
     * 
     * required: user_key, api_key, id
     *
     * @param int $id
     * @param array $data
     * @return stdClass|null
     */
    public function update(int $id, array $data):? stdClass
    {
        return $this->setOperator(sprintf('update/id/%s', $id))->setData($data)->request($this->object);
    }
}