<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class ServiceMakeCommand extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service 
        {name : The name of the service (must be PascalCase) } 
        {--i|inherits : This service inherits the default service behaviours (in the AbstractService - you must create it)}
        {--f|force : Create the class even if the service already exists }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class.';

    protected function getStub(): string
    {
        if ($this->option('inherits')) {
            $this->createAbstractService();

            return __DIR__ . '/stubs/service_inherited.stub';
        }

        return __DIR__ . '/stubs/service.stub';
    }

    protected function getDefaultNamespace(): string
    {
        return 'App\Services';
    }

    protected function makeDirectory($path): bool
    {
        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0755, true);

            return true;
        }

        return false;
    }

    protected function createAbstractService(): bool
    {
        if (file_exists(app_path('Services/AbstractService.php')))
            return false;

        if (! file_exists(app_path('Contracts/')))
            mkdir(app_path('Contracts/'), 0755, true);

        if (! file_exists(app_path('Services/')))
            mkdir(app_path('Services/'), 0755, true);
        
        copy(app_path('Console/Commands/stubs/service_interface.stub'), app_path('/Contracts/ServiceInterface.php'));
        copy(app_path('Console/Commands/stubs/abstract_service.stub'), app_path('/Services/AbstractService.php'));

        return true;
    }

    protected function createService($name, $model): bool
    {
        $path = app_path('Services/' . $name . '.php');

        if (file_exists($path) && $this->option('force') == false) {
            $this->error('Service already exists!');

            return false;
        } 
        
        $this->makeDirectory($path);

        $service = str_replace(
            ['{{ namespace }}', '{{ class }}', '{{ model }}'],
            [$this->getDefaultNamespace(), $name, $model],
            file_get_contents($this->getStub())
        );

        
        file_put_contents($path, $service);

        $this->info('Service created successfully.');

        return true;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = $this->argument('name');
        $model = $name;

        if (! preg_match('/Service/i', $name))
		    $name .= 'Service';
        else
            $model = preg_replace("/Service/i", "", $model);

        $this->info('Creating service: ' . $name);
        $this->createService($name, $model);
    }
}
