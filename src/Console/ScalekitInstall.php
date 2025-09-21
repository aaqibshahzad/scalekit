<?php

namespace AaqibShahzad\Scalekit\Console;

use Illuminate\Console\Command;

class ScalekitInstall extends Command
{
    protected $signature = 'scalekit:install {--with-tenancy}';
    protected $description = 'Install Scalekit starter kit (optional tenancy, roles, oauth)';

    public function handle()
    {
        $this->info('Installing Scalekit...');

        // Publish configs, migrations, etc.
        $this->callSilent('vendor:publish', [
            '--tag' => 'scalekit-config',
            '--force' => true,
        ]);

        $this->call('migrate');

        if ($this->option('with-tenancy')) {
            $this->call('scalekit:tenancy-setup');
        }

        $this->info('Scalekit installed successfully!');
    }
}