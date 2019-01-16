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


class Config implements ConfigInterface
{
    
    /**
     * The required VTEX API server base url.
     * (e.g. "https://api.vtexcommerce.com.br")
     *
     * @var string
     */
    protected $baseUrl;
    
    /**
     * The required API Key to access this service.
     * (e.g. "minhaloja")
     *
     * @var string
     */
    protected $accountName;

    /**
     * The required VTEX API server base url.
     * (e.g. "https://api.vtexcommerce.com.br")
     *
     * @var string
     */
    protected $environment;

    /**
     * The required VTEX API server base url.
     * (e.g. "https://api.vtexcommerce.com.br")
     *
     * @var string
     */
    protected $appKey;

    /**
     * The required VTEX API server base url.
     * (e.g. "https://api.vtexcommerce.com.br")
     *
     * @var string
     */
    protected $appToken;

    /**
     * The Constructor.
     *
     * @param  string $accountName
     * @param  string $environment
     * @param  string $appKey
     * @param  string $appToken
     */
    public function __construct($accountName, $environment, $appKey, $appToken)
    {
        
        $this->setBaseUrl($accountName ?: getenv('VTEX_ACCOUNT_NAME'), $environment ?: getenv('VTEX_ENVIRONMENT'));
        $this->setAppKey($appKey ?: getenv('VTEX_APP_KEY'));
        $this->setAppToken($appToken ?: getenv('VTEX_APP_TOKEN'));

        if (! $this->accountName || $this->accountName === '') {
            throw new \RuntimeException('The VTEX Account Name is not defined!');
        }

        if (! $this->environment || $this->environment === '') {
            throw new \RuntimeException('The VTEX Environment is not defined!');
        }

        if (! $this->appKey || $this->appKey === '') {
            throw new \RuntimeException('The VTEX APP Key is not defined!');
        }

        if (! $this->appToken || $this->appToken === '') {
            throw new \RuntimeException('The VTEX APP Token is not defined!');
        }
    }

    
    /**
     * {@inheritdoc}
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function setBaseUrl($accountName, $environment)
    {
        $this->setAccountName($accountName);
        $this->setEnvironment($environment);
        
        $this->baseUrl = "http://".$accountName.".".$environment.".com.br/api/gift-card-system/pvt";

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     * {@inheritdoc}
     */
    public function setAccountName($accountName)
    {
        $this->accountName = $accountName;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEnvironment()
    {
        return $this->accountName;
    }

    /**
     * {@inheritdoc}
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAppKey()
    {
        return $this->appKey;
    }

    /**
     * {@inheritdoc}
     */
    public function setAppKey($appKey)
    {
        $this->appKey = $appKey;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAppToken()
    {
        return $this->appToken;
    }

    /**
     * {@inheritdoc}
     */
    public function setAppToken($appToken)
    {
        $this->appToken = $appToken;

        return $this;
    }

}