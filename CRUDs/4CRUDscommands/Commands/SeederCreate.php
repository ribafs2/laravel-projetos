<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SeederCreate extends Command
{
    protected $signature = 'seeder:create {table} {fields}';
    protected $description = 'Create migration';

    public function handle()
    {
    	// Receber variáveis
        $table = $this->argument('table');
        $tableUc = Str::of($table)->ucfirst();      
        $fields = $this->argument('fields');

        // Definir arquivo de stub
        $stub = app_path('Console/Commands/stubs/seeder.stub');
		// Open the file to get existing content
		$string = file_get_contents($stub);
		
		$fields = explode(',', $fields);
		$flds = '';

		foreach($fields as $type){
			$type = explode('#',$type);
						
			switch ($type[0]) {
				case 'string':
					$method ='name()';
					break;
				case 'date':
					$method ="date('Y_m_d')";
					break;
				case 'time':
					$method ="time('H_i_s')";
					break;
				case 'email':
					$method ='email()';
					break;
				case 'password':
					$method ='password()';
					break;
				case 'decimal':
					$method ='numberBetween(2, 200)';
					break;
				case 'number':
					$method ='numberBetween(0, 100)';
					break;
				case 'words':
					$method ='words(5)';
					break;
				case 'text':
					$method ='text)';
					break;
				default:
					$method ='name()';
					break;																					
			 }

			if($type[1] == 'price') $method = 'numberBetween(2, 200)';
			$flds .= "'$type[1]' => \$faker->$method,";							 
		}

		$string = str_replace('{{table}}', $table, $string);
		$string = str_replace('{{tableUc}}', $tableUc, $string);		
		$string = str_replace('{{fields}}', $flds, $string);		
		$name = $tableUc.'Seeder.php';
		$seeder = database_path('seeders/'.$name);		
		file_put_contents($seeder, $string);

		$this->info('=> Seeder criado com sucesso');	

		// php artisan migration:create products string#name,decimal#price
    }
}
