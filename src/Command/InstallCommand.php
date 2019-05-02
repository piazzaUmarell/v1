<?php


namespace App\Command;

use Exception;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class InstallCommand extends Command
{
    
    protected static $defaultName = 'piazza-umarell:install';
    
    /**
     * @var ParameterBagInterface $_parameterBag
     */
    protected $_parameterBag;
    
    public function __construct(
        ParameterBagInterface $parameterBag
    ) {
        parent::__construct(static::$defaultName);
        $this->_parameterBag = $parameterBag;
    }
    
    public function configure()
    {
        $this
            ->setDescription("Creates the database and populates it from a source.")
            ->addArgument("source", InputArgument::REQUIRED, "The source from whom populate the database");
        ;
    }
    
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->runMigrations($output);
        $this->importFromSource($input->getArgument("source"), $output);
    }
    
    /**
     * @param string $source
     * @param OutputInterface $output
     * @return int
     * @throws Exception
     */
    protected function importFromSource(string $source, OutputInterface $output) {
        return $this->runCommand(
            'piazza-umarell:import:xml',
            [
                'source' => $source
            ],
            $output
        );
    }
    
    /**
     * @param OutputInterface $output
     * @return int
     * @throws Exception
     */
    protected function runMigrations(OutputInterface $output) {
        return $this->runCommand(
            "doctrine:migrations:migrate",
            [],
            $output
        );
    }
    
    /**
     * @param string $commandName
     * @param array $params
     * @param OutputInterface $output
     * @return int
     * @throws Exception
     */
    protected function runCommand(string $commandName, array $params, OutputInterface $output) {
        if(!key_exists('command', $params) || $params['command'] !== $commandName) {
            $params['command'] = $commandName;
        }
        
        $command = $this->getApplication()->find($commandName);
        return $command->run(
            new ArrayInput($params),
            $output
        );
    }
    
    protected function createSqlLiteDatabase() {
        $dotEnv = new Dotenv();
        $dotEnv->load(PROJECT_ROOT . "/.env");
        $dbPath = str_replace(
            ["sqlite:///", "%kernel.project_dir%"],
            ["", $this->_parameterBag->get("kernel.project_dir")],
            $_ENV['DATABASE_URL']);
        $fs = new Filesystem();
        if(!$fs->exists($dbPath)) {
            $fs->touch($dbPath);
        }
    }
}