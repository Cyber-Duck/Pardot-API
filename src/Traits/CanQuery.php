<?php

namespace CyberDuck\Pardot\Traits;

/**
 * Trait to allow the querying of specific object results in a generic way
 * 
 * Implementing classes should implement QueryObject
 * 
 * - $queryCriteria
 * - $queryNavigation
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
trait CanQuery
{   
    /**
     * Sends the request to query the object results and returns them from the API
     * 
     * /api/{operator}/version/{version}/do/query?...
     * 
     * required: user_key, api_key
     * 
     * @param array $criteria
     * @return array|null
     */
    public function query(array $criteria):? array
    {
        return $this->setOperator('query')->setData($criteria)->request('result');
    }
}