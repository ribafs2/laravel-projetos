Cron Jobs

Por que precisamos usar um cron job? E quais são os benefícios de usar cron jobs no Laravel 11 e como configurar cron jobs no Laravel 11? Se você tem essas perguntas, então eu explicarei o porquê. Muitas vezes precisamos enviar notificações ou e-mails automaticamente para usuários para atualizar propriedades ou produtos. Então, naquele momento, você pode definir alguma lógica básica para cada dia, hora, etc., para executar e enviar notificações por e-mail.

Aqui, eu darei a você um exemplo muito simples. Nós criaremos um comando cron job para obter usuários de uma API e criar novos usuários em nosso banco de dados. Nós definiremos tarefas para serem feitas automaticamente a cada minuto. Você pode escrever sua própria lógica no comando. Eu também mostrarei como configurar um cron job no servidor com o Laravel 11. Então, vamos seguir os passos abaixo para fazer este exemplo.

composer create-project laravel/laravel cron-job

cd cron-job

php artisan make:command DemoCron --command=demo:cron

Ajustes

app/Console/Commands/DemoCron.php

<?php
namespace App\Console\Commands;
  
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\User;
  
class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
  
    /**
     * Execute the console command.
     */
    public function handle()
    {
        info("Cron Job running at ". now());
      
        /*------------------------------------------
        --------------------------------------------
        Write Your Logic Here....
        I am getting users and create new users if not exist....
        --------------------------------------------
        --------------------------------------------*/
        $response = Http::get('https://jsonplaceholder.typicode.com/users');
          
        $users = $response->json();
      
        if (!empty($users)) {
            foreach ($users as $key => $user) {
                if(!User::where('email', $user['email'])->exists() ){
                    User::create([
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'password' => bcrypt('123456789')
                    ]);
                }
            }
        }
    }
}

Cadastre-se como Agendador de Tarefas

Nesta etapa, precisamos definir nossos comandos no arquivo console.php com o horário em que você deseja executar seu comando, conforme mostrado nas funções a seguir:

->everyMinute();	Run the task every minute
->everyFiveMinutes();	Run the task every five minutes
->everyTenMinutes();	Run the task every ten minutes
->everyFifteenMinutes();	Run the task every fifteen minutes
->everyThirtyMinutes();	Run the task every thirty minutes
->hourly();	Run the task every hour
->hourlyAt(17);	Run the task every hour at 17 mins past the hour
->daily();	Run the task every day at midnight
->dailyAt(â€™13:00â€²);	Run the task every day at 13:00
->twiceDaily(1, 13);	Run the task daily at 1:00 & 13:00
->weekly();	Run the task every week
->weeklyOn(1, â€˜8:00â€™);	Run the task every week on Tuesday at 8:00
->monthly();	Run the task every month
->monthlyOn(4, â€™15:00â€²);	Run the task every month on the 4th at 15:00
->quarterly();	Run the task every quarter
->yearly();	Run the task every year
->timezone(â€˜America/New_Yorkâ€™);	Set the timezone

routes/console.php

<?php 
use Illuminate\Support\Facades\Schedule;
  
Schedule::command('demo:cron')->everyMinute();

Testar manualmente

php artisan schedule:run

2024-08-15 21:21:51 Running ['artisan' demo:cron] ...

Ver os logs em
cat storage/logs/laravel.log

Configurar no servidor

crontab -e

* * * * * cd /backup/usb/progecia/0Projetos/0SitesAppsCriacao/0Auxiliares/Laravel/0Laravel/0Projetos/cron-jobs & php artisan schedule:run >> /dev/null 2>&1

Créditos:
https://www.itsolutionstuff.com/post/laravel-11-cron-job-task-scheduling-tutorialexample.html

