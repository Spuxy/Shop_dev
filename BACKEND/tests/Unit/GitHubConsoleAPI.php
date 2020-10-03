<?php

namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use App\Services\GitHub\GitHub;
use App\Console\Commands\Github as CommandsGithub;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GitHubConsoleAPI extends TestCase
{
    use RefreshDatabase;
    protected $stock;
    protected $githubCommand;

    public function setUp(): void
    {
        // $this->githubCommand = new CommandsGithub();
        $this->stock = ['filip' => 'ahoj'];
    }


    /**
     * github fetch.
     */
    public function test_github_fetch_repositories_from_artisan_console()
    {
        $clientMock = Mockery::mock(new GitHub());
        $clientMock->shouldReceive('list')->andReturn(['repo' => 'Spuxy']);
        $git = new GitHub();
        $this->assertIsArray($git->list());
    }

    public function test_wtf()
    {
    }
}
