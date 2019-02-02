<?php
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Service\ConnectorService;

class BenchmarkWebsiteCommand extends Command
{
     // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:benchmark';

    private $connectorService;

    public function __construct(ConnectorService $connectorService)
    {
        $this->connectorService = $connectorService;

        parent::__construct();
    }

    protected function configure()
    {
         $this
        // the short description shown while running "php bin/console list"
        ->setDescription('Benchmarks two websites')

        // the full command description shown when running the command with
        // the "--help" option
        ->setHelp('This command allows you benchmark two websites')
    ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $one = microtime(true);
        $response = $this->connectorService->getWebsite('https://google.com/');
        $two = microtime(true);

        $output->writeln("Total Request time:". ( $two - $one ));
    }
}