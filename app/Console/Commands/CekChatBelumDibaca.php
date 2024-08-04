<?php

namespace App\Console\Commands;

use App\Models\ChMessage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CekChatBelumDibaca extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cwd:cek-chat-belum-dibaca';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cek chat belum dibaca, lalu kirimkan email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $listChat = ChMessage::where('seen', 0)->get()->groupBy('to_id');

        foreach ($listChat as $chat) {
            Mail::to($chat[0]->userPenerima->email)->send(new \App\Mail\peringatanBacaChat($chat->count(), $chat[0]->userPenerima->nama));
            $this->info("Email Peringatan telah dikirimkan ke user : {$chat[0]->userPenerima->nama}");
        }
    }
}