<?php

namespace CyberDuck\Pardot;

use CyberDuck\Pardot\Contract\PardotApi as PardotApiInterface;
use CyberDuck\Pardot\Contract\PardotAuthenticator as PardotAuthenticatorInterface;
use CyberDuck\Pardot\Query\AccountsQuery;

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
 * @license    https://github.com/Cyber-Duck/Pardot-API/license
 * @version    1.0.0
 * @link       https://github.com/Cyber-Duck/Pardot-API
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
     * Returns an AccountsQuery object
     *
     * @return AccountsQuery
     */
    public function accounts(): AccountsQuery
    {
        return AccountsQuery::obj($this);
    }

    /**
     * Returns a CampaignsQuery object
     *
     * @return CampaignsQuery
     */
    public function campaigns(): CampaignsQuery
    {
        return CampaignsQuery::obj($this);
    }
}