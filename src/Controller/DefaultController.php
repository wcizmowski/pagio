<?php

namespace App\Controller;

use App\Entity\Auto;
use App\Entity\District;
use App\Entity\Make;
use App\Entity\Model;
use App\Entity\Question;
use App\Enum\AutoEngine;
use App\Enum\AutoPrice;
use App\Service\SMailer;
use FOS\UserBundle\Model\UserManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Swift_Mailer;
use Swift_SmtpTransport;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Swagger\Annotations as SWG;

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
    }
}
