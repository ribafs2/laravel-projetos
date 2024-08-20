<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MigrationCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migration:create {table} {fields}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create migration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
    	// Receber variáveis
        $table = $this->argument('table');
        $fields = $this->argument('fields');

        // Definir arquivo de stub
        $stub = app_path('Console/Commands/stubs/migration.stub');
		// Open the file to get existing content
		$string = file_get_contents($stub);
		
		$fields = explode(',', $fields);
		$flds = '';
		foreach($fields as $field){
			$field = explode('#',$field);	
			$type=$field[0];
			$fld = $field[1];			
			//$field = implode(',',$field);
			$flds .= "\$table->$type('$fld');";
		}

		$string = str_replace('{{table}}', $table, $string);
		$string = str_replace('{{fieldsMig}}', $flds, $string);		
		$name = date('Y_m_d_His').'_create_'.$table.'_table.php';
		$mig = database_path('migrations/'.$name);		
		file_put_contents($mig, $string);

		$this->info('=> Migration criada com sucesso');	

		// php artisan migration:create products string#name,decimal#price
    }
}
