<?php

namespace CyberDuck\PardotApi\Validator;

/**
 * Positive integer validation class
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
class PositiveIntValidator extends Validator
{
    /**
     * Validation method
     *
     * @param mixed $value
     * @return boolean
     */
    public function validate($value): bool
    {
        return is_numeric($value) && $value > 0;
    }
}