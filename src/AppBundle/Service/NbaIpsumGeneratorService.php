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
    public function generateParagraphs($numberOfParagraph)
    {
        $rawFile = file_get_contents('nba.kev');
        $data = unserialize($rawFile);
        if (!is_numeric($numberOfParagraph) || $numberOfParagraph < 1)
            $numberOfParagraph = 1;
        if ($numberOfParagraph > 50)
            $numberOfParagraph = 50;
        $paragraphs = [];
        for ($i = 0; $i < $numberOfParagraph; ++$i) {
            $paragraph = [];
            $numberOfWord = rand(50, 200);
            $dataCopy = $data;
            shuffle($dataCopy);
            while (count($paragraph) < $numberOfWord) {
                $paragraph = array_merge($paragraph, array_slice($dataCopy, 0, 30));
                shuffle($dataCopy);
            }
            array_splice($paragraph, $numberOfWord);
            $paragraphied = $this->paragraphy($paragraph);
            $paragraphs[] = str_replace(' .', '.', implode(' ', $paragraphied));
        }

        return $paragraphs;
    }

    private function paragraphy(array $paragraph)
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