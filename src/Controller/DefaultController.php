<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


class DefaultController extends AbstractController
{

			/**
			 * @var Environment $twig
			 */
			private $twig;

			/**
			 * @param Environment $twig
			 */
			public function __construct(Environment $twig)
			{

				$this->twig = $twig;
				return $this;

			}
			// End __construct()

			/**
			 * @return Response
			 */
			#[Route("/", name:"homepage")]
			public function indexAction(): Response
			{
				return new Response($this->twig->render('default/index.html.twig',[
							'user' => $this->getUser()
					])
				);
			}		
}
