<?php
/**
 * Part of the VTEX GiftCardProvider package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    VTEX GiftCardSystem
 * @version    0.0.1
 * @author     VerdeIT
 * @license    BSD License (3-clause)
 * @copyright  (c) 2017-2017, VerdeIT
 * @link       https://github.com/hafael/vtex-giftcard-provider
 */

namespace Hafael\VTEX\GiftCardSystem;


class GiftCardSystem
{
    
    /**
     * The Config repository instance.
     *
     * @var \Hafael\VTEX\GiftCardSystem\ConfigInterface
     */
    protected $config;

    /**
     * Constructor.
     *
     * @param string $accountName
     * @param string $environment
     * @param string $appKey
     * @param string $appToken
     */
    public function __construct($accountName = null, $environment = null, $appKey = null, $appToken = null)
    {
        $this->config = new Config($accountName, $environment, $appKey, $appToken);
    }

    /**
     * Create a new VTEX GiftCardSystem API instance.
     *
     * @param  string $accountName
     * @param  string $environment
     * @param  string $appKey
     * @param  string $appToken
     * @return GiftCardSystem
     */
    public static function make($accountName = null, $environment = null, $appKey = null, $appToken = null)
    {
        return new static($accountName, $environment, $appKey, $appToken);
    }

    /**
     * Returns the Config repository instance.
     *
     * @return \Hafael\VTEX\GiftCardSystem\ConfigInterface
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Sets the Config repository instance.
     *
     * @param  \Hafael\VTEX\GiftCardSystem\ConfigInterface  $config
     * @return $this
     */
    public function setConfig(ConfigInterface $config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Returns the GiftCard base URL.
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->config->getBaseUrl();
    }

    /**
     * Sets the GiftCard base URL.
     *
     * @param  string  $accountName
     * @param  string  $environment
     * @return $this
     */
    public function setBaseUrl($accountName, $environment)
    {
        $this->config->setBaseUrl($accountName, $environment);

        return $this;
    }

    /**
     * Returns the GiftCard API key.
     *
     * @return string
     */
    public function getAccountName()
    {
        return $this->config->getAccountName();
    }

    /**
     * Sets the GiftCardProvider Account Name.
     *
     * @param  string  $accountName
     * @return $this
     */
    public function setAccountName($accountName)
    {
        $this->config->setAccountName($accountName);

        return $this;
    }

    /**
     * Returns the GiftCard API key.
     *
     * @return string
     */
    public function getEnvironment()
    {
        return $this->config->getEnvironment();
    }

    /**
     * Sets the GiftCardProvider Environment.
     *
     * @param  string  $accountName
     * @return $this
     */
    public function setEnvironment($environment)
    {
        $this->config->setEnvironment($environment);

        return $this;
    }

    /**
     * Returns the GiftCard APP Key.
     *
     * @return string
     */
    public function getAppKey()
    {
        return $this->config->getAppKey();
    }

    /**
     * Sets the GiftCardProvider APP Key.
     *
     * @param  string  $appKey
     * @return $this
     */
    public function setAppKey($appKey)
    {
        $this->config->setAppKey($appKey);

        return $this;
    }

    /**
     * Returns the GiftCard APP Token.
     *
     * @return string
     */
    public function getAppToken()
    {
        return $this->config->getAppToken();
    }

    /**
     * Sets the GiftCardProvider APP Token.
     *
     * @param  string  $appToken
     * @return $this
     */
    public function setAppToken($appToken)
    {
        $this->config->setAppToken($appToken);

        return $this;
    }

    /**
     * Dynamically handle missing methods.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return \Hafael\VTEX\GiftCardSystem\Api\ApiInterface
     */
    public function __call($method, array $parameters)
    {
        return $this->getApiInstance($method);
    }


    /**
     * Returns the Api class instance for the given method.
     *
     * @param  string  $method
     * @return \Hafael\VTEX\GiftCardSystem\Api\ApiInterface
     * @throws \BadMethodCallException
     */
    protected function getApiInstance($method)
    {
        $class = "\\Hafael\\VTEX\\GiftCardSystem\\Api\\".ucwords($method);

        if (class_exists($class)) {
            return new $class($this->config);
        }

        throw new \BadMethodCallException("Undefined method [{$method}] called.");
    }

}