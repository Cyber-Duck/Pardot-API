<?php

namespace CyberDuck\PardotApi\Query;

use CyberDuck\PardotApi\Contract\QueryObject;
use CyberDuck\PardotApi\Traits\CanQuery;
use CyberDuck\PardotApi\Validator\DateValidator;
use CyberDuck\PardotApi\Validator\PositiveIntValidator;

/**
 * Email Clicks object representation
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
class EmailClicksQuery extends Query implements QueryObject
{
    use CanQuery;

    /**
     * Object name
     *
     * @var string
     */
    protected $object = 'emailClick';

    /**
     * Returns an array of allowed query criteria and validators for the values
     *
     * @return array
     */
    public function getQueryCriteria(): array
    {
        return [
            'created_after'           => new DateValidator,
            'created_before'          => new DateValidator,
            'id_greater_than'         => new PositiveIntValidator,
            'list_email_id'           => new PositiveIntValidator,
            'drip_program_action_id'  => new PositiveIntValidator,
            'email_template_id'       => new PositiveIntValidator,
            'tracker_redirect_id'     => new PositiveIntValidator
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
            'limit'           => new PositiveIntValidator,
            'id_greater_than' => new PositiveIntValidator
        ];
    }
}