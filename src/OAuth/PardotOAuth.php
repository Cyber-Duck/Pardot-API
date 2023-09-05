<?php

namespace CyberDuck\Pardot\OAuth;

class PardotOAuth
{
    private string $authorize_uri = 'https://login.salesforce.com/services/oauth2/authorize';
    private string $token_uri = 'https://login.salesforce.com/services/oauth2/token';

    private string $client_id;
    private string $client_secret;
    private string $redirect_uri;

    public function __construct(
        string $client_id,
        string $client_secret,
        string $redirect_uri
    )
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->redirect_uri = $redirect_uri;
    }


    public function getAuthorizationUri(): string
    {
        $data = [
            'response_type' => 'code',
            'client_id' => $this->client_id,
            'redirect_uri' => $this->redirect_uri,
            'scope' => ''
        ];
        $query = http_build_query($data);
        return sprintf('%s?%s', $this->authorize_uri, $query);
    }

    public function getAccessToken($authorizationCode): string
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$this->token_uri);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            http_build_query([
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'code' => $authorizationCode,
                'grant_type' => 'authorization_code',
                'redirect_uri' => $this->redirect_uri
            ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);

        return $server_output;
    }
}