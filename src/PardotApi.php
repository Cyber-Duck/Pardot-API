<?php

namespace CyberDuck\Pardot;

use Exception;
use CyberDuck\PardotApi\Contract\PardotApi as PardotApiInterface;
use CyberDuck\PardotApi\Contract\PardotAuthenticator as PardotAuthenticatorInterface;
use CyberDuck\PardotApi\Formatter\JsonFormatter;
use CyberDuck\PardotApi\Query\AccountsQuery;
use CyberDuck\PardotApi\Query\CampaignsQuery;
use CyberDuck\PardotApi\Query\CustomFieldsQuery;
use CyberDuck\PardotApi\Query\CustomRedirectsQuery;
use CyberDuck\PardotApi\Query\DynamicContentQuery;
use CyberDuck\PardotApi\Query\EmailClicksQuery;
use CyberDuck\PardotApi\Query\EmailQuery;
use CyberDuck\PardotApi\Query\EmailTemplatesQuery;
use CyberDuck\PardotApi\Query\FormsQuery;
use CyberDuck\PardotApi\Query\LifecycleHistoriesQuery;
use CyberDuck\PardotApi\Query\LifecycleStagesQuery;
use CyberDuck\PardotApi\Query\ListMembershipsQuery;
use CyberDuck\PardotApi\Query\ListsQuery;
use CyberDuck\PardotApi\Query\OpportunitiesQuery;
use CyberDuck\PardotApi\Query\ProspectAccountsQuery;
use CyberDuck\PardotApi\Query\ProspectsQuery;
use CyberDuck\PardotApi\Query\TagObjectsQuery;
use CyberDuck\PardotApi\Query\TagsQuery;
use CyberDuck\PardotApi\Query\UsersQuery;
use CyberDuck\PardotApi\Query\VisitorActivitiesQuery;
use CyberDuck\PardotApi\Query\VisitorsQuery;
use CyberDuck\PardotApi\Query\VisitsQuery;

/**
 * PHP Wrapper for the pardot API
 * 
 * API access methods return object representations on the Pardot API object
 * / operator endpoints
 * 
 * Methods and objects that this class depend on can be easily over-ridden to
 * future proof this package against API updates
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
class PardotApi implements PardotApiInterface
{
    /**
     * Pardot API version, currently 4
     * This package maintains a high level of compatibility with version 3
     *
     * @var int
     */
    protected $version = 4;
    
    /**
     * API authenticator instance
     *
     * @var PardotAuthenticator
     */
    protected $authenticator;

    /**
     * Whether debugging is enabled
     *
     * @var boolean
     */
    protected $debug = false;

    /**
     * Response output format
     *
     * @var string
     */
    protected $format = 'json';

    /**
     * Allowed response output formats
     *
     * @var array
     */
    protected $formats = [
        'json' => JsonFormatter::class
    ];

    /**
     * Response output type
     *
     * @var string
     */
    protected $output = 'full';

    /**
     * Allowed response output types
     *
     * @var array
     */
    protected $outputs = [
        'full',
        'simple',
        'mobile',
        'bulk'
    ];

    /**
     * Array of query object signatures available via a function call
     * Object is returned via __call()
     *
     * @var array
     */
    protected $signatures = [
        'account'            => AccountsQuery::class,
        'campaigns'          => CampaignsQuery::class,
        'customFields'       => CustomFieldsQuery::class,
        'customRedirects'    => CustomRedirectsQuery::class,
        'dynamicContent'     => DynamicContentQuery::class,
        'emailClicks'        => EmailClicksQuery::class,
        'email'              => EmailQuery::class,
        'emailTemplates'     => EmailTemplatesQuery::class,
        'forms'              => FormsQuery::class,
        'lifecycleHistories' => LifecycleHistoriesQuery::class,
        'lifecycleStages'    => LifecycleStagesQuery::class,
        'listMemberships'    => ListMembershipsQuery::class,
        'lists'              => ListsQuery::class,
        'opportunities'      => OpportunitiesQuery::class,
        'prospectAccounts'   => ProspectAccountsQuery::class,
        'prospects'          => ProspectsQuery::class,
        'tagObjects'         => TagObjectsQuery::class,
        'tags'               => TagsQuery::class,
        'users'              => UsersQuery::class,
        'visitorActivities'  => VisitorActivitiesQuery::class,
        'visitors'           => VisitorsQuery::class,
        'visits'             => VisitsQuery::class,
    ];
    
    /**
     * Sets the PardotAuthenticator instance with the passed credentials and
     * sets the API version
     *
     * @param string $email
     * @param string $password
     * @param string $userKey
     * @param integer $version
     */
    public function __construct(string $email, string $password, string $userKey, int $version = 4)
    {
        $this->authenticator = new PardotAuthenticator(
            $this, $email, $password, $userKey
        );
        $this->version = $version;
    }

    /**
     * Returns the API version
     *
     * @return integer
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * Sets the API authenticator isntance
     *
     * @param PardotAuthenticatorInterface $authenticator
     * @return PardotApiInterface
     */
    public function setAuthenticator(PardotAuthenticatorInterface $authenticator): PardotApiInterface
    {
        $this->authenticator = $authenticator;
        return $this;
    }

    /**
     * Returns the API authenticator instance
     *
     * @return PardotAuthenticatorInterface
     */
    public function getAuthenticator(): PardotAuthenticatorInterface
    {
        return $this->authenticator;
    }

    /**
     * Sets debugging on or off
     *
     * @param boolean $debug
     * @return PardotApiInterface
     */
    public function setDebug(bool $debug): PardotApiInterface
    {
        $this->debug = $debug;
        return $this;
    }

    /**
     * Returns whether debugging has been enabled
     *
     * @return boolean
     */
    public function getDebug(): bool
    {
        return $this->debug;
    }

    /**
     * Sets the output format
     *
     * @param string $format
     * @return PardotApiInterface
     */
    public function setFormat(string $format): PardotApiInterface
    {
        if(!array_key_exists($format, $this->formats)) {
            throw new Exception(sprintf('%s is not an acceptable format', $format));
        }
        $this->format = $format;
        return $this;
    }

    /**
     * Returns the output format
     *
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * Sets the output type
     *
     * @param string $output
     * @return PardotApiInterface
     */
    public function setOuput(string $output): PardotApiInterface
    {
        if(!in_array($output, $this->outputs)) {
            throw new Exception(sprintf('%s is not an acceptable output type', $output));
        }
        $this->output = $output;
        return $this;
    }

    /**
     * Returns the output type
     *
     * @return string
     */
    public function getOutput(): string
    {
        return $this->output;
    }

    /**
     * Returns the formatter class namespace
     *
     * @return string
     */
    public function getFormatter(): string
    {
        return $this->formats[$this->format];
    }

    /**
     * Magic method to return a query object form the signatures array
     *
     * @param string $name
     * @param mixed $arguments
     * @return void
     */
    public function __call(string $name, $arguments)
    {
        if(array_key_exists($name, $this->signatures)) {
            return $this->signatures[$name]::obj($this);
        }
    }
}