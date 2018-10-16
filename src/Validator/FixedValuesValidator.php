<?php

namespace CyberDuck\Pardot\Validator;

/**
 * Fixed values validation class
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