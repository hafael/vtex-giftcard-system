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

namespace Hafael\VTEX\GiftCardSystem\Api;


class GiftCards extends Api
{

    /**
     * Users who viewed the specified item also viewed the returned items. At most 15 items are returned, results are sorted by relevance.
     *
     * @param $customerID
     * @return array|mixed
     */
    public function listGiftCards($customerID)
    {
        return $this->_get("giftCards", [
            "customerId" => $customerID
        ]);
    }

    /**
     * Users who rated the specified item 'good' did the same with items returned by this method. At most 15 items are returned, results are sorted by relevance.
     *
     * @param $customerID
     * @param $cardName
     * @param $caption
     * @param $expiringDate
     * @param $multipleCredits
     * @param $multipleRedemptions
     * @return array|mixed
     */
    public function createGiftCard($customerID, string $cardName, string $caption = null, \DateTime $expiringDate, bool $multipleCredits = true, bool $multipleRedemptions = true)
    {
        return $this->_post("giftCards", [], [
            'customerId' => $customerID,
            'cardName' => $cardName,
            'caption' => $caption,
            'expiringDate' => $expiringDate->format('Y-m-d'),
            'multipleCredits' => $multipleCredits,
            'multipleRedemptions' => $multipleRedemptions,
        ]);
    }

    /**
     * Users who rated the specified item 'good' did the same with items returned by this method. At most 15 items are returned, results are sorted by relevance.
     *
     * @param $giftCardID
     * @param $value
     * @param $description
     * @return array|mixed
     */
    public function addCredits($giftCardID, $value, $description = null)
    {
        return $this->_post("giftCards/".$giftCardID."/credit", [], [
            'value' => $value, 
            'description' => $description
        ]);
    }

    /**
     * Users who rated the specified item 'good' did the same with items returned by this method. At most 15 items are returned, results are sorted by relevance.
     *
     * @param $giftCardID
     * @param $value
     * @param $description
     * @return array|mixed
     */
    public function removeCredits($giftCardID, $value, $description = null)
    {
        return $this->_post("giftCards/".$giftCardID."/credit", [], [
            'value' => $value, 
            'description' => $description
        ]);
    }

    /**
     * Users who rated the specified item 'good' did the same with items returned by this method. At most 15 items are returned, results are sorted by relevance.
     *
     * @param $giftCardID
     * @param array $data
     * @return array|mixed
     */
    public function expirationDate($giftCardID, \DateTime $expiringDate)
    {
        return $this->_post("giftCards/".$giftCardID, [], [
            'expiringDate' => $expiringDate->format('Y-m-d')
        ]);
    }

}