<?php

namespace CyberDuck\Pardot;

use CyberDuck\PardotApi\Contract\PardotApi;
use CyberDuck\PardotApi\Contract\PardotAuthenticator as PardotAuthenticatorInterface;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use stdClass;

/**
 * Pardot API Authenticator
 *
 * Sends an authentication request to the Pardot API to get an Access Token to use
 * in query requests
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
class PardotAuthenticator implements PardotAuthenticatorInterface
{
    /**
     * Main API class instance
     *
     * @var PardotApi
     */
    protected $api;

    /**
     * Auth user email credential
     *
     * @var string
     */
    protected $email;

    /**
     * Auth user password credential
     *
     * @var string
     */
    protected $password;

    /**
     * Auth client id credential
     *
     * @var string
     */
    protected $clientID;

    /**
     * Auth client secret credential
     *
     * @var string
     */
    protected $clientSecret;

    /**
     * Auth business unit id credential
     *
     * @var string
     */
    protected $businessUnitID;

    /**
     * Returned request access token
     *
     * @var string
     */
    protected $accessToken;

    /**
     * Login endpoint
     *
     * @var string
     */
    protected $endpoint = 'https://login.salesforce.com/services/oauth2/token';

    /**
     * Returns response
     *
     * @var Response|null
     */
    protected $response;

    /**
     * Flag to indicate the authentication request has been sent
     *
     * @var boolean
     */
    protected $authenticated = false;

    /**
     * Flag to indicate the authentication request has been successful
     *
     * @var boolean
     */
    protected $success = false;

    /**
     * Sets the required APi credentials and request client instance
     *
     * @param PardotApi $api
     * @param string $email
     * @param string $password
     * @param string $clientID
     * @param string $clientSecret
     */
    public function __construct(PardotApi $api, string $email, string $password, string $clientID, string $clientSecret, string $businessUnitID)
    {
        $this->api            = $api;
        $this->email          = $email;
        $this->password       = $password;
        $this->clientID       = $clientID;
        $this->clientSecret   = $clientSecret;
        $this->businessUnitID = $businessUnitID;

        $this->client       = new Client();
    }

    /**
     * Performs the login authentication request to return and set the Access Token
     *
     * @return static
     * @throws Exception
     */
    public function doAuthentication()
    {
        try {
            $this->authenticated = true;

            $this->response = $this->client->request('POST',
                $this->getLoginRequestEndpoint(),
                $this->getLoginRequestOptions()
            );

            if($this->response->getStatusCode() !== 200) {
                throw new Exception('Pardot API error: 200 response not returned');
            }
            $namespace = $this->api->getFormatter();
            $formatter = new $namespace((string) $this->response->getBody(), 'access_token');

            $this->success = true;
            $this->accessToken = $formatter->getData()->access_token;
        } catch(Exception $e) {
            if($this->api->getDebug() === true) {
                echo $e->getMessage();
                die;
            }
        }
        return $this;
    }

    /**
     * Returns the Response object or null on failure
     *
     * @return Response|null
     */
    public function getResponse():? Response
    {
        return $this->response;
    }

    /**
     * Returns the Access Token returned from the login request for use in query requests
     *
     * @return string
     */
    public function getAccessToken():string
    {
        return $this->accessToken;
    }

    /**
     * Returns the Business Unit ID for use in query requests
     *
     * @return string
     */
    public function getBusinessUnitID(): string
    {
        return $this->businessUnitID;

    }

    /**
     * Returns whether the login authentication request has been attempted
     *
     * @return boolean
     */
    public function isAuthenticated(): bool
    {
        return $this->authenticated;
    }

    /**
     * Returns whether the login authentication request has been successful
     *
     * @return boolean
     */
    public function isAuthenticatedSuccessfully(): bool
    {
        return $this->success;
    }

    /**
     * Returns the login request endpoint URL
     *
     * @return string
     */
    private function getLoginRequestEndpoint(): string
    {
        return sprintf(
            $this->endpoint,
            $this->api->getVersion()
        );
    }

    /**
     * Returns the login request additional options
     *
     * @return array
     */
    private function getLoginRequestOptions(): array
    {
        return [
            'form_params' => [
                'grant_type'    => 'password',
                'username'      => $this->email,
                'password'      => $this->password,
                'client_id'     => $this->clientID,
                'client_secret' => $this->clientSecret,
                'format'   => $this->api->getFormat(),
                'output'   => $this->api->getOutput()
            ]
        ];
    }
}
