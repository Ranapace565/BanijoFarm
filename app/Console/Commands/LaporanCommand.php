<?php

namespace App\Console\Commands;

use Telegram\Bot\Commands\Command;

class LaporanCommand extends Command
{
    protected string $name = 'laporan';
    protected string $description = 'Menampilkan laporan dari sistem';

    public function handle()
    {
        $this->replyWithMessage([
            'text' => "📊 Ini adalah laporan terbaru:\n- Penjualan: 10 item\n- Total: Rp1.000.000"
        ]);
    }
}
