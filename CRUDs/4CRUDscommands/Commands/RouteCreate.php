<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class RouteCreate extends Command
{
    protected $signature = 'route:create {table}';

    protected $description = 'Create route';

    public function handle()
    {
        $table = $this->argument('table');
        $tableSing = Str::of($table)->singular();
        $tableUcSing = Str::of($tableSing)->ucfirst();        
		$controller = $tableUcSing.'Controller';
		
        $stub = app_path('Console/Commands/stubs/route.stub');
		// Open the file to get existing content
		$string = file_get_contents($stub);

		$string = str_replace('{{controller}}', $controller, $string);
		$string = str_replace('{{table}}', $table, $string);
		$route = base_path('routes/web.php');		
		file_put_contents($route, $string);

		$this->info('=> Rota criada com sucesso');			
		
		// Chamar com
		// php artisan route:create clients
    }
}
