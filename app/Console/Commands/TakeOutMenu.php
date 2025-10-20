<?php

namespace App\Console\Commands;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class TakeOutMenu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:take-out-menu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate and save the take-out cans PDF menu';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Generating take-out PDF...');
        $path = public_path('take-out-cans.pdf');

        File::delete($path);
        Pdf::loadView('list')->save($path);

        $this->info('Take-out PDF generated successfully.');

        return Command::SUCCESS;
    }
}
