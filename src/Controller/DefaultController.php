<?php

	namespace App\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Twig\Environment;


	class DefaultController extends AbstractController
	{
		private Environment $twig;

		public function __construct(Environment $twig)
		{
			$this->twig = $twig;
			return $this;
		}

		#[Route("/", name:"homepage")]
		public function indexAction(): Response
		{
			return new Response($this->twig->render('default/index.html.twig', [
				'user' => $this->getUser()
			]));
		}
	}