<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 *
 */
class AnalyzeController extends AbstractController
{
    public function __construct(
    )
    {
    }

    /**
     * Analyze
     *
     * @Route("/analyze", name="analyze", methods={"GET"})
     *
     * @param Request $request
     * @return Response
     */
    public function analyzeAction(Request $request): Response
    {
        $url = $this->setCorrectURL($request->get('url'));

        $errorMessage = '';
        $content = $this->getURLContent($url, $errorMessage);

        return $this->render('views/default/result.html.twig', [
            'url' => $url,
            'content' => $content,
        ]);
    }

    /**
     * Analyze API
     *
     * @Route("/analyzeAPI", name="analyzeAPI", methods={"GET"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function analyzeAPIAction(Request $request): JsonResponse
    {
        $url = $request->get('url');
        if (empty($url)) {
            return new JsonResponse(
                [
                    'result' => 'empty url',
                ], Response::HTTP_NOT_FOUND
            );
        }

        $url = $this->setCorrectURL($request->get('url'));

        $errorMessage = '';
        $content = $this->getURLContent($url, $errorMessage);

        return new JsonResponse(
            [
                'url' => $url,
                'errorMessage' => $errorMessage,
                'content' =>  $content,
            ], Response::HTTP_NOT_FOUND
        );

    }

    public function setCorrectURL(string $url): string
    {
        $result = $url;

        if (!str_starts_with($url, 'http')) {
            $result = 'https://' . $url;
        }

        return $result;
    }

    public function getURLContent(string $url, string $errorMessage): ?string
    {
        $errorMessage ='';
        $content = '';

        try {
            $content = file_get_contents($url);
        } catch (\Exception $exception) {
            $errorMessage = 'Error in get page content';
        }

        return $content;
    }
}
