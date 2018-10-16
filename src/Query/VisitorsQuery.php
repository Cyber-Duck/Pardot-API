<?php

namespace CyberDuck\Pardot\Query;

use CyberDuck\Pardot\Contract\QueryObject;
use CyberDuck\Pardot\Traits\CanQuery;
use CyberDuck\Pardot\Traits\CanRead;
use CyberDuck\Pardot\Validator\BooleanValidator;
use CyberDuck\Pardot\Validator\DateValidator;
use CyberDuck\Pardot\Validator\FixedValuesValidator;
use CyberDuck\Pardot\Validator\PositiveIntListValidator;
use CyberDuck\Pardot\Validator\PositiveIntValidator;
use CyberDuck\Pardot\Validator\SortOrderValidator;
use CyberDuck\Pardot\Validator\StringValidator;

/**
 * Visitors object representation
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
class VisitorsQuery extends Query implements QueryObject
{
    use CanQuery, CanRead;

    /**
     * Object name
     *
     * @var string
     */
    protected $object = 'visitor';

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
            'updated_after'   => new DateValidator,
            'only_identified' => new BooleanValidator,
            'prospect_ids'    => new PositiveIntListValidator
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
            'output'     => new FixedValuesValidator('simple', 'mobile'),
            'sort_by'    => new FixedValuesValidator('created_at', 'id', 'updated_at'),
            'sort_order' => new SortOrderValidator
        ];
    }

    /**
     * Assigns or reassigns the visitor specified by <id> to a specified prospect. 
     * The <prospect_id> parameters must be provided to identify the target prospect.
     * 
     * /api/visitor/version/{visitor}/do/assign/id/<id>?...
     * 
     * required: user_key, api_key, id, prospect_id
     * 
     * @param int $id
     * @param int $prospectId
     * @return stdClass|null
     */
    public function assign(int $id, int $prospectId):? stdClass
    {
        return $this->setOperator(sprintf('assign/id/%s', $id))->setData(['prospect_id' => $prospectId])->request($this->object);
    }
}