<?php

namespace CyberDuck\Pardot\Query;

use CyberDuck\Pardot\Contract\QueryObject;
use CyberDuck\Pardot\Traits\CanQuery;
use CyberDuck\Pardot\Traits\CanRead;
use CyberDuck\Pardot\Validator\DateValidator;
use CyberDuck\Pardot\Validator\FixedValuesValidator;
use CyberDuck\Pardot\Validator\PositiveIntValidator;
use CyberDuck\Pardot\Validator\SortOrderValidator;
use CyberDuck\Pardot\Validator\StringValidator;

/**
 * Tag Objects object representation
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
class TagObjectsQuery extends Query implements QueryObject
{
    use CanQuery, CanRead;

    /**
     * Object name
     *
     * @var string
     */
    protected $object = 'tagObject';

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
            'tag_id'          => new PositiveIntValidator,
            'object_id'       => new PositiveIntValidator,
            'type'            => new FixedValuesValidator(
                'Automation', 'Block', 'Campaign', 'Competitor', 
                'Prospect Custom Field', 'Custom URL', 'Drip Program', 
                'Email', 'Email Draft', 'Email Template', 'Email Template Draft', 
                'File', 'Form', 'Form Field', 'Form Handler', 'Group', 'Keyword', 
                'Landing Page', 'Layout Template', 'List', 'Opportunity', 
                'Paid Search Campaign', 'Personalization', 'Profile', 'Prospect', 
                'Prospect Default Field', 'Segmentation Rule', 'Site', 
                'Site Search', 'Social Message', 'User', 'Dynamic Content'
            )
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
            'sort_by'    => new FixedValuesValidator('created_at', 'id'),
            'sort_order' => new SortOrderValidator
        ];
    }
}