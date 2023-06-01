<?php

	namespace App\Controller;

	use App\Entity\User;
	use App\Form\UserType;
	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
	use Symfony\Component\Routing\Annotation\Route;
	use Twig\Environment;

	class UserController extends AbstractController
	{
		private Environment $twig;
		private EntityManagerInterface $em;

		public function __construct(Environment $twig, EntityManagerInterface $em) {
			$this->twig = $twig;
			$this->em = $em;

			return $this;
		}

		#[Route("/users", name:"user_list")]
		public function listAction(): Response
		{
			return new Response($this->twig->render('user/list.html.twig',[
				'users' => $this->em->getRepository(User::class)->findAll()
			]));
		}

		#[Route("/users/create", name:"user_create")]
		public function createAction(Request $request, UserPasswordHasherInterface $hashed): Response
		{
			$user = new User();
			$form = $this->createForm(UserType::class, $user);

			$form->handleRequest($request);

			if($form->isSubmitted() && $form->isValid()) {

				$password = $hashed->hashPassword($user, $user->getPassword());
				$user->setPassword($password);
				$user->setRoles([$_POST['roles-select']]);

				$this->em->persist($user);
				$this->em->flush();

				return $this->redirectToRoute('user_list');
			}

			return new Response($this->twig->render('user/create.html.twig', [
				'form' => $form->createView()
			]));
		}

		#[Route("/users/{id}/edit", name:"user_edit")]
		public function editAction(Request $request, User $user, UserPasswordHasherInterface $hashed): Response
		{
			$form = $this->createForm(UserType::class, $user);
			$form->handleRequest($request);

			if($form->isSubmitted() && $form->isValid()) {
				$role[] = $_POST['roles-select'];
				$password = $hashed->hashPassword($user, $user->getPassword());
				$user->setPassword($password);
				$user->setRoles($role);

				$this->em->flush();
				$this->addFlash('success', "L'utilisateur a bien été modifié.");

				return $this->redirectToRoute('user_list');
			}

			return new Response($this->twig->render('user/edit.html.twig', [
				'form' => $form->createView(),
				'user' => $user
			]));
		}

	}