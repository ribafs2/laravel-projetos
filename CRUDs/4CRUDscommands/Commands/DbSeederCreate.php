<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class DbSeederCreate extends Command
{
    protected $signature = 'dbseeder:create {table}';
    protected $description = 'Create db seeder';

    public function handle()
    {
    	// Receber variáveis
        $table = $this->argument('table');
        $tableUc = Str::of($table)->ucfirst();      

        // Definir arquivo de stub
        $stub = app_path('Console/Commands/stubs/db.stub');
		// Open the file to get existing content
		$string = file_get_contents($stub);

		$string = str_replace('{{tableUc}}', $tableUc, $string);		
		$name = 'DatabaseSeeder.php';
		$dbs = database_path('seeders/'.$name);		
		file_put_contents($dbs, $string);

		$this->info('=> Migration criada com sucesso');	

		// php artisan migration:create products string#name,decimal#price
    }
}
