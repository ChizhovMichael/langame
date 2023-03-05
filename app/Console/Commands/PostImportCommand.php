<?php

namespace App\Console\Commands;

use App\Services\PostIntegration\PostIntegrationInterface;
use App\Services\PostServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PostImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for import information from newsapi.org';

    /** @var PostIntegrationInterface */
    private $integrationService;

    /** @var PostServiceInterface */
    private $postService;

    /**
     * Create a new command instance.
     *
     * @param PostIntegrationInterface $integrationService
     * @param PostServiceInterface $postService
     */
    public function __construct(
        PostIntegrationInterface $integrationService,
        PostServiceInterface $postService
    )
    {
        $this->integrationService = $integrationService;
        $this->postService = $postService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function handle()
    {
        $import = 1;
        $page = null;
        for ($i = 0; $i < 10; $i++) {
            try {
                $response = $this->integrationService->getPosts($page);
                $posts = $response->getPosts();
                $page = $response->getNexPage();
                foreach ($posts as $post) {
                    $this->postService->importPost($post);
                    $this->info(sprintf('%s. Create post: %s', $import, $post->getTitle()));
                    $import++;
                }
            } catch (\Exception $e) {
                Log::alert($e->getMessage());
            }
        }
        $this->info('Successful!');
        return 0;
    }
}
