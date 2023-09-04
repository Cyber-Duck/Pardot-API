<?php

namespace CyberDuck\Pardot;

use CyberDuck\Pardot\Exception\InvalidPardotConfigurationException;
use Stevenmaguire\OAuth2\Client\Provider\Salesforce;
use Stevenmaguire\OAuth2\Client\Token\AccessToken;
use CyberDuck\PardotApi\Contract\PardotAuthenticator as PardotAuthenticatorInterface;

class PardotAuthenticator implements PardotAuthenticatorInterface
{
    protected PardotApi $api;
    protected AccessToken $accessToken;
    protected bool $freshAccessToken = false;
    protected string $clientId;
    protected string $clientSecret;
    protected string $redirectUri;
    protected string $businessUnitId;
    protected string $accessTokenStorage;

    public function __construct(
        PardotApi $api,
        string    $clientId,
        string    $clientSecret,
        string    $redirectUri,
        string    $businessUnitId,
        string    $absPathAccessTokenStorage
    )
    {
        $this->api = $api;

        $this->accessTokenStorage = $absPathAccessTokenStorage;
        if (($accessTokenStorage = $this->getApiDataFromAccessTokenStorage()) === null)
        {
            throw new InvalidPardotConfigurationException('No valid Pardot configuration found!', 1693657457);
        }

        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUri = $redirectUri;
        $this->businessUnitId = $businessUnitId;
        $this->accessToken = new AccessToken($accessTokenStorage);
    }

    /**
     * Salesforce suggests to only refresh the Access Token when API returns it is expired
     * @return void
     */
    public function refreshAccessToken(): void
    {
        try
        {
            $provider = new Salesforce([
                'clientId' => $this->clientId,
                'clientSecret' => $this->clientSecret,
                'redirectUri' => $this->redirectUri
            ]);

            $newAccessToken = $provider->getAccessToken('refresh_token', [
                'refresh_token' => $this->accessToken->getRefreshToken()
            ]);

            // store refresh token when not provided
            if (!$newAccessToken->getRefreshToken())
            {
                $options = $newAccessToken->jsonSerialize();
                $options['refresh_token'] = $this->accessToken->getRefreshToken();
                $newAccessToken = new \Stevenmaguire\OAuth2\Client\Token\AccessToken($options);
            }

            $this->accessToken = $newAccessToken;
            $this->writeApiDatatoConfigFile();
            $this->freshAccessToken = true;
        }
        catch (\Exception $e)
        {
            if ($this->api->getDebug() === true)
            {
                echo $e->getMessage();
                die;
            }
        }
    }

    public function accessTokenStorageSerialize(): array
    {
        return $this->accessToken->jsonSerialize();
    }

    private function getApiDataFromAccessTokenStorage(): ?array
    {
        $content = file_get_contents($this->accessTokenStorage);
        return json_decode($content, true);
    }

    private function writeApiDatatoConfigFile(): void
    {
        $accessTokenStorage = fopen($this->accessTokenStorage, 'w') or die('Unable to read file');
        fwrite($accessTokenStorage, json_encode($this->accessTokenStorageSerialize()));
        fclose($accessTokenStorage);
    }

    /**
     * Returns the Access Token returned from the login request for use in query requests
     *
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken->getToken();
    }

    /**
     * Returns the Business Unit ID for use in query requests
     *
     * @return string
     */
    public function getBusinessUnitId(): string
    {
        return $this->businessUnitId;
    }

    /**
     * Returns whether the access token is fetched by refresh access token
     * @return bool
     */
    public function isFreshAccessToken(): bool
    {
        return $this->freshAccessToken;
    }
}