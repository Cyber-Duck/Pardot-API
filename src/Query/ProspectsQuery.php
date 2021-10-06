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
use CyberDuck\PardotApi\Validator\ArrayValidator;

/**
 * Forms object representation
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

class ProspectsQuery extends Query implements QueryObject
{
    use CanQuery, CanRead;

    /**
     * Object name
     *
     * @var string
     */
    protected $object = 'prospect';

    /**
     * Returns an array of allowed query criteria and validators for the values
     *
     * @return array
     */
    public function getQueryCriteria(): array
    {
        return [
            'assigned'              => new BooleanValidator,
            'assigned_to_user'      => new BooleanValidator,
            'created_after'         => new DateValidator,
            'created_before'        => new DateValidator,
            'deleted'               => new BooleanValidator,
            'grade_equal_to'        => new StringValidator,
            'grade_greater_than'    => new StringValidator,
            'grade_less_than'       => new StringValidator,
            'id_greater_than'       => new PositiveIntValidator,
            'id_less_than'          => new PositiveIntValidator,
            'is_starred'            => new BooleanValidator,
            'last_activity_before'  => new DateValidator,
            'last_activity_after'   => new DateValidator,
            'last_activity_never'   => new BooleanValidator,
            'limit_related_records' => new BooleanValidator,
            'list_id'               =>  new PositiveIntValidator,
            'new'                   => new BooleanValidator,
            'score_equal_to'        => new PositiveIntValidator,
            'score_greater_than'    => new PositiveIntValidator,
            'score_less_than'       => new PositiveIntValidator,
            'updated_before'        => new DateValidator,
            'updated_after'         => new DateValidator
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
            'fields'     => new ArrayValidator,
            'limit'      => new PositiveIntValidator,
            'offset'     => new PositiveIntValidator,
            'sort_by'    => new FixedValuesValidator('created_at', 'id', 'probability', 'value'),
            'sort_order' => new SortOrderValidator
        ];
    }
    
    /**
     * Sends the request to retrieve the prospect object by email and returns it from the API
     * 
     * /api/prospect/version/{version}/do/read/email/<email>?...
     * 
     * required: user_key, api_key, email
     * 
     * @param int $id
     * @return stdClass|null
     */
    public function readByEmail(string $email)
    {
        return $this->setOperator(sprintf('read/email/%s', $email))->request($this->object);
    }
}