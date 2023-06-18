<?php

namespace App\Console\Commands\Webhooks;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class Deploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webhook:deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploy application';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $root_path = base_path();

        $process = Process::fromShellCommandline("cd $root_path; ./deploy.sh");
        $process->run(function ($type, $buffer) {
            echo $buffer;
        });
        return 0;
    }
}
