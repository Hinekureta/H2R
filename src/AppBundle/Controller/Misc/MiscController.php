<?php
namespace AppBundle\Controller\Misc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MiscController extends Controller
{
    /**
     * @Route("/nbaipsum-crawl", name="nba-ipsum-crawl")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function nbaCrawlAction()
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTMLFile("nba.html");
        libxml_clear_errors();
        $finder = new \DOMXPath($dom);
        $classname = 'players-list__name';
        $players = $finder->query("//li[contains(@class, '$classname')]");
        $collection = [];
        foreach ($players as $player) {
            $fullName = $player->nodeValue;
            $name = strtolower(explode(',', $fullName)[0]);
            $collection[$name] = null;
        }
        $keys = array_keys($collection);
        file_put_contents('nba.kev', serialize($keys));
        return new JsonResponse();
    }

    /**
     * @Route("/nbaipsum", name="nba-ipsum-generator")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function nbaIpsumGeneratorAction(Request $request)
    {

        return $this->render(':misc:nba-ipsum.html.twig');
    }

    /**
     * @Route("/nbaipsum-generate", name="generate-ipsum")
     * @param Request $request
     * @return JsonResponse
     */
    public function generateIpsumAction(Request $request)
    {
        $rawFile = file_get_contents('nba.kev');
        $data = unserialize($rawFile);
        $numberOfParagraph = $request->request->get('paragraphNumber');
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
        return new JsonResponse(['paragraphs' => $paragraphs]);
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