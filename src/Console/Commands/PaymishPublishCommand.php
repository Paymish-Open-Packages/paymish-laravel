<?php

namespace Paymish\Console\Commands;

use Illuminate\Console\Command;

class PaymishPublishCommand extends Command
{
    protected $signature = 'paymish:publish {--tag=config : Publish Paymish config file}';
    protected $description = 'Publish Paymish package assets';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'config',
            '--force' => true,
        ]);

        $this->info('Paymish config file has been published successfully!');
    }
}
