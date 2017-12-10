<?php

namespace AppBundle\Service;

/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 10/12/2017
 * Time: 21:14
 */
class NbaIpsumGeneratorService
{
    public function paragraphy(array $paragraph)
    {
        $count = count($paragraph);
        $numberOfWordsInPhrase = rand(5, 30);
        $i = 0;
        while ($i < $count) {
            $paragraph[$i] = ucfirst($paragraph[$i]);
            array_splice($paragraph, $i + $numberOfWordsInPhrase, 0, '.');
            $i += $numberOfWordsInPhrase + 1;
            $numberOfWordsInPhrase = rand(5, 30);
        }
        if (substr(end($paragraph), -1) != '.') {
            $paragraph[] = '.';
        }
        return $paragraph;
    }

}