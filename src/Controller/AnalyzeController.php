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
        $errorMessage = '';
        $content = $this->getURLContent($request->get('url'), $errorMessage);

        return $this->render('views/default/result.html.twig', [
            'url' => $request->get('url'),
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
        if (empty($request->get('url'))) {
            return new JsonResponse(
                [
                    'result' => 'empty url',
                ], Response::HTTP_NOT_FOUND
            );
        }

        $errorMessage = '';
        $content = $this->getURLContent($request->get('url'), $errorMessage);

        return new JsonResponse(
            [
                'url' => $request->get('url'),
                'errorMessage' => $errorMessage,
                'content' =>  $content,
            ], Response::HTTP_NOT_FOUND
        );

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
