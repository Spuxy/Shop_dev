<?php

namespace App\Console\Commands;

use App\Http\Controllers\Api\RepositoryController;
use App\Models\ProgrammingLanguage;
use App\Models\ProgrammingLanguageLink;
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
     * @return void
     */
    public function handle(): void
    {
        $data = $this->gitHub->list();
        foreach ($data as $item) {
            $languages = $this->getLanguage($item->name);
            $createdRepository = $this->saveRepository($item);
            $this->saveLanguagesByRepository($languages, $createdRepository);
        }
    }

    public function saveRepository($item): Repository
    {
        $repo = Repository::where('id', $item->id)->first();
        if ($repo) {
            return $repo;
        }
        return Repository::create(['id' => $item->id, 'name' => $item->name, 'url' => $item->html_url, 'is_private' => $item->private]);
    }

    public function saveLanguagesByRepository($langs, $repo): void
    {
        foreach ($langs as $lang) {
            ProgrammingLanguageLink::create(['repository_id' => $repo->id, 'programming_language_id' => $lang->id]);
        }
    }

    /**
     * function which fetches language for repository
     * saves langs before inserting into pivot
     * @param  mixed $name
     * @return array
     */
    public function getLanguage($name): array
    {
        $langs = $this->gitHub->getLanguagesByRepository($name);

        $languagePayload = [];

        foreach ($langs as $lang => $per) {
            $pl = ProgrammingLanguage::firstOrNew(['name' => $lang]);
            if ($pl->exists) {
                $languagePayload[] = $pl;
                continue;
            }
            $pl->save();

            $languagePayload[] = $pl->fresh();
        }

        return $languagePayload;
    }
}
