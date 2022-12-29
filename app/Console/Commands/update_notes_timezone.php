<?php

namespace App\Console\Commands;

use App\Models\CrmNote;
use Illuminate\Console\Command;

class update_notes_timezone extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notes:update_timezone';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the timezone of the notes';

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
     * @return int
     */
    public function handle()
    {
        $notas = CrmNote::all();
        $bar = $this->output->createProgressBar(count($notas));
        $bar->start();
//        update the timezone of the notes to America/Tijuana
        foreach($notas as $nota){
            $nota->created_at = $nota->created_at->timezone('America/Tijuana');
            $nota->updated_at = $nota->updated_at->timezone('America/Tijuana');
            $nota->save();
            $bar->advance();
            $this->info('Nota con id: '. $nota->id .' actualizada');
        }
        $bar->finish();
    }
}
