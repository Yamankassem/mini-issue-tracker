<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\IssueRepository;
use App\Repositories\Eloquent\LabelRepository;
use App\Repositories\Eloquent\CommentRepository;
use App\Repositories\Eloquent\ProjectRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\IssueRepositoryInterface;
use App\Repositories\Interfaces\LabelRepositoryInterface;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\ProjectRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(IssueRepositoryInterface::class, IssueRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(LabelRepositoryInterface::class, LabelRepository::class);
        
    }
}
