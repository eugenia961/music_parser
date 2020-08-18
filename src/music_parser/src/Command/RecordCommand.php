<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Interfaces\SerializerDeserializeInterface;
use App\Interfaces\ReleasesRepository;
use App\Worldofmusic\Records;
use App\Interfaces\PrintMatchingReleasesInterface;
use App\Interfaces\ReaderInterface;

/**
 * Class RecordCommand
 * @package App\Command
 */
class RecordCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'app:record_command';
    /**
     * @var SerializerDeserializeInterface $serializerDeserialize
     */
    private $serializerDeserialize;
    /**
     * @var ReleasesRepository $releasesRepository
     */
    private $releasesRepository;
    /**
     * @var PrintMatchingReleasesInterface $printMatchingReleases
     */
    private $printMatchingReleases;
    /**
     * @var ReaderInterface $reader
     */
    private $reader;

    /**
     * RecordCommand constructor.
     * @param SerializerDeserializeInterface $serializerDeserialize
     * @param ReleasesRepository $releasesRepository
     * @param PrintMatchingReleasesInterface $printMatchingReleases
     * @param ReaderInterface $reader
     */
    public function __construct(
        SerializerDeserializeInterface $serializerDeserialize,
        ReleasesRepository $releasesRepository,
        PrintMatchingReleasesInterface $printMatchingReleases,
        ReaderInterface $reader
    ) {

        parent::__construct();
        $this->serializerDeserialize = $serializerDeserialize;
        $this->printMatchingReleases = $printMatchingReleases;
        $this->releasesRepository = $releasesRepository;
        $this->reader = $reader;
    }

    /**
     *
     */
    protected function configure()
    {

        $filterDate = "2001-01-01";
        $count = 10;
        $fileName = "worldofmusic.xml";
        $this->setDescription('Return Music Release File Path')
            ->addArgument(
                'filterReleasedDate',
                InputArgument::OPTIONAL,
                sprintf('Filter released date. Default %s released date', $filterDate),
                $filterDate
            )
            ->addArgument(
                'filterCount',
                InputArgument::OPTIONAL,
                sprintf('Filter count. Default %s count', $count),
                $count
            )
            ->addArgument(
                'fileName',
                InputArgument::OPTIONAL,
                sprintf('Default %s file name', $fileName),
                $fileName
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $filterReleasedDate = $input->getArgument('filterReleasedDate');
        $filterCount = $input->getArgument('filterCount');
        $fileName = $input->getArgument('fileName');
        $filters = ['date' => $filterReleasedDate, 'count' => $filterCount];

        $content = $this->reader->read($fileName);
        $records = $this->serializerDeserialize->deserialize($content, Records::class);
        $matchingReleases = $this->releasesRepository->storeRecords($records, $filters);
        $fileXml = $this->serializerDeserialize->serialize($matchingReleases);
        $outPath = $this->printMatchingReleases->printMatchingReleases($fileXml);
        $io = new SymfonyStyle($input, $output);
        $io->success(\sprintf("The file path is: %s", $outPath));
    }

}
