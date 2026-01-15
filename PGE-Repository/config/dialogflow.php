<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Dialogflow Configuration
    |--------------------------------------------------------------------------
    |
    | Konfigurasi untuk integrasi dengan Google Dialogflow
    |
    */

    'project_id' => env('DIALOGFLOW_PROJECT_ID', ''),

    'language_code' => env('DIALOGFLOW_LANGUAGE_CODE', 'id'),

    'credentials' => env(
        'DIALOGFLOW_CREDENTIALS_PATH',
        storage_path('app/credentials/dialogflow-credentials.json')
    ),
];
