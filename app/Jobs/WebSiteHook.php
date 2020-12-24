<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use function GuzzleHttp\Psr7\str;

class WebSiteHook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $customer_id;
    private $order_id;
    private $description;
    private $amount;


    public function __construct($customer_id, $order_id, $amount, $description)
    {
        $this->customer_id = $customer_id;
        $this->order_id = $order_id;
        $this->amount = $amount;
        $this->description = $description;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client();
        $url   = "https://webhook.site/1baceb48-7102-4206-96e4-01609f53da70";
        $data   = [
            'customer_id' => $this->customer_id,
            'order_id' => $this->order_id,
            'amount' => $this->amount,
            'description' => $this->description
        ];

        $client->postAsync ( $url, [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode($data)
        ])->wait();

    }
}
