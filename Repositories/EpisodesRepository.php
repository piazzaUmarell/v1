<?php

namespace Repositories;

use DateTime;

class EpisodesRepository
{
    public static function getLatest()
    {
        return self::readLatest();
    }

    protected static function readLatest()
    {
        $xml = simplexml_load_file('umarell_puntate.xml');
        $nameSpaces = $xml->getNamespaces(true);
        $last = count($xml->channel->item) - 1;
        $latest = $xml->channel->item[$last];

        return [
            'title' => self::getTitle($latest->title),
            'number' => self::getNumber($latest->title),
            'abstract' => self::getAbstract($latest->description),
            'summary' => self::getSummary($latest, $nameSpaces),
            'date' => self::getDate($latest->pubDate),
            'url' => (string) $latest->enclosure['url']
        ];
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
