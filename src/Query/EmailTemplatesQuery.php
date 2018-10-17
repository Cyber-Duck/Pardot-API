<?php

namespace CyberDuck\Pardot\Query;

use CyberDuck\Pardot\Traits\CanRead;

/**
 * Email Templates object representation
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
class EmailTemplatesQuery extends Query
{
    use CanRead;

    /**
     * Object name
     *
     * @var string
     */
    protected $object = 'emailTemplate';

    /**
     * Returns a list of email templates which are enabled for use in one to one emails.
     * 
     * /api/emailTemplate/version/{version}/do/listOneToOne
     * 
     * required: user_key, api_key
     *
     * @return array|null
     */
    public function listOneToOne():? array
    {
        return $this->setOperator('listOneToOne')->request($this->object);
    }
}