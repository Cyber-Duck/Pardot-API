<?php

namespace CyberDuck\PardotApi\Query;

use CyberDuck\PardotApi\Contract\QueryObject;
use CyberDuck\PardotApi\Traits\CanQuery;
use CyberDuck\PardotApi\Traits\CanRead;
use CyberDuck\PardotApi\Validator\PositiveIntListValidator;
use CyberDuck\PardotApi\Validator\PositiveIntValidator;

/**
 * Visits object representation
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
class VisitsQuery extends Query implements QueryObject
{
    use CanQuery, CanRead;

    /**
     * Object name
     *
     * @var string
     */
    protected $object = 'visit';

    /**
     * Returns an array of allowed query criteria and validators for the values
     * 
     * One of the following parameters must be used when issuing a visits query
     * @todo make sure one of the below list keys is set
     *
     * @return array
     */
    public function getQueryCriteria(): array
    {
        return [
            'ids'          => new PositiveIntListValidator,
            'visitor_ids'  => new PositiveIntListValidator,
            'prospect_ids' => new PositiveIntListValidator
        ];
    } 

    /**
     * Returns an array of allowed query navigation params and validators for the values
     *
     * @return array
     */
    public function getQueryNavigation(): array
    {
        return [
            'limit'  => new PositiveIntValidator,
            'offset' => new PositiveIntValidator
        ];
    }
}