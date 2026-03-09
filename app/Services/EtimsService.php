<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EtimsService
{
    /**
     * Initialize device (already done)
     */
    public function initDevice()
    {
        $payload = [
            'tin'      => config('etims.tin'),
            'bhfId'    => config('etims.bhf_id'),
            'dvcSrlNo' => config('etims.device_serial'),
        ];

        $response = Http::post(config('etims.base_url') . '/selectInitOsdcInfo', $payload);

           Log::info('eTIMS code tables response', [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);

        return $response;
    }

public function downloadCodeTables()
{
    // 1. Ensure the URL is exactly correct
    $baseUrl = rtrim(config('etims.base_url'), '/');
    // For Sandbox OSDC, the path is usually exactly this:
    $endpoint = $baseUrl . '/dg/vscu/api/selectCommonCodeList';

    $payload = [
        'tin'       => config('etims.tin'),
        'bhfId'     => config('etims.bhf_id'),
        'dvcId'     => config('etims.device_id'),
        'sdcId'     => config('etims.sdc_id'),
        'mrcNo'     => config('etims.mrc_no'),
        'cmcKey'    => config('etims.cmc_key'),
        'lastReqDt' => '20230101000000', // Use a recent date
    ];

    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Accept'       => 'application/json',
    ])
    ->withoutVerifying() // Prevents SSL issues in local dev
    ->post($endpoint, $payload);

    Log::info('eTIMS Debug', [
        'url' => $endpoint,
        'response' => $response->json()
    ]);

    return $response;
}


    /**
     * Register an item in sandbox
     */
    public function registerItem(array $item)
    {
        $payload = array_merge($item, [
            'tin'   => config('etims.tin'),
            'bhfId' => config('etims.bhf_id'),
            'dvcId' => config('etims.device_id'),
            'sdcId' => config('etims.sdc_id'),
            'cmcKey'=> config('etims.cmc_key'),
        ]);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ])->post(config('etims.base_url') . '/saveItem', $payload);

           Log::info('Register tables response', [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);

        return $response;
    }

    /**
     * Create a sandbox invoice
     */
    public function createInvoice(array $invoice)
    {
        $payload = array_merge($invoice, [
            'tin'   => config('etims.tin'),
            'bhfId' => config('etims.bhf_id'),
            'dvcId' => config('etims.device_id'),
            'sdcId' => config('etims.sdc_id'),
            'cmcKey'=> config('etims.cmc_key'),
        ]);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ])->post(config('etims.base_url') . '/saveSales', $payload);

        Log::info('Create invoice response', $response->body());

        return $response;
    }
}
