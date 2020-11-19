<?php

namespace JeroenvanRensen\MoonPHP\Tests\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

trait SetUpResources
{
    /**
     * Set up all the resources for the tests.
     *
     * @return void
     */
    protected function setUpResources($registerResources = false)
    {
        // Set up configuration
        Config::set('filesystems.disks.local.root', app_path());
        Config::set('filesystems.disks.database', [
            'driver' => 'local',
            'root' => database_path()
        ]);

        // Save the files
        Storage::disk('local')->put('Models/Post.php', $this->model);
        Storage::disk('local')->put('Resources/Post.php', $this->resource);
        Storage::disk('database')->put('factories/PostFactory.php', $this->factory);

        // Include the files
        require_once app_path('Resources/Post.php');
        require_once app_path('Models/Post.php');
        require_once database_path('factories/PostFactory.php');

        // Build up the table
        Schema::create('posts', function($table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->timestamps();
        });

        if(!$registerResources) {
            return;
        }

        Config::set('moonphp.resources', [
            \App\Resources\Post::class
        ]);
    }

    public $model = <<<EOD
    <?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    
    class Post extends Model
    {
        use HasFactory;
    }
    EOD;

    public $resource = <<<EOD
    <?php
    
    namespace App\Resources;
    
    use JeroenvanRensen\MoonPHP\Resource;
    use App\Models\Post as PostModel;
    
    class Post extends Resource
    {
        public \$model = PostModel::class;
    }
    EOD;

    public $factory = <<<EOD
    <?php
    
    namespace Database\Factories;
    
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Str;
    
    class PostFactory extends Factory
    {
        protected \$model = \App\Models\Post::class;
    
        public function definition()
        {
            return [
                'title' => \$this->faker->sentence,
                'body' => \$this->faker->paragraph
            ];
        }
    }
    EOD;
}
