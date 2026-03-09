<?php

return [
    'base_url'      => env('ETIMS_BASE_URL'),
    'tin'           => env('ETIMS_TIN'),
    'bhf_id'        => env('ETIMS_BHF_ID'),
    'device_serial' => env('ETIMS_DEVICE_SERIAL'),

    // Added after device init
    'device_id'     => env('ETIMS_DEVICE_ID'),
    'sdc_id'        => env('ETIMS_SDC_ID'),
    'cmc_key'       => env('ETIMS_CMC_KEY'),
    'mrc_no'        => env('ETIMS_MRC_NO'),
];
