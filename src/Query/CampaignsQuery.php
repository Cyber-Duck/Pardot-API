<?php

namespace CyberDuck\Pardot\Query;

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
class CampaignsQuery extends Query
{
    use Queryable, Createable, Readable, Updateable;

    /**
     * Object name
     *
     * @var string
     */
    protected $object = 'campaign';

    /**
     * Array of valid query criteria
     * 
     * created_after - today, yesterday, last_7_days, this_month, last_month, <custom_time>
     * created_before - today, yesterday, last_7_days, this_month, last_month, <custom_time>
     * id_greater_than - <any_positive_integer>
     * id_less_than - <any_positive_integer>
     * name - <any string>
     * updated_before - today, yesterday, last_7_days, this_month, last_month, <custom_time>
     * updated_after - today, yesterday, last_7_days, this_month, last_month, <custom_time>
     *
     * @var array
     */
    protected $queryCriteria = [
        'created_after',
        'created_before',
        'id_greater_than',
        'id_less_than',
        'name',
        'updated_before',
        'updated_after'
    ];

    /**
     * Array of valid naviation values
     * 
     * limit - <any_positive_integer>
     * offset - <any_positive_integer>
     * sort_by - created_at, id, name, updated_at, cost
     * sort_order - ascending, descending
     *
     * @var array
     */
    protected $queryNavigation = [
        'limit',
        'offset',
        'sort_by',
        'sort_order'
    ];
}