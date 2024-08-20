<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ViewsCreate extends Command
{
    protected $signature = 'views:create {table} {fields}';

    protected $description = 'Command views';

    public function handle()
    {
   	// Receber variáveis
        $table = $this->argument('table');
        $fields = $this->argument('fields');
        $tableSing = Str::of($table)->singular();
        $tableUcSing = Str::of($tableSing)->ucfirst();
        $title = Str::of($table)->ucfirst();        

		$fields = explode(',', $fields);
		$fldsCreate = '';
		foreach($fields as $field){
            $field = explode('#', $field);
	        $field = $field[1];
			$placeholder = ucfirst($field);
			$fldsCreate .=
"        <div class=\"col-xs-12 col-sm-12 col-md-12\">
            <div class=\"form-group\">
                <strong>$placeholder:</strong>
                <input type=\"text\" name=\"$field\" class=\"form-control\" placeholder=\"$placeholder\">
            </div>
        </div>
";
		}	

		$fldEdit = '';
		foreach($fields as $field){
            $field = explode('#', $field);
	        $field = $field[1];		
			$placeholder = ucfirst($field);
			$fldEdit .=
"            <div class=\"col-xs-12 col-sm-12 col-md-12\">
                <div class=\"form-group\">
                    <strong>$placeholder:</strong>
                    <input type=\"text\" name=\"$field\" value=\"{{ $$tableSing->$field }}\" class=\"form-control\" placeholder=\"$placeholder\">
                </div>
            </div>
";
		}	
		$indexCap = '';
		$indexNam = '';
		foreach($fields as $field){
            $field = explode('#', $field);
	        $field = $field[1];		
			$placeholder = ucfirst($field);
			$indexCap .= "<th>$placeholder</th>";
			$indexNam .= "<td><?=$$tableSing->$field?></td>";
		}			

        // Create
        $stub = app_path('Console/Commands/stubs/views/create.stub');
		// Open the file to get existing content
		$string = file_get_contents($stub);
		
		$fldsShow = '';
		foreach($fields as $field){
            $field = explode('#', $field);
	        $field = $field[1];		
			$placeholder = ucfirst($field);
			$fldsShow .=
"<div class=\"col-xs-12 col-sm-12 col-md-12\">
            <div class=\"form-group\">
                <strong>$placeholder:</strong>
                {{ $$tableSing->$field }}
            </div>
        </div>
";
		}			

		$string = str_replace('{{table}}', $table,$string);
		$string = str_replace('{{tableSing}}', $tableSing,$string);
		$string = str_replace('{{tableUcSing}}', $tableUcSing,$string);		
		$string = str_replace('{{fieldsCreate}}', $fldsCreate,$string);
		// A pasta precisa existir, então criar
		$path = resource_path().'/views/'.$table;
		File::makeDirectory($path, $mode = 0777, true, true);		
		$create = resource_path('views/'.$table.'/create.blade.php');		
		file_put_contents($create, $string);

        // Edit
        $stub = app_path('Console/Commands/stubs/views/edit.stub');
		// Open the file to get existing content
		$string = file_get_contents($stub);

		$string = str_replace('{{table}}', $table,$string);
		$string = str_replace('{{tableSing}}', $tableSing,$string);
		$string = str_replace('{{tableUcSing}}', $tableUcSing,$string);	
		$string = str_replace('{{fieldsEdit}}', $fldEdit,$string);	
		$edit = resource_path('views/'.$table.'/edit.blade.php');		
		file_put_contents($edit, $string);	
		
        // Index
        $stub = app_path('Console/Commands/stubs/views/index.stub');
		// Open the file to get existing content
		$string = file_get_contents($stub);

		$string = str_replace('{{table}}', $table,$string);
		$string = str_replace('{{tableSing}}', $tableSing, $string);
		$string = str_replace('{{tableUcSing}}', $tableUcSing, $string);
		$string = str_replace('{{indexCap}}', $indexCap,$string);
		$string = str_replace('{{indexNam}}', $indexNam,$string);
		$string = str_replace('{{title}}', $title,$string);		
		$index = resource_path('views/'.$table.'/index.blade.php');		
		file_put_contents($index, $string);	

        // Layout
        $stub = app_path('Console/Commands/stubs/views/layout.stub');
		// Open the file to get existing content
		$string = file_get_contents($stub);
		$layout = resource_path('views/'.$table.'/layout.blade.php');		
		file_put_contents($layout, $string);	

        // Show
        $stub = app_path('Console/Commands/stubs/views/show.stub');
		// Open the file to get existing content
		$string = file_get_contents($stub);
		$string = str_replace('{{table}}', $table, $string);
		$string = str_replace('{{fieldsShow}}', $fldsShow, $string);
		$show = resource_path('views/'.$table.'/show.blade.php');		
		file_put_contents($show, $string);	
		$this->info('=> Views criadas em resource/views/'.$table);

		// php artisan views:create clients name,email
    }
}
