<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use AppBundle\Service\TimeBenchmarkService;

class BenchmarkWebsiteCommand extends ContainerAwareCommand
{
     // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:benchmark';

    private $connectorService;
    private $timeBenchmarkService;

    public function __construct(TimeBenchmarkService $timeBenchmarkService)
    {
        $this->timeBenchmarkService = $timeBenchmarkService;

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

        ->addArgument('url1', InputArgument::REQUIRED, 'First url address')
        ->addArgument('url2', InputArgument::REQUIRED, 'Second url address')
    ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $logger = $this->getContainer()->get('monolog.logger.benchmark');

        //warming up
        $time0 = $this->timeBenchmarkService->getLoadingSpeed('https://pl.lipsum.com/');

        $time1 = $this->timeBenchmarkService->getLoadingSpeed($input->getArgument('url1'));
        $time2 = $this->timeBenchmarkService->getLoadingSpeed($input->getArgument('url2'));

        $compareMessage = $this->timeBenchmarkService->compareResults($time1, $time2);

        $logger->info("First URL total Request time:". ( $time1 ));
        $logger->info("Second URL total Request time:". ( $time2 ));
        $logger->info($compareMessage);

        $output->writeln("First URL total Request time:". ( $time1 ));
        $output->writeln("Second URL total Request time:". ( $time2 ));
        $output->writeln($compareMessage);
    }

}