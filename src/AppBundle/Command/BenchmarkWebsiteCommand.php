<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Service\ConnectorService;
use Psr\Log\LoggerInterface;

class BenchmarkWebsiteCommand extends ContainerAwareCommand
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
        $logger = $this->getContainer()->get('monolog.logger.benchmark');

        $one = microtime(true);
        $response = $this->connectorService->getWebsite('https://google.com/');
        $two = microtime(true);

        $logger->info("Total Request time:". ( $two - $one ));

        $output->writeln("Total Request time:". ( $two - $one ));
    }
}