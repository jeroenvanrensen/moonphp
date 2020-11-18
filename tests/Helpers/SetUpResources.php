<?php

namespace JeroenvanRensen\MoonPHP\Tests\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

trait SetUpResources
{

    /**
     * Set up all the resources for the tests.
     *
     * @return void
     */
    protected function setUpResources()
    {
        Config::set('filesystems.disks.local.root', app_path());

        Storage::disk('local')->put('Models/Page.php', $this->pageModel);
        Storage::disk('local')->put('Resources/Page.php', $this->pageResource);
        Storage::disk('local')->put('Models/Post.php', $this->postModel);
        Storage::disk('local')->put('Resources/Post.php', $this->postResource);

        require_once app_path('Resources/Page.php');
        require_once app_path('Models/Page.php');
        require_once app_path('Resources/Post.php');
        require_once app_path('Models/Post.php');
    }

    public $pageModel = <<<EOD
    <?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Model;
    
    class Page extends Model
    {
        // 
    }
    EOD;

    public $pageResource = <<<EOD
    <?php
    
    namespace App\Resources;
    
    use JeroenvanRensen\MoonPHP\Resource;
    use App\Models\Page as PageModel;
    
    class Page extends Resource
    {
        public \$model = PageModel::class;
    }
    EOD;

    public $postModel = <<<EOD
    <?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Model;
    
    class Post extends Model
    {
        // 
    }
    EOD;

    public $postResource = <<<EOD
    <?php
    
    namespace App\Resources;
    
    use JeroenvanRensen\MoonPHP\Resource;
    use App\Models\Post as PostModel;
    
    class Post extends Resource
    {
        public \$model = PostModel::class;
    }
    EOD;
}
