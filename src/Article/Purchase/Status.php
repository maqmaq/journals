<?php

namespace Article\Purchase;

/**
 * Class Status
 * @package Article\Purchase
 */
class Status
{

    /**
     * Authentication is required to purchase
     */
    public const STATUS_AUTHENTICATION_REQUIRED = 'authentication_required';

    /*
     * Article is already purchased
     */
    public const STATUS_ALREADY_PURCHASED = 'already_purchased';

    /**
     * User has not enough funds to purchase article
     */
    public const STATUS_NOT_ENOUGH_FUNDS = 'not_enough_funds';

    /**
     * Article purchased successfully, user grant access
     */
    public const STATUS_PURCHASE_ERROR = 'purchase_error';
    /**
     * Error during purchasing
     */
    public const STATUS_PURCHASE_SUCCESS = 'purchase_success';


}