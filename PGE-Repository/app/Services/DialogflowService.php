<?php

namespace App\Services;

use Google\Cloud\Dialogflow\V2\Client\SessionsClient;
use Google\Cloud\Dialogflow\V2\QueryInput;
use Google\Cloud\Dialogflow\V2\TextInput;
use Google\Cloud\Dialogflow\V2\DetectIntentRequest;

class DialogflowService
{
    /**
     * Mengirim teks ke Dialogflow dan mengembalikan response.
     *
     * @param  string  $text
     * @param  string  $sessionId
     * @return array{fulfillmentText:string|null,intent:string|null}
     */
    public function detectIntent(string $text, string $sessionId): array
    {
        $projectId = config('dialogflow.project_id');
        $languageCode = config('dialogflow.language_code', 'id');
        $credentialsPath = config('dialogflow.credentials');

        // Validasi konfigurasi
        if (!$projectId || !$credentialsPath) {
            \Log::error('Dialogflow config missing', [
                'project_id' => $projectId,
                'credentials_path' => $credentialsPath
            ]);
            
            return [
                'fulfillmentText' => 'Konfigurasi Dialogflow belum lengkap. Silakan hubungi administrator.',
                'intent' => null,
            ];
        }

        // Cek file credentials
        if (!file_exists($credentialsPath)) {
            \Log::error('Dialogflow credentials file not found', [
                'path' => $credentialsPath
            ]);
            
            return [
                'fulfillmentText' => 'File kredensial Dialogflow tidak ditemukan.',
                'intent' => null,
            ];
        }

        // Set kredensial
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $credentialsPath);

        try {
            // Buat session client
            $sessionsClient = new SessionsClient();
            $session = $sessionsClient->sessionName($projectId, $sessionId);

            // Buat text input
            $textInput = (new TextInput())
                ->setText($text)
                ->setLanguageCode($languageCode);

            // Buat query input
            $queryInput = (new QueryInput())
                ->setText($textInput);

            // Buat request
            $request = (new DetectIntentRequest())
                ->setSession($session)
                ->setQueryInput($queryInput);

            // Kirim request ke Dialogflow
            $response = $sessionsClient->detectIntent($request);
            $queryResult = $response->getQueryResult();
            $intent = $queryResult->getIntent();

            // Close client
            $sessionsClient->close();

            // Return hasil
            return [
                'fulfillmentText' => $queryResult->getFulfillmentText(),
                'intent' => $intent ? $intent->getDisplayName() : null,
            ];
            
        } catch (\Exception $e) {
            \Log::error('Dialogflow API Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            
            return [
                'fulfillmentText' => 'Maaf, terjadi kesalahan saat menghubungi Dialogflow. Silakan coba lagi.',
                'intent' => null,
            ];
        }
    }
}
