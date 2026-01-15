# Tutorial Menghubungkan Chatbot ke Dialogflow

Panduan lengkap untuk mengintegrasikan chatbot PGE Repository dengan Google Dialogflow.

## Daftar Isi
1. [Persiapan Google Cloud](#1-persiapan-google-cloud)
2. [Setup Dialogflow](#2-setup-dialogflow)
3. [Membuat Intent](#3-membuat-intent)
4. [Konfigurasi Laravel](#4-konfigurasi-laravel)
5. [Testing](#5-testing)

---

## 1. Persiapan Google Cloud

### 1.1 Buat Project di Google Cloud Console

1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Login dengan akun Google Anda
3. Klik **Select a project** → **New Project**
4. Isi nama project (contoh: `pge-chatbot`)
5. Klik **Create**
6. Tunggu hingga project selesai dibuat

### 1.2 Enable Dialogflow API

1. Di Google Cloud Console, buka menu **APIs & Services** → **Library**
2. Cari "Dialogflow API"
3. Klik **Dialogflow API**
4. Klik tombol **Enable**
5. Tunggu hingga API aktif

### 1.3 Buat Service Account

1. Buka menu **IAM & Admin** → **Service Accounts**
2. Klik **Create Service Account**
3. Isi detail:
   - **Service account name**: `dialogflow-service`
   - **Service account ID**: (otomatis terisi)
   - **Description**: `Service account for Dialogflow integration`
4. Klik **Create and Continue**
5. Pilih role: **Dialogflow API Admin**
6. Klik **Continue** → **Done**

### 1.4 Download Credentials JSON

1. Klik service account yang baru dibuat
2. Pilih tab **Keys**
3. Klik **Add Key** → **Create new key**
4. Pilih **JSON**
5. Klik **Create**
6. File JSON akan otomatis terdownload
7. **Simpan file ini dengan aman!**

---

## 2. Setup Dialogflow

### 2.1 Buat Agent di Dialogflow

1. Buka [Dialogflow Console](https://dialogflow.cloud.google.com/)
2. Login dengan akun Google yang sama
3. Klik **Create Agent**
4. Isi detail agent:
   - **Agent name**: `PGE-Assistant`
   - **Default language**: Indonesian (id)
   - **Default time zone**: (GMT+7:00) Asia/Jakarta
   - **Google Project**: Pilih project yang sudah dibuat
5. Klik **Create**

### 2.2 Catat Project ID

1. Di Dialogflow Console, klik icon **Settings** (⚙️) di samping nama agent
2. Pada tab **General**, lihat **Project ID**
3. **Catat Project ID ini** (contoh: `pge-chatbot-abcd`)

---

## 3. Membuat Intent

### 3.1 Intent: Greeting (Sapaan)

1. Di Dialogflow Console, klik **Intents** di menu kiri
2. Klik **Create Intent**
3. Isi:
   - **Intent name**: `greeting`
   - **Training phrases**: Tambahkan contoh kalimat
     ```
     halo
     hai
     hi
     hello
     selamat pagi
     selamat siang
     selamat sore
     selamat malam
     ```
   - **Responses**: Tambahkan response
     ```
     Halo! Selamat datang di ChatPGE. Saya siap membantu Anda. Apa yang bisa saya bantu hari ini?
     ```
4. Klik **Save**

### 3.2 Intent: Search Document

1. Klik **Create Intent**
2. Isi:
   - **Intent name**: `search_document`
   - **Training phrases**:
     ```
     bagaimana cara mencari dokumen
     cara cari dokumen
     gimana cari file
     cara search dokumen
     bagaimana mencari file
     ```
   - **Responses**:
     ```
     Untuk mencari dokumen di PGE Repository, Anda bisa:
     
     1. Gunakan kolom pencarian di halaman Documents
     2. Filter berdasarkan kategori atau divisi
     3. Gunakan kata kunci yang spesifik
     4. Anda juga bisa melihat dokumen berdasarkan rak penyimpanan
     
     Apakah ada yang ingin Anda cari?
     ```
3. Klik **Save**

### 3.3 Intent: About System

1. Klik **Create Intent**
2. Isi:
   - **Intent name**: `about_system`
   - **Training phrases**:
     ```
     apa itu pge repository
     tentang pge repository
     info pge repository
     apa fungsi sistem ini
     jelaskan tentang sistem ini
     ```
   - **Responses**:
     ```
     PGE Repository adalah sistem manajemen dokumen digital PT Pertamina Geothermal Energy. Sistem ini membantu Anda untuk:
     
     ✓ Menyimpan dokumen secara digital
     ✓ Mencari dokumen dengan mudah
     ✓ Mengelola dokumen berdasarkan kategori
     ✓ Mengakses dokumen kapan saja
     
     Sistem ini dirancang untuk memudahkan pengelolaan dan distribusi dokumen perusahaan.
     ```
3. Klik **Save**

### 3.4 Intent: Contact Support

1. Klik **Create Intent**
2. Isi:
   - **Intent name**: `contact_support`
   - **Training phrases**:
     ```
     bagaimana cara menghubungi support
     kontak support
     hubungi admin
     cara contact support
     nomor telepon support
     ```
   - **Responses**:
     ```
     Untuk menghubungi tim support PGE Repository:
     
     📧 Email: support@pge.id
     📞 Telepon: +62 123 456 789
     🏢 Kantor: Gedung Pertamina, Jakarta
     
     Tim kami siap membantu Anda pada jam kerja (Senin-Jumat, 08:00-17:00 WIB)
     ```
3. Klik **Save**

### 3.5 Intent: Thanks

1. Klik **Create Intent**
2. Isi:
   - **Intent name**: `thanks`
   - **Training phrases**:
     ```
     terima kasih
     thanks
     thank you
     makasih
     thx
     ```
   - **Responses**:
     ```
     Sama-sama! Senang bisa membantu Anda. Jika ada pertanyaan lain, jangan ragu untuk bertanya. 😊
     ```
3. Klik **Save**

---

## 4. Konfigurasi Laravel

### 4.1 Install Package Dialogflow

Buka terminal di folder project Laravel, jalankan:

```bash
composer require google/cloud-dialogflow
```

### 4.2 Simpan Credentials File

1. Buat folder untuk credentials:
```bash
mkdir storage/app/credentials
```

2. Copy file JSON yang sudah didownload ke folder tersebut
3. Rename file menjadi nama yang mudah diingat (contoh: `dialogflow-credentials.json`)

### 4.3 Update File .env

Tambahkan konfigurasi berikut di file `.env`:

```env
# Dialogflow Configuration
DIALOGFLOW_PROJECT_ID=pge-chatbot-abcd
DIALOGFLOW_CREDENTIALS_PATH=storage/app/credentials/dialogflow-credentials.json
DIALOGFLOW_LANGUAGE_CODE=id
```

**Ganti `pge-chatbot-abcd` dengan Project ID Anda!**

### 4.4 Buat File Konfigurasi

Buat file `config/dialogflow.php`:

```php
<?php

return [
    'project_id' => env('DIALOGFLOW_PROJECT_ID', ''),
    'language_code' => env('DIALOGFLOW_LANGUAGE_CODE', 'id'),
    'credentials' => env(
        'DIALOGFLOW_CREDENTIALS_PATH',
        storage_path('app/credentials/dialogflow-credentials.json')
    ),
];
```

### 4.5 Buat DialogflowService

Buat file `app/Services/DialogflowService.php`:

```php
<?php

namespace App\Services;

use Google\Cloud\Dialogflow\V2\Client\SessionsClient;
use Google\Cloud\Dialogflow\V2\QueryInput;
use Google\Cloud\Dialogflow\V2\TextInput;
use Google\Cloud\Dialogflow\V2\DetectIntentRequest;

class DialogflowService
{
    public function detectIntent(string $text, string $sessionId): array
    {
        $projectId = config('dialogflow.project_id');
        $languageCode = config('dialogflow.language_code', 'id');
        $credentialsPath = config('dialogflow.credentials');

        if (!$projectId || !$credentialsPath) {
            return [
                'fulfillmentText' => 'Konfigurasi Dialogflow belum lengkap.',
                'intent' => null,
            ];
        }

        if (!file_exists($credentialsPath)) {
            return [
                'fulfillmentText' => 'File kredensial Dialogflow tidak ditemukan.',
                'intent' => null,
            ];
        }

        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $credentialsPath);

        try {
            $sessionsClient = new SessionsClient();
            $session = $sessionsClient->sessionName($projectId, $sessionId);

            $textInput = (new TextInput())
                ->setText($text)
                ->setLanguageCode($languageCode);

            $queryInput = (new QueryInput())
                ->setText($textInput);

            $request = (new DetectIntentRequest())
                ->setSession($session)
                ->setQueryInput($queryInput);

            $response = $sessionsClient->detectIntent($request);
            $queryResult = $response->getQueryResult();
            $intent = $queryResult->getIntent();

            $sessionsClient->close();

            return [
                'fulfillmentText' => $queryResult->getFulfillmentText(),
                'intent' => $intent ? $intent->getDisplayName() : null,
            ];
        } catch (\Exception $e) {
            \Log::error('Dialogflow Error: ' . $e->getMessage());
            
            return [
                'fulfillmentText' => 'Maaf, terjadi kesalahan: ' . $e->getMessage(),
                'intent' => null,
            ];
        }
    }
}
```

### 4.6 Update ChatbotController

Update file `app/Http/Controllers/ChatbotController.php`:

```php
<?php

namespace App\Http\Controllers;

use App\Models\ChatLog;
use App\Models\ChatSession;
use App\Services\DialogflowService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class ChatbotController extends Controller
{
    public function __construct(
        protected DialogflowService $dialogflowService
    ) {
    }

    public function index()
    {
        return view('chatbot.index');
    }

    public function send(Request $request): JsonResponse
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $user = Auth::user();
        $sessionId = $request->session()->getId();

        $chatSession = ChatSession::firstOrCreate(
            ['session_id' => $sessionId],
            ['session_start' => now()]
        );

        $chatSession->update(['session_end' => now()]);

        // Simpan pesan user
        $userLog = ChatLog::create([
            'chat_id' => $chatSession->id,
            'detected_intent' => null,
            'sender' => $user?->role === 'admin' ? 'admin' : 'user',
            'timestamp' => Carbon::now(),
            'message_text' => $data['message'],
        ]);

        // Kirim ke Dialogflow
        $dialogflowResult = $this->dialogflowService->detectIntent(
            $data['message'],
            $sessionId
        );

        $replyText = $dialogflowResult['fulfillmentText'] ?? 'Maaf, chatbot belum dapat merespon.';

        // Simpan balasan bot
        $botLog = ChatLog::create([
            'chat_id' => $chatSession->id,
            'detected_intent' => $dialogflowResult['intent'] ?? null,
            'sender' => 'bot',
            'timestamp' => Carbon::now(),
            'message_text' => $replyText,
        ]);

        return response()->json([
            'success' => true,
            'message' => $replyText,
            'intent' => $dialogflowResult['intent'] ?? null,
            'user_log_id' => $userLog->id,
            'bot_log_id' => $botLog->id,
        ]);
    }

    public function history()
    {
        $logs = ChatLog::with('session')
            ->orderByDesc('timestamp')
            ->paginate(20);

        return view('admin.chat-history', ['logs' => $logs]);
    }
}
```

### 4.7 Clear Cache

Jalankan perintah berikut:

```bash
php artisan config:clear
php artisan cache:clear
php artisan config:cache
```

---

## 5. Testing

### 5.1 Test di Browser

1. Jalankan server Laravel:
```bash
php artisan serve
```

2. Buka browser dan akses halaman chatbot
3. Login ke sistem
4. Buka halaman chatbot
5. Coba kirim pesan:
   - "Halo"
   - "Bagaimana cara mencari dokumen?"
   - "Apa itu PGE Repository?"
   - "Terima kasih"

### 5.2 Cek Log

Jika ada error, cek log Laravel:
```bash
tail -f storage/logs/laravel.log
```

### 5.3 Test di Dialogflow Console

1. Buka Dialogflow Console
2. Klik **Try it now** di panel kanan
3. Ketik pesan test
4. Lihat response yang muncul

---

## Troubleshooting

### Error: "Class SessionsClient not found"

**Solusi:**
```bash
composer dump-autoload
composer require google/cloud-dialogflow
```

### Error: "Credentials file not found"

**Solusi:**
- Pastikan file JSON ada di `storage/app/credentials/`
- Cek path di file `.env`
- Pastikan nama file sesuai

### Error: "Permission denied"

**Solusi:**
```bash
chmod -R 755 storage/app/credentials
```

### Error: "Invalid credentials"

**Solusi:**
- Download ulang file JSON dari Google Cloud Console
- Pastikan Service Account memiliki role **Dialogflow API Admin**
- Pastikan API Dialogflow sudah di-enable

### Response selalu "Maaf, chatbot belum dapat merespon"

**Solusi:**
- Pastikan intent sudah dibuat di Dialogflow
- Cek training phrases sudah sesuai
- Test di Dialogflow Console terlebih dahulu
- Cek Project ID sudah benar

---

## Tips & Best Practices

### 1. Keamanan Credentials

- **JANGAN** commit file JSON ke Git
- Tambahkan ke `.gitignore`:
```
storage/app/credentials/*.json
```

### 2. Training Phrases

- Tambahkan minimal 10-20 variasi per intent
- Gunakan bahasa yang natural
- Sertakan typo umum
- Tambahkan variasi formal dan informal

### 3. Response

- Buat response yang jelas dan informatif
- Gunakan emoji untuk membuat lebih friendly
- Sertakan langkah-langkah jika perlu
- Tambahkan multiple responses untuk variasi

### 4. Testing

- Test setiap intent setelah dibuat
- Test dengan berbagai variasi kalimat
- Minta user lain untuk test
- Monitor chat log untuk improve intent

### 5. Maintenance

- Review chat log secara berkala
- Tambahkan intent baru sesuai kebutuhan
- Update training phrases berdasarkan user input
- Improve response berdasarkan feedback

---

## Referensi

- [Dialogflow Documentation](https://cloud.google.com/dialogflow/docs)
- [Google Cloud PHP Client](https://github.com/googleapis/google-cloud-php)
- [Dialogflow Console](https://dialogflow.cloud.google.com/)
- [Google Cloud Console](https://console.cloud.google.com/)

---

## Support

Jika mengalami kesulitan, hubungi:
- Email: support@pge.id
- Telepon: +62 123 456 789

---

**Selamat mencoba! 🚀**
