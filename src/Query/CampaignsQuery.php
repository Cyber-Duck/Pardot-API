<?php

namespace CyberDuck\Pardot\Query;

use CyberDuck\Pardot\Contract\QueryObject;
use CyberDuck\Pardot\Traits\CanCreate;
use CyberDuck\Pardot\Traits\CanQuery;
use CyberDuck\Pardot\Traits\CanRead;
use CyberDuck\Pardot\Traits\CanUpdate;
use CyberDuck\Pardot\Validator\DateValidator;
use CyberDuck\Pardot\Validator\FixedValuesValidator;
use CyberDuck\Pardot\Validator\PositiveIntValidator;
use CyberDuck\Pardot\Validator\SortOrderValidator;
use CyberDuck\Pardot\Validator\StringValidator;

/**
 * Campaigns object representation
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