<?php

namespace App\Console\Commands;

use App\Models\VerificationCode;
use Illuminate\Console\Command;

class CleanupExpiredVerificationCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verification-codes:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete expired and used verification codes';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $deleted = VerificationCode::where(function ($query) {
            $query->where('expires_at', '<', now())
                  ->orWhere('is_used', true);
        })->delete();

        $this->info("Deleted {$deleted} expired/used verification codes.");

        return Command::SUCCESS;
    }
}
