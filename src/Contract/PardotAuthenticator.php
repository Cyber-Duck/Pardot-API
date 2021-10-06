<?php

namespace CyberDuck\PardotApi\Contract;

use GuzzleHttp\Psr7\Response;

/**
 * Pardot API Authenticator Interface
 *
 * An interface to override the default package PardotAuthenticator with a
 * custom implementation
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
interface PardotAuthenticator
{

    /**
     * Returns the Business Unit ID for use in query requests
     *
     * @return string
     */
    public function getBusinessUnitID(): string;

    /**
     * Performs the login authentication request to return and set the API key
     *
     * @return void
     */
    public function doAuthentication();

    /**
     * Returns the Response object or null on failure
     *
     * @return Response|null
     */
    public function getResponse(): ?Response;

    /**
     * Returns whether the login authentication request has been attempted
     *
     * @return boolean
     */
    public function isAuthenticated(): bool;

    /**
     * Returns whether the login authentication request has been successful
     *
     * @return boolean
     */
    public function isAuthenticatedSuccessfully(): bool;

    /**
     * Returns the Access Token returned from the login request for use in query requests
     *
     * @return string|null
     */
    public function getAccessToken(): ?string;
}
