<?php

namespace CyberDuck\PardotApi\Contract;

use CyberDuck\PardotApi\Contract\PardotAuthenticator;

/**
 * POST: https://pi.pardot.com/api/<object>/version/3/do/<operator>/<identifier_field>/<identifier>
 * message body: api_key=<your_api_key>&user_key=<your_user_key>&<parameters_for_request>
 */
interface PardotApi
{
    /**
     * Returns the API version
     *
     * @return integer
     */
    public function getVersion(): int;

    /**
     * Sets the API authenticator isntance
     *
     * @param PardotAuthenticator $authenticator
     * @return PardotApi
     */
    public function setAuthenticator(PardotAuthenticator $authenticator): PardotApi;

    /**
     * Returns the API authenticator instance
     *
     * @return PardotAuthenticator
     */
    public function getAuthenticator(): PardotAuthenticator;

    /**
     * Sets debugging on or off
     *
     * @param boolean $debug
     * @return PardotApi
     */
    public function setDebug(bool $debug): PardotApi;

    /**
     * Returns whether debugging has been enabled
     *
     * @return boolean
     */
    public function getDebug(): bool;

    /**
     * Sets the output format
     *
     * @param string $format
     * @return PardotApi
     */
    public function setFormat(string $format): PardotApi;

    /**
     * Returns the output format
     *
     * @return string
     */
    public function getFormat(): string;

    /**
     * Sets the output type
     *
     * @param string $output
     * @return PardotApi
     */
    public function setOuput(string $output): PardotApi;

    /**
     * Returns the output type
     *
     * @return string
     */
    public function getOutput(): string;

    /**
     * Returns the formatter class namespace
     *
     * @return string
     */
    public function getFormatter(): string;
}