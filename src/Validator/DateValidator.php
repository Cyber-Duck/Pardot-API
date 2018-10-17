<?php

namespace CyberDuck\PardotApi\Validator;

/**
 * Date values validation class
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
class DateValidator extends Validator
{
    /**
     * Allowed date query values
     *
     * @var array
     */
    protected $values = [
        'today', 
        'yesterday', 
        'last_7_days', 
        'this_month', 
        'last_month'
    ];

    /**
     * Validation method
     *
     * @param mixed $value
     * @return boolean
     */
    public function validate($value): bool
    {
        if(in_array($value, $this->values)) {
            return true;
        }
        // custom_time @todo
    }
}