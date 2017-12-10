<?php
namespace AppBundle\Controller\Misc;
use AppBundle\Service\NbaIpsumGeneratorService;
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
     * @param NbaIpsumGeneratorService $ipsumGeneratorService
     * @return JsonResponse
     */
    public function generateIpsumAction(Request $request, NbaIpsumGeneratorService $ipsumGeneratorService)
    {
        $numberOfParagraph = $request->request->get('paragraphNumber');
        $paragraphs = $ipsumGeneratorService->generateParagraphs($numberOfParagraph);
        return new JsonResponse(['paragraphs' => $paragraphs]);
    }
}