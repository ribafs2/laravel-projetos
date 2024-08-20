Relacionamento um para vários de models

Como criar migração com um esquema de chave estrangeira para relacionamentos um para muitos, usar sincronização com uma tabela dinâmica, criar registros, obter todos os dados, excluir, atualizar e tudo relacionado a relacionamentos um para muitos.

Neste exemplo, criarei uma tabela "posts" e uma tabela "comments". Ambas as tabelas estão conectadas entre si. Agora, criaremos relacionamentos um (post) para muitos (comments) entre si usando o modelo Eloquent do laravel. 

O relacionamento um para muitos usará "hasMany()"/tem muitos e "belongsTo()"/pertence a para a relação.

Migrations

    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->timestamps();
        });
    }
    
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts');
            $table->string("comment");
            $table->timestamps();
        });
    }

Models

app/Models/Post.php
<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
  
class Post extends Model
{
    use HasFactory;
 
    /**
     * Get the comments for the blog post.
     *
     * Syntax: return $this->hasMany(Comment::class, 'foreign_key', 'local_key');
     *
     * Example: return $this->hasMany(Comment::class, 'post_id', 'id');
     * 
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
app/Models/Comment.php
<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
  
class Comment extends Model
{
    use HasFactory;
  
    /**
     * Get the post that owns the comment.
     *
     * Syntax: return $this->belongsTo(Post::class, 'foreign_key', 'owner_key');
     *
     * Example: return $this->belongsTo(Post::class, 'post_id', 'id');
     * 
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}

Retrieve Records:
<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Post;
  
class PostController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
        $comments = Post::find(1)->comments;
  
        dd($comments);
    }
}
<?php
 
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Comment;
  
class PostController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
        $post = Comment::find(1)->post;
  
        dd($post);
    }
}
Create Records:
<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
  
class PostController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
        $post = Post::find(1);
   
        $comment = new Comment;
        $comment->comment = "Hi ItSolutionStuff.com";
           
        $post = $post->comments()->save($comment);
    }
}
<?php
  
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
  
class PostController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
        $post = Post::find(1);
   
        $comment1 = new Comment;
        $comment1->comment = "Hi ItSolutionStuff.com Comment 1";
           
        $comment2 = new Comment;
        $comment2->comment = "Hi ItSolutionStuff.com Comment 2";
           
        $post = $post->comments()->saveMany([$comment1, $comment2]);
    }
}
Read Also: Laravel 10 Multi Auth: Create Multiple Authentication in Laravel
<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
  
class PostController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
        $comment = Comment::find(1);
        $post = Post::find(2);
           
        $comment->post()->associate($post)->save();
    }
}

https://www.itsolutionstuff.com/post/laravel-10-one-to-many-eloquent-relationship-tutorialexample.html


Relacionamento tipo um para vários
Entre products e sales

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->notNllable();
            $table->integer('inventory_min')->notNullable();
            $table->integer('inventory_max')->notNullable();
            $table->timestamps();            
        });


        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedBigInteger('product_id');
            $table->integer('quantity')->notNullable();
            $table->decimal('price')->notNullable();
            $table->date('date')->nullable();
            $table->timestamps();
            
     $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDeletee('cascade');
        });

https://www.itsolutionstuff.com/post/laravel-11-one-to-many-eloquent-relationship-tutorialexample.html

https://www.iankumu.com/blog/laravel-one-to-many-relationship/

