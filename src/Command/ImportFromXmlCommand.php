<?php


namespace App\Command;

use App\Calculator\Mp3DurationCalculator;
use DateTime;
use Carbon\Carbon;
use SimpleXMLElement;
use App\Entity\Episode;
use ForceUTF8\Encoding;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use App\Calculator\CategorySlugCalculator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ImportFromXmlCommand extends Command
{
    
    protected static $defaultName = 'piazza-umarell:import:xml';
    
    /**
     * @var CategorySlugCalculator $_slugifier;
     */
    protected $_slugifier;
    
    /**
     * @var EntityManagerInterface $_entityManager
     */
    protected $_entityManager;
    
    /**
     * @var ParameterBagInterface $_parameterBag
     */
    protected $_parameterBag;
    
    public function __construct(
        CategorySlugCalculator $slugifier,
        EntityManagerInterface $entityManager,
        ParameterBagInterface $parameterBag
    ) {
        parent::__construct(static::$defaultName);
        $this->_slugifier = $slugifier;
        $this->_entityManager = $entityManager;
        $this->_parameterBag = $parameterBag;
    }
    
    public function configure()
    {
        $this
            ->setDescription("Imports the episodes from the xml given by the old site")
            ->addArgument("source", InputArgument::REQUIRED, "The source from which read the needed xml data")
        ;
    }
    
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $episodes = self::readXml($input->getArgument("source"));
        setlocale(LC_TIME, 'it_IT');
        foreach($episodes as $episodeData) {
            echo "Handling episode {$episodeData['number']}: {$episodeData['title']}\n";
            $episodeCategories = $this->retrieveCategories($episodeData);
            $episodeAsset = $this->retrieveAsset($episodeData);
            $episode = $this->retrieveEpisode($episodeData);
            $episode->setSource($episodeAsset);
            $episode->setDuration(Mp3DurationCalculator::calculate(PUBLIC_ROOT . $episodeAsset));
            array_map(function(Category $category) use ($episode) {
                $episode->addCategory($category);
            }, $episodeCategories);
            $this->_entityManager->persist($episode);
            $this->_entityManager->flush();
        }
    }
    
    protected function retrieveCategories($episodeData): array {
        $categoryRepository = $this->_entityManager->getRepository(Category::class);
        return array_map(
            function ($categoryStr) use ($categoryRepository) {
                $categorySlug = $this->_slugifier->calculate($categoryStr);
                
                $category = $categoryRepository->findOneBy(["slug" => $categorySlug]);
                
                if(!$category) {
                    $category = new Category;
                    $category->setName($categoryStr);
                    $category->setSlug($categorySlug);
                    $this->_entityManager->persist($category);
                    $this->_entityManager->flush();
                }
                return $category;
            },
            $episodeData['categories']
        );
    }
    
    protected function retrieveAsset($episodeData) {
        $episodeInfo = pathinfo($episodeData['url']);
        $root = $this->_parameterBag->get("kernel.project_dir");
        $publicFolder = "$root/public";
        $relativeDestination = "/static/episodes/";
        $episodeDestination = "$publicFolder$relativeDestination";
        $episodeFullpath = "$episodeDestination{$episodeInfo['basename']}";
        
        $filesystem = new Filesystem();
        if(!$filesystem->exists($episodeDestination)) {
            $filesystem->mkdir($episodeDestination);
        }
        
        if(!$filesystem->exists($episodeFullpath)) {
            file_put_contents(
                $episodeFullpath,
                file_get_contents($episodeData['url'])
            );
        }
        
        return "$relativeDestination{$episodeInfo['basename']}";
    }
    
    protected function retrieveEpisode($episodeData): Episode {
        /**
         * @var Carbon $date
         */
        $date = $episodeData['date'];
        $episode = new Episode();
        $episode->setTitle($episodeData['title']);
        $episode->setSlug(
            $this->_slugifier->calculate(
                Encoding::toUTF8($episodeData['title'])
            )
        );
        $episode->setNumber($episodeData['number']);
        $episode->setAbstract(trim($episodeData['abstract'], " \t\n"));
        $episode->setDescription($episodeData['summary']);
        $episode->setSource($episodeData['url']);
        $episode->setPublicationDate($date);
        return $episode;
    }
    
    protected static function serializeFromXml(SimpleXMLElement $element, $namespaces)
    {
        return [
            'title' => self::getTitle($element->title),
            'number' => self::getNumber($element->title),
            'abstract' => self::getAbstract($element->description),
            'summary' => self::getSummary($element, $namespaces),
            'date' => self::getDate($element->pubDate),
            'url' => (string) $element->enclosure['url'],
            'categories' => array_filter(explode(",",$element->children($namespaces['itunes'])->keywords))
        ];
    }
    
    protected static function readXml(string $source) {
        $xml = simplexml_load_file($source);
        $namespaces = $xml->getNamespaces(true);
        
        $last = count($xml->channel->item);
        $collection = [];
        for ($i = 0; $i < $last; $i++) {
            $collection[] = self::serializeFromXml(
                $xml->channel->item[$i],
                $namespaces
            );
        }
        return $collection;
    }
    
    protected static function getTitle($xmlTitle)
    {
        return trim(self::parseTitle($xmlTitle), ' ');
    }
    
    protected static function parseTitle($xmlTitle)
    {
        $titleParts = explode('-', $xmlTitle);
        $results = [];
        if (isset($titleParts[0])) {
            if (preg_match('/(.*)#( *)([0-9]+)/', $titleParts[0], $results)) {
                return isset($titleParts[1]) ? $titleParts[1] : (isset($results[1]) ? $results[1] : $xmlTitle);
            }
            
            if (preg_match('/Piazza Umarell #(.*)/', $titleParts[0], $results)) {
                return $results[1];
            }
        }
        return $xmlTitle;
    }
    
    protected static function getNumber($xmlTitle)
    {
        $titleParts = explode('-', $xmlTitle);
        $results = [];
        if (isset($titleParts[0])) {
            if (preg_match('/(.*)#( *)([0-9]+)/', $titleParts[0], $results)) {
                return $results[3];
            }
            
            if (isset($titleParts[1]) && preg_match('/(.*)#( *)([0-9]+)/', $titleParts[1], $results)) {
                return $results[3];
            }
        }
        return $xmlTitle;
    }
    
    protected static function getAbstract($xmlAbstract)
    {
        $stripped = strip_tags($xmlAbstract);
        return trim(substr($stripped, 0, strpos($stripped, 'La lista degli argomenti')), ' ');
    }
    
    protected static function getSummary($xmlElement, $nameSpaces)
    {
        return (string) str_replace('\t', '', str_replace("\n", '<br>', trim((string)$xmlElement->children($nameSpaces['piazza']), "\n\t")));
    }
    
    protected static function getDate($xmlDate)
    {
        return Carbon::createFromTimestamp((new DateTime($xmlDate))->getTimestamp());
    }
}