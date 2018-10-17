<?php

namespace CyberDuck\PardotApi\Query;

use CyberDuck\PardotApi\Contract\QueryObject;
use CyberDuck\PardotApi\Traits\CanQuery;
use CyberDuck\PardotApi\Traits\CanRead;
use CyberDuck\PardotApi\Validator\DateValidator;
use CyberDuck\PardotApi\Validator\FixedValuesValidator;
use CyberDuck\PardotApi\Validator\PositiveIntValidator;
use CyberDuck\PardotApi\Validator\SortOrderValidator;
use CyberDuck\PardotApi\Validator\StringValidator;

/**
 * Custom Redirect object representation
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
class CustomRedirectsQuery extends Query implements QueryObject
{
    use CanQuery, CanRead;

    /**
     * Object name
     *
     * @var string
     */
    protected $object = 'customRedirect';

    /**
     * Returns an array of allowed query criteria and validators for the values
     *
     * @return array
     */
    public function getQueryCriteria(): array
    {
        return [
            'created_after'   => new DateValidator,
            'created_before'  => new DateValidator,
            'id_greater_than' => new PositiveIntValidator,
            'id_less_than'    => new PositiveIntValidator,
            'updated_before'  => new DateValidator,
            'updated_after'   => new DateValidator
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
            'limit'      => new PositiveIntValidator,
            'offset'     => new PositiveIntValidator,
            'sort_by'    => new FixedValuesValidator('created_at', 'id', 'updated_at'),
            'sort_order' => new SortOrderValidator
        ];
    }
}