<?php

namespace CyberDuck\PardotApi\Contract;

interface QueryObject
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
    public function query(array $criteria):? array;

    /**
     * Returns an array of allowed query criteria options
     *
     * @return array
     */
    public function getQueryCriteria(): array;

    /**
     * Returns an array of allowed query navigation options
     *
     * @return array
     */
    public function getQueryNavigation(): array;
}