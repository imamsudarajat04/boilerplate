<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

#[Signature('make:service {name} {--force}')]
#[Description('Create a new service class (uncomment Repository attribute & imports manually)')]
class MakeServiceCommand extends Command
{
    /**
     * Execute the console command.
     *
     * @throws FileNotFoundException
     */
    public function handle(): int
    {
        $name = Str::studly($this->argument('name'));
        $className = $name.'Service';

        $path = app_path("Services/{$className}.php");

        if (File::exists($path) && ! $this->option('force')) {
            $this->error("File already exists: {$path}");

            return self::FAILURE;
        }

        $stubPath = base_path('stubs/service.stub');

        if (! File::exists($stubPath)) {
            $this->error("Stub not found: {$stubPath}");

            return self::FAILURE;
        }

        $stub = File::get($stubPath);

        $contents = str_replace('{{ className }}', $className, $stub);

        File::ensureDirectoryExists(\dirname($path));
        File::put($path, $contents);

        $this->info("Created {$path}");

        return self::SUCCESS;
    }
}
