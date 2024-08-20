<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ControllerCreate extends Command
{
    protected $signature = 'controller:create {table}';
    protected $description = 'Create controller';

    public function handle()
    {
    	// Receber variáveis
        $table = $this->argument('table');
        $tableSing = Str::of($table)->singular();
        $tableUcSing = Str::of($tableSing)->ucfirst();

        // Definir arquivo de stub
        $stub = app_path('Console/Commands/stubs/controller.stub');

		// Open the file to get existing content
		$string = file_get_contents($stub);

		$string = str_replace('{{table}}', $table, $string);
		$string = str_replace('{{tableSing}}', $tableSing, $string);
		$string = str_replace('{{tableUcSing}}', $tableUcSing, $string);
		$string = str_replace('{{model}}', $tableUcSing, $string);		
		$string = str_replace('{{controller}}', $tableUcSing.'Controller', $string);
				
		$control = app_path('Http/Controllers/'.$tableUcSing.'Controller.php');		
		file_put_contents($control, $string);
		$this->info('=> Controller criado com sucesso');
		
		// Chamar com
		// php artisan controller:create clients
    }
}
