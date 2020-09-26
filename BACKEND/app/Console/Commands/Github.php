<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Repository;
use App\Services\GitHub as GitHubService;

class Github extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'github:pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $gitHub;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GitHubService $gitHub)
    {
        $this->gitHub = $gitHub;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = $this->gitHub->list();
        $payload = [];
        $collection = collect($data)->map(function ($item) {
            Repository::create(['name' => $item->name, 'description' => $item->html_url, 'is_private' => $item->private]);
        });
    }
}
