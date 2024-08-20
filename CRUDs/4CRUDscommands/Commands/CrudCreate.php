<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CrudCreate extends Command
{
    protected $signature = 'crud:create {table} {fields}';

    protected $description = 'Create CRUD';

    public function handle()
    {
        $table = $this->argument('table');
        $fields = $this->argument('fields');       

        Artisan::call("migration:create $table $fields");
        Artisan::call("model:create $table $fields");
        Artisan::call("controller:create $table");        
        Artisan::call("route:create $table");
        Artisan::call("views:create $table $fields");
        Artisan::call("seeder:create $table $fields");
        Artisan::call("dbseeder:create $table");                
        
        $this->info(PHP_EOL.'=> CRUD criado com sucesso, Agora faça os ajustes na migration, no seeder e no controller e rode novamente o comando de criação do CRUD'.PHP_EOL);
        
        // php artisan crud:create products string#name,decimal#price
    }
}
