<?php

namespace CyberDuck\PardotApi\Validator;

/**
 * Fixed values validation class
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
class FixedValuesValidator extends Validator
{
    /**
     * Allowed query values
     *
     * @var array
     */
    protected $values = [];

    /**
     * Sets the allowed values
     *
     * @param string[] ...$args
     */
    public function __construct(...$args)
    {
        $this->values = func_get_args();
    }

    /**
     * Validation method
     *
     * @param mixed $value
     * @return boolean
     */
    public function validate($value): bool
    {
        return in_array($value, $this->values);
    }
}