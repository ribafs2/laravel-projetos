Criar diário com PHP, MySQL e Bootstrap

Tenho duas fortes alternativas para a criação:

- PHP puro, que será mais flexível mas me dará mais trabalho
- Usando laravel 11 com o gerador de cruds + ckeditor para o texto

Parece que mesmo deixando o projeto bem maior a opção com laravel é mais adequada. Vejamos

create table diario(
	id int primary key auto_increment,
	dia DATETIME DEFAULT CURRENT_TIMESTAMP,
	texto text not null
);

    <input class="form-control" name="dia" type="datetime" id="dia" value="{{ isset($diario->dia) ? $diario->dia : date('Y-m-d')}}" >

<textarea class="form-control" rows="5" name="texto" type="textarea" id="texto" ><strong>{{ isset($diario->texto) ? $diario->texto : date('Y-m-d')}}</strong></textarea>
composer require orangehill/iseed
php artisan iseed diarios

php artisan migrate --seed
