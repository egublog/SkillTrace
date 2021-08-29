<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Str;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;

class MakeRepositoryInterfaceCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repositoryInterface {name : 作成するリポジトリインターフェースクラスのモデルクラス名を指定, ex) UserRepositoryInterface -> User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model repository interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'RepositoryInterface';

    /**
     * The name of class being generated.
     *
     * @var string
     */
    private $repositoryClass;

    /**
     * The name of class being generated.
     *
     * @var string
     */
    private $model;

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function fire()
    {
        $this->setRepositoryClass();

        $path = $this->getPath($this->repositoryClass);

        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already exists!');

            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($this->repositoryClass));

        $this->info($this->type.' created successfully.');

        $this->line("<info>Created Repository :</info> $this->repositoryClass");
    }

    /**
     * Set repository class name.
     *
     * @return void
     */
    private function setRepositoryClass()
    {
        $name = ucwords(strtolower($this->argument('name')));

        $this->model = $name;

        $modelClass = $this->parseName($name);

        $this->repositoryClass = $modelClass.'RepositoryInterface';

        return $this;
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param string $stub
     * @param string $name
     *
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        if (!$this->argument('name')) {
            throw new InvalidArgumentException('Missing required argument model name');
        }

        $stub = parent::replaceClass($stub, $name);

        return str_replace('{{class}}', $this->model, $stub);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return  base_path('stubs/repository.interface.stub');
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'].'/'.str_replace('\\', '/', $name).'RepositoryInterface.php';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Repositories';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the model class.'],
        ];
    }
}
