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


interface ConfigInterface
{
    

    /**
     * Returns the current GiftCardSystem server base URL.
     *
     * @return string
     */
    public function getBaseUrl();

    /**
     * Sets the current current GiftCardSystem server base URL.
     *
     * @param  string  $accountName
     * @param  string  $environment
     * @return $this
     */
    public function setBaseUrl($accountName, $environment);

    /**
     * Returns the GiftCardSystem API key.
     *
     * @return string
     */
    public function getAccountName();

    /**
     * Sets the VTEX Account Name.
     *
     * @param  string  $accountName
     * @return $this
     */
    public function setAccountName($accountName);

    /**
     * Returns the GiftCardSystem API key.
     *
     * @return string
     */
    public function getEnvironment();

    /**
     * Sets the VTEX Account Name.
     *
     * @param  string  $environment
     * @return $this
     */
    public function setEnvironment($environment);

    /**
     * Returns the GiftCardSystem API key.
     *
     * @return string
     */
    public function getAppKey();

    /**
     * Sets the VTEX Account Name.
     *
     * @param  string  $appKey
     * @return $this
     */
    public function setAppKey($appKey);

    /**
     * Returns the GiftCardSystem API key.
     *
     * @return string
     */
    public function getAppToken();

    /**
     * Sets the VTEX Account Name.
     *
     * @param  string  $appToken
     * @return $this
     */
    public function setAppToken($appToken);
    
}