<?php

namespace Bavix\Wallet\Simple;

use Bavix\Wallet\Interfaces\ExchangeInterface;
use Bavix\Wallet\Interfaces\Rateable;
use Bavix\Wallet\Interfaces\Wallet;

/**
 * Class Rate.
 *
 * @deprecated Not used anymore
 * @see Exchange
 */
class Rate implements Rateable
{
    /**
     * @var string
     */
    protected $amount;

    /**
     * @var \Bavix\Wallet\Models\Wallet|Wallet
     */
    protected $withCurrency;

    private $exchange;

    public function __construct(ExchangeInterface $exchange)
    {
        $this->exchange = $exchange;
    }

    /**
     * {@inheritdoc}
     */
    public function withAmount($amount): Rateable
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withCurrency(Wallet $wallet): Rateable
    {
        $this->withCurrency = $wallet;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function convertTo(Wallet $wallet)
    {
        /** @var \Bavix\Wallet\Models\Wallet $wallet */
        return $this->exchange->convertTo(
            $this->withCurrency->currency,
            $wallet->currency,
            $this->amount
        );
    }
}
