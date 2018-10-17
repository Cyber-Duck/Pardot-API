<?php

namespace CyberDuck\PardotApi\Traits;

/**
 * Trait to allow the deletion of specific object types in a generic way
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
trait CanDelete
{
    /**
     * Sends the request to delete the object
     * 
     * /api/{object}/version/{version}/do/delete/id/<id>?...
     * 
     * required: user_key, api_key, id
     *
     * @param int $id
     * @return int
     * @todo returns HTTP 204 No Content on success
     */
    public function delete(int $id):? stdClass
    {
        return $this->setOperator(sprintf('delete/id/%s', $id))->request($this->object);
    }
}