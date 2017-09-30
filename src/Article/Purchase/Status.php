<?php

namespace Article\Purchase;

/**
 * Class Status
 * @package Article\Purchase
 */
class Status
{
    /*
     * Article is already purchased
     */
    const STATUS_ALREADY_PURCHASED = 'already_purchased';

    /**
     * User has not enough funds to purchase article
     */
    const STATUS_NOT_ENOUGH_FUNDS = 'not_enought_funds';

    /**
     * Article purchased successfully, user grant access
     */
    const STATUS_PURCHASE_ERROR = 'purchase_error';
    /**
     * Error during purchasing
     */
    const STATUS_PURCHASE_SUCCESS = 'purchase_success';



}