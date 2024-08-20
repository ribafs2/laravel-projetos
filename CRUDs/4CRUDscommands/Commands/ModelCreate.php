<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ModelCreate extends Command
{
    protected $signature = 'model:create {table} {fields}';
    protected $description = 'Create model';

    public function handle()
    {
    	// Receber variáveis
        $table = $this->argument('table');        
        $fields = $this->argument("fields");

        // Converter string em variável
		$fields = explode(',', $fields);
        
        // Adicionar delimitadores em cada campo
        $flds = '';       
        foreach($fields as $field){
            $field = explode('#', $field);
	        $field = $field[1];
        	$flds .= "'".$field."',";
        }
//	        dd($flds);       
        // Definir arquivo de stub
        $stub = app_path('Console/Commands/stubs/model.stub');        
		$string = file_get_contents($stub);
		
		// Mudar tabela para inicial maiúscula
		$tableUc = Str::of($table)->ucfirst();

		// Mudar tabela para seu singular
		$tableUcSing = Str::of($tableUc)->singular();
		
		// Substituir {{model}} por $tableUcSing no stub
		$string = str_replace('{{model}}', $tableUcSing, $string);		
		$string = str_replace('{{fields}}', $flds, $string);
	
		$model = app_path('Models/'.$tableUcSing.'.php');				
		file_put_contents($model, $string);
		$this->info('=> Model criado com sucesso');
		
		// php artisan model:create clients name,email
    }
}
