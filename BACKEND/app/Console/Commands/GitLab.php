<?php

namespace App\Console\Commands;

use App\Models\Repository;
use App\Services\GitLab\GitLab as GitLabGitLab;
use Illuminate\Console\Command;

class GitLab extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gitlab:pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $gitlab;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GitLabGitLab $gitLab)
    {
        $this->gitlab = $gitLab;
        parent::__construct();
    }

    /**
     * Execute the console command.
     * Function which fetches my repos
     * @return null
     */
    public function handle()
    {
        $data = $this->gitlab->list();
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
