<?php

namespace CyberDuck\PardotApi\Query;

use CyberDuck\PardotApi\Contract\QueryObject;
use CyberDuck\PardotApi\Traits\CanCreate;
use CyberDuck\PardotApi\Traits\CanQuery;
use CyberDuck\PardotApi\Traits\CanRead;
use CyberDuck\PardotApi\Traits\CanUpdate;
use CyberDuck\PardotApi\Validator\DateValidator;
use CyberDuck\PardotApi\Validator\FixedValuesValidator;
use CyberDuck\PardotApi\Validator\PositiveIntValidator;
use CyberDuck\PardotApi\Validator\SortOrderValidator;
use CyberDuck\PardotApi\Validator\StringValidator;

/**
 * Campaigns object representation
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
class CampaignsQuery extends Query implements QueryObject
{
    use CanQuery, CanCreate, CanRead, CanUpdate;

    /**
     * Object name
     *
     * @var string
     */
    protected $object = 'campaign';

    /**
     * Returns an array of allowed query criteria and validators for the values
     *
     * @return array
     */
    public function getQueryCriteria(): array
    {
        return [
            'name'            => new StringValidator,
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
            'sort_by'    => new FixedValuesValidator('created_at', 'id', 'name', 'updated_at', 'cost'),
            'sort_order' => new SortOrderValidator
        ];
    }
}