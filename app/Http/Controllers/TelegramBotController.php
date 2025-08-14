<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Log untuk debugging
        Log::info('Telegram Update', $request->all());

        $update = $request->all();

        // Ambil message standar
        $message = $update['message'] ?? $update['edited_message'] ?? null;
        if (!$message) {
            return response('ok', 200);
        }

        $chatId = $message['chat']['id'] ?? null;
        $text   = trim(($message['text'] ?? ''));

        if (!$chatId) {
            return response('ok', 200);
        }

        // Respon dasar
        if ($text === '/start') {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => "Halo 👋\nKetik /laporan untuk melihat ringkasan keuangan Banijo Farm.",
            ]);
            return response('ok', 200);
        }

        if (stripos($text, '/laporan') === 0) {
            // Hitung dari database kamu
            $totalPemasukan  = (float) Pemasukan::sum('jumlah');
            $totalPengeluaran = (float) Pengeluaran::sum('jumlah');
            $saldo           = $totalPemasukan - $totalPengeluaran;

            $msg  = "📊 *Laporan Keuangan Banijo Farm*\n";
            $msg .= "Pemasukan : Rp " . number_format($totalPemasukan, 0, ',', '.') . "\n";
            $msg .= "Pengeluaran : Rp " . number_format($totalPengeluaran, 0, ',', '.') . "\n";
            $msg .= "Saldo : *Rp " . number_format($saldo, 0, ',', '.') . "*";

            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => $msg,
                'parse_mode' => 'Markdown',
            ]);
            return response('ok', 200);
        }

        // Fallback help
        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => "Perintah tidak dikenal. Coba:\n/start\n/laporan",
        ]);

        return response('ok', 200);
    }
}
