<?php

namespace Paymish;

use Paymish\Http\PaymishClient;
use Illuminate\Support\Facades\Config;

class Paymish
{
    protected $client;

    public function __construct()
    {
        $this->client = new PaymishClient();
    }

    /**
     * Initialize a new payment
     *
     * @param array $data
     * @return array
     */
    public function initializePayment(array $data)
    {
        return $this->client->post('/payments/initialize', $data);
    }

    /**
     * Verify a payment transaction
     *
     * @param string $reference
     * @return array
     */
    public function verifyPayment(string $reference)
    {
        return $this->client->get("/payments/verify/{$reference}");
    }

    /**
     * Fetch details of a specific transaction
     *
     * @param string $transactionId
     * @return array
     */
    public function getTransaction(string $transactionId)
    {
        return $this->client->get("/transactions/{$transactionId}");
    }

    /**
     * List all transactions
     *
     * @param array $filters
     * @return array
     */
    public function listTransactions(array $filters = [])
    {
        return $this->client->get("/transactions", $filters);
    }

    /**
     * Refund a transaction
     *
     * @param string $transactionId
     * @return array
     */
    public function refundTransaction(string $transactionId)
    {
        return $this->client->post("/transactions/refund/{$transactionId}");
    }

    /**
     * Set up a webhook endpoint
     *
     * @param string $url
     * @return array
     */
    public function setupWebhook(string $url)
    {
        return $this->client->post("/webhooks/setup", ['url' => $url]);
    }
}
