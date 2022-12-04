<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 *
 */
class DefaultController extends AbstractController
{
    public function __construct(
    )
    {
    }

    /**
     * Home page
     *
     * @Route("/", name="homepage", methods={"GET"})
     *
     * * @Template("views/default/index.html.twig")
     * @return void
     */
    public function indexAction(): void
    {
        $test = true;
        $test = false;
    }
}
