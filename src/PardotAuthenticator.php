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
 * Sends an authentication request to the Pardot API to get an API key to use
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
     * Auth user key credential
     *
     * @var string
     */
    protected $userKey;

    /**
     * Returned request API key
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Login endpoint
     *
     * @var string
     */
    protected $endpoint = 'https://pi.pardot.com/api/login/version/%s/';

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
     * @param string $userKey
     */
    public function __construct(PardotApi $api, string $email, string $password, string $userKey)
    {
        $this->api = $api;
        $this->email = $email;
        $this->password = $password;
        $this->userKey = $userKey;

        $this->client = new Client();
    }

    /**
     * Returns the user credential key for use in query requests
     *
     * @return string
     */
    public function getUserKey(): string
    {
        return $this->userKey;
    }

    /**
     * Performs the login authentication request to return and set the API key 
     *
     * @return void
     * @throws Exception
     */
    public function doAuthentication(): void
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
            $formatter = new $namespace((string) $this->response->getBody(), 'api_key');
            
            $this->success = true;
            $this->apiKey = $formatter->getData()->api_key;
        } catch(Exception $e) {
            if($this->api->getDebug() === true) {
                echo $e->getMessage();
                die;
            }
        }
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
     * Returns the API key returned from the login request for use in query requests
     *
     * @return string|null
     */
    public function getApiKey():? string
    {
        return $this->apiKey;
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
                'email'    => $this->email,
                'password' => $this->password,
                'user_key' => $this->userKey,
                'format'   => $this->api->getFormat(),
                'output'   => $this->api->getOutput()
            ]
        ];
    }
}