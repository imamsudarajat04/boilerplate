<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

#[Signature('make:repository {name} {--model=} {--force}')]
#[Description('Create a new repository class with ForModel attribute')]
class MakeRepositoryCommand extends Command
{
    /**
     * @throws FileNotFoundException
     */
    public function handle(): int
    {
        $name = Str::studly($this->argument('name'));
        $modelName = Str::studly($this->option('model') ?: $name);
        $className = $name.'Repository';

        $path = app_path("Repositories/{$className}.php");

        if (File::exists($path) && ! $this->option('force')) {
            $this->error("File already exists! : {$path}");

            return self::FAILURE;
        }

        $stubPath = base_path('stubs/repository.stub');

        if (! File::exists($stubPath)) {
            $this->error("Stub file not found! : {$stubPath}");

            return self::FAILURE;
        }

        $stub = File::get($stubPath);

        $contents = str_replace(
            ['{{ className }}', '{{ modelName }}'],
            [$className, $modelName],
            $stub
        );

        File::ensureDirectoryExists(\dirname($path));
        File::put($path, $contents);

        $this->info("Created : {$path}");

        return self::SUCCESS;
    }
}
