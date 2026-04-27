<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeFeatureCommand extends Command
{
    protected $signature = 'make:feature {name}';
    protected $description = 'Generate Model, Migration, Resource Controller, Service, and Form Requests for a feature';

    public function handle()
    {
        $name = Str::studly($this->argument('name'));

        $this->generateModel($name);
        $this->generateController($name);
        $this->generateService($name);
        $this->generateRequests($name);

        $this->newLine();
        $this->info("✅ Feature [{$name}] scaffolded successfully.");
        $this->table(
            ['File', 'Path'],
            [
                ['Model',           "app/Models/{$name}.php"],
                ['Migration',       'database/migrations/****_create_' . Str::snake(Str::plural($name)) . '_table.php'],
                ['Controller',      "app/Http/Controllers/{$name}Controller.php"],
                ['Service',         "app/Services/{$name}Service.php"],
                ['StoreRequest',    "app/Http/Requests/Store{$name}Request.php"],
                ['UpdateRequest',   "app/Http/Requests/Update{$name}Request.php"],
            ]
        );
    }

    protected function generateModel(string $name): void
    {
        $this->call('make:model', [
            'name' => $name,
            '--migration' => true,
        ]);
    }

    protected function generateController(string $name): void
    {
        $plural      = Str::plural($name);
        $variable    = Str::camel($name);
        $pluralVar   = Str::camel($plural);
        $service     = "{$name}Service";
        $serviceVar  = Str::camel($service);
        $snake       = Str::snake($name);

        $stub = <<<PHP
<?php

namespace App\Http\Controllers;

use App\Models\\{$name};
use App\Services\\{$service};
use App\Http\Requests\Store{$name}Request;
use App\Http\Requests\Update{$name}Request;
use Illuminate\Http\JsonResponse;

class {$name}Controller extends Controller
{
    public function __construct(
        protected {$service} \${$serviceVar}
    ) {}

    public function index(): JsonResponse
    {
        \${$pluralVar} = \$this->{$serviceVar}->getAll();
        return response()->json(\${$pluralVar});
    }

    public function store(Store{$name}Request \$request): JsonResponse
    {
        \${$variable} = \$this->{$serviceVar}->create(\$request->validated());
        return response()->json(\${$variable}, 201);
    }

    public function show({$name} \${$variable}): JsonResponse
    {
        return response()->json(\$this->{$serviceVar}->find(\${$variable}));
    }

    public function update(Update{$name}Request \$request, {$name} \${$variable}): JsonResponse
    {
        \${$variable} = \$this->{$serviceVar}->update(\${$variable}, \$request->validated());
        return response()->json(\${$variable});
    }

    public function destroy({$name} \${$variable}): JsonResponse
    {
        \$this->{$serviceVar}->delete(\${$variable});
        return response()->json(['message' => '{$name} deleted successfully']);
    }
}
PHP;

        $path = app_path("Http/Controllers/{$name}Controller.php");
        $this->writeFile($path, $stub, "Controller");
    }

    protected function generateService(string $name): void
    {
        $plural    = Str::plural($name);
        $variable  = Str::camel($name);
        $pluralVar = Str::camel($plural);

        $stub = <<<PHP
<?php

namespace App\Services;

use App\Models\\{$name};
use Illuminate\Database\Eloquent\Collection;

class {$name}Service
{
    public function getAll(): Collection
    {
        return {$name}::all();
    }

    public function find({$name} \${$variable}): {$name}
    {
        return \${$variable};
    }

    public function create(array \$data): {$name}
    {
        return {$name}::create(\$data);
    }

    public function update({$name} \${$variable}, array \$data): {$name}
    {
        \${$variable}->update(\$data);
        return \${$variable}->fresh();
    }

    public function delete({$name} \${$variable}): void
    {
        \${$variable}->delete();
    }
}
PHP;

        $dir = app_path('Services');
        File::ensureDirectoryExists($dir);

        $path = "{$dir}/{$name}Service.php";
        $this->writeFile($path, $stub, "Service");
    }

    protected function generateRequests(string $name): void
    {
        foreach (['Store', 'Update'] as $prefix) {
            $className = "{$prefix}{$name}Request";

            $stub = <<<PHP
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class {$className} extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
PHP;

            $dir  = app_path('Http/Requests');
            File::ensureDirectoryExists($dir);

            $path = "{$dir}/{$className}.php";
            $this->writeFile($path, $stub, "{$prefix}Request");
        }
    }

    protected function writeFile(string $path, string $content, string $label): void
    {
        if (File::exists($path)) {
            $this->warn("  SKIP  {$label} already exists at {$path}");
            return;
        }

        File::put($path, $content);
        $this->line("  <info>CREATED</info>  {$path}");
    }
}
