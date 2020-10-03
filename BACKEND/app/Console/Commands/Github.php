<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Repository;
use App\Services\GitHub\GitHub as GitHubService;

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
     * Function which fetches my repos
     * @return null
     */
    public function handle()
    {
        $data = $this->gitHub->list();
        foreach ($data as $item) {
            $this->saveRepository($item);
        }
        return false;
    }

    public function saveRepository($item): void
    {
        Repository::create(['name' => $item->name, 'url' => $item->html_url, 'is_private' => $item->private]);
    }
}
