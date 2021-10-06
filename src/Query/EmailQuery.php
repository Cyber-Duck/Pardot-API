<?php

namespace CyberDuck\PardotApi\Query;

use CyberDuck\PardotApi\Traits\CanRead;

/**
 * Email Query object representation
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
class EmailQuery extends Query
{
    use CanRead;

    /**
     * Object name
     *
     * @var string
     */
    protected $object = 'email';

    /**
     * Returns the statistical data for the list email specified by <list_email_id>.
     * <list_email_id> is the Pardot ID of the target email.
     * 
     * /api/email/version/{version}/do/stats/id/<list_email_id>?...
     * 
     * required: user_key, api_key, list_email_id
     *
     * @return stClass|null
     */
    public function stats(int $id):? stClass
    {
        return $this->setOperator(sprintf('stats/id/%s', $id))->request('stats');
    }

    /**
     * Sends a one-to-one email to the prospect identified by <prospect_id>
     * 
     * /api/email/version/3/do/send/prospect_id/<prospect_id>?...
     * 
     * required: user_key, api_key, campaign_id, (email_template_id OR (text_content, name, subject, & ((from_email & from_name) OR from_user_id)))
     *
     * @param integer $id
     * @param array $params
     * @return stClass|null
     * @todo validate passed params
     */
    public function sendToID(int $id, array $params):? stClass
    {
        return $this->setOperator(sprintf('send/prospect_id/%s', $id))->request('email');
    }

    /**
     * Sends a one-to-one email to the prospect identified by <prospect_email>
     * 
     * /api/email/version/3/do/send/prospect_email/<prospect_email>?...
     * 
     * required: user_key, api_key, campaign_id, (email_template_id OR (text_content, name, subject, & ((from_email & from_name) OR from_user_id)))
     *
     * @param string $email
     * @param array $params
     * @return stClass|null
     * @todo validate passed params
     */
    public function sendToEmail(string $email, array $params):? stClass
    {
        return $this->setOperator(sprintf('send/prospect_email/%s', $email))->request('email');
    }

    /**
     * Sends an email to all the prospects in a list identified by list_ids[]
     * 
     * /api/email/version/4/do/send
     * 
     * required: user_key, api_key, list_ids[], campaign_id, (email_template_id OR (text_content, name, subject, & ((from_email & from_name) OR from_user_id)))
     *
     * @param string $email
     * @param array $params
     * @return stClass|null
     * @todo validate passed params
     */
    public function send(array $params):? stClass
    {
        return $this->setOperator('send')->request('email');
    }
}
