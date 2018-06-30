<?php

namespace Repositories;

use stdClass;
use DateTime;
use SimpleXMLElement;
use Core\Facade\Cache;

class EpisodesRepository
{
    public static function getLatest()
    {
        return self::readLatest();
    }

    public static function page($page, $perPage = 10)
    {
        $ret = Cache::get("episodes.page.$page");
        if ($ret) {
            return $ret;
        }
        $ret = self::readPage($page, $perPage);
        Cache::set("episodes.page.$page", $ret);
        return $ret;
    }

    public static function readPage($page, $perPage)
    {
        $ret = [];
        $actualPage = $page - 1;
        $allEpisodes = self::all();
        $hasPage = count($allEpisodes) >= ($actualPage * $perPage);
        $hasNextPage = count($allEpisodes) >= (($actualPage * $perPage) + 1);
        if ($hasPage) {
            $ret = array_slice($allEpisodes, ($actualPage * $perPage), $perPage);
        }
        return [
            'page' => $page,
            'content' => $ret,
            'hasNextPage' => $hasNextPage,
        ];
    }

    public static function all()
    {
        return self::readAll();
    }

    protected static function readAll()
    {
        return Cache::get('episodes.all', function () {
            return array_reverse(self::readAllFromXML());
        });
    }

    protected static function readLatest()
    {
        return Cache::get('episode.latest', function () {
            return self::readLatestFromXML();
        });
    }

    public static function readAllFromXML()
    {
        $xml = self::readXML();
        $last = count($xml->content->channel->item);
        $collection = [];
        for ($i = 0; $i < $last; $i++) {
            $collection[] = self::serializeFromXml(
                $xml->content->channel->item[$i],
                $xml
            );
        }
        return $collection;
    }

    public static function readLatestFromXML()
    {
        $xml = self::readXML();
        $last = count($xml->content->channel->item) - 1;
        $latest = $xml->content->channel->item[$last];
        return self::serializeFromXml($latest, $xml);
    }

    protected static function serializeFromXml(SimpleXMLElement $element, $data)
    {
        return [
            'title' => self::getTitle($element->title),
            'number' => self::getNumber($element->title),
            'abstract' => self::getAbstract($element->description),
            'summary' => self::getSummary($element, $data->nameSpaces),
            'date' => self::getDate($element->pubDate),
            'url' => (string) $element->enclosure['url']
        ];
    }

    public static function readXML()
    {
        $ret = new stdClass;
        $ret->content = simplexml_load_file('umarell_puntate.xml');
        $ret->nameSpaces = $ret->content->getNamespaces(true);
        return $ret;
    }

    protected static function getDate($xmlDate)
    {
        setlocale(LC_TIME, 'it_IT');
        return strftime('%A, %d %B %Y', (new DateTime($xmlDate))->getTimestamp());
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
        return (string) str_replace('\t', '', str_replace("\n", '<br>', trim($xmlElement->children($nameSpaces['piazza']), "\n\t")));
    }
}
