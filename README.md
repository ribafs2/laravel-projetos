# Laravel - Projetos

## Justificativa deste projeto

Porque sobre laravel?

Pra começar é o assunto que mais tenho estudado nos últimos tempos. O laravel não é apenas um framework em PHP. Basta olhar que o PHP é uma linguagem ainda muto popular pelos seus feitos mas bem impopular entre programadores de outras linguagens. Mas mesmo assim o laravel tem penetração entre estes. Sem contar que é um verdadeiro canivete suiço. Suas facilidades, somadas com as do PHP são muito importantes.

Só para dar uma ideia da sua versatilidade aqui, entre os projetos citados, está um que criei há uns 15 dias para servir de diário para mim. Ele substituiu um que usei por uns 5 anos feito no LibreOffice Writer. Tem mais vários aplicativos úteis, boa parte criada por mim, mas não somente.

## Controle de estoque
Removi o controle de estoque simplificado deste repositório papra um exclusivo

https://github.com/ribafs2/laravel-estoque

## Para executar cada projeto, após o download execute:

composer install

Crie  um banco e Ajuste o .env (não foi excluído)

php artisan migrate --seed

php artisan serve

http://127.0.0.1:8000

Alguns precisa indicar /login, /products, ou outro

Verifique o arquivo de rotas se em dúvida

## Veja o índice do livro
```sh
1 - Dicas	17
1.1 - Sobre as versões do laravel	17
1.2 - Abrir certa view por padrão ao executar artisan serve	17
1.3 - Adicionar CKEditor 5 para campos textarea	17
1.4 - Interceptar mensagem de erro de registro duplicado	18
1.5 – Notificações	19
1.6 - Collatioon no .env	20
1.7 – Corrigir Erro de permissão do storage	20
1.8 - Mostrar data numa rota	20
1.9 – Executando tags HTML em view	20
1.10 – Mudando campo input em select	20
1.11 – Trocar id por name na view index	21
1.12 - Encurtar string mostrada na view index apenas para exibição	22
1.13 - Limpara cache do laravel	22

2 – Projetos com Laravel 11	23
2.2 - Diário com bons recursos	31
2.3 - ACL com Spatie	32
2.4 – Autenticação	33
2.4.1 – Autenticação com laravel/ui e Bootstrap	35
2.4.2 - Com Breeze	36
2.4.3 - Com Jetstream	36
2.5 - Sistema de comentários	38
2.6 - Usando cron jobs	39
2.7 – CRUDs	42
2.7.1 - Passo a passo	42
2.7.2 - CRUD com Upload de imagem	45
2.7.3 – Gerador de CRUDs criado com commands	45
2.7.4 – Exemplo atualizado de CRUD para laravel 11	46
2.8 - Mensagens de erro de validações	47
2.9 - Autenticação múltipla com Breeze	51
2.10 - Exemplo de notificações	60
2.11 - Paginação de resultados no laravel 11	61
2.12 - Relacionamento um para vários	66
2.13 - Sweetalert2	71

3 - Tutoriais	75
3.1 - Fluxo de informações	75
3.2 – Eloquent ORM	80
3.3 - QueryBuilder	93
3.4 – Migrations	108
3.5 - Seeders no Laravel 11	111
3.6 – Console Artisan	118
3.7 – Tinker	121
3.8 - Blade	125
3.9 - FileSystem	131
3.10 - Middleware	134
3.11 - Request	136
3.12 - Response	141
3.13 – Rotas no Laravel 11	144

4 – Referências
```
## Testes

Todos os projetos foram testados e estão funcionando no ambiente:

- Debian 12
- Apache2, MariaDb, PHP 8.2 e cia

## Scripts
Na pasta Scripts encontrará vários aliases e scripts que uso para tornar minhas atividades mais produtivas

