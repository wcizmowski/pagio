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

    public const STYLE_BEGIN = '<style>'; //003Cstyle
    public const STYLE_CLASS_BEGIN = '.';
    public const STYLE_CLASS_END = ' ';
    public const STYLE_END = '</style>';

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

        $result = $this->parsePage($content);
        return $this->render('views/default/result.html.twig', [
            'url' => $url,
            'content' => $result,
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
                'elements' =>  $this->parsePage($content),
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

    public function parsePage(string $content): ?string
    {
        if (!str_contains($content, self::STYLE_BEGIN)) {
            return '';
        };

        $result = '';
        $style = '';

        $beginStyle = strpos($content, self::STYLE_BEGIN);
        $search = true;
        while ($search) {
            $endStyle = strpos($content, self::STYLE_END, $beginStyle + strlen(self::STYLE_BEGIN) );

            $style .= substr($content, $beginStyle,$endStyle - $beginStyle);

            $search = $beginStyle = strpos($content,self::STYLE_BEGIN, $beginStyle + strlen(self::STYLE_BEGIN));
        }

        $classElements = '';
        $beginClass = strpos($style, self::STYLE_CLASS_BEGIN);
        $search = true;
        while ($search) {
            $endClass =
                strpos(
                    $style,
                    self::STYLE_CLASS_END,
                    $beginClass + strlen(self::STYLE_CLASS_BEGIN)
                );

            $classElements .= substr($style, $beginClass, $endClass - $beginClass) . ' ';

            $search = $beginClass = strpos(
                $style,
                self::STYLE_CLASS_BEGIN, $beginClass + strlen(self::STYLE_CLASS_BEGIN));
        }

        return $classElements;
    }

}
