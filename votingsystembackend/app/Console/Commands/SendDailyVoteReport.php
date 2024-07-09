<?php

namespace App\Console\Commands;

use DB;
use App\Models\Vote;
use App\Mail\DailyVoteReport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailyVoteReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:daily-vote-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a daily email report of vote totals';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $voteTotals = Vote::select('choice', DB::raw('count(*) as total'))
            ->groupBy('choice')
            ->get()
            ->pluck('total', 'choice')
            ->toArray();

        Mail::to('dev@unifysoftware.com')->send(new DailyVoteReport($voteTotals));

        $this->info('Daily vote report sent successfully.');
    }
}
