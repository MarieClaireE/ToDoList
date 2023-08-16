<?php

	namespace App\Controller;

	use App\Entity\Task;
	use App\Form\TaskType;
	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Symfony\Component\Validator\Constraints\DateTime;
	use Twig\Environment;

class TaskController extends AbstractController
{
			/**
			 * @var Environment $twig
			 */
			private $twig;
			/**
			 * @var EntityManagerInteface $manager
			 */
			private $manager;

			/**
			 * Contruct TaskController 
			 */
			public function __construct(Environment $twig, EntityManagerInterface $manager) 
			{
							$this->twig = $twig;
							$this->manager = $manager;
							return $this;
			}
			// end __construct

			#[Route("/tasks", name:"task_list")]
			public function listAction(): Response
			{
				return new Response($this->twig->render('task/list.html.twig', [
					'tasks' => $this->manager->getRepository(Task::class)->findAll(),
					'user' => $this->getUser()
				]));
			}

			#[Route("/tasks/create", name:"task_create")]
			public function createTask(Request $request): Response
			{
				$user = $this->getUser();
				$task = new Task();
				$form = $this->createForm(TaskType::class, $task);

				$form->handleRequest($request);

				if($form->isSubmitted() && $form->isValid()){

					$task->setCreatedAt(new \DateTimeImmutable());
					$task->setIsDone(false);

					if(!is_null($user)){
						$task->setCreatedBy($user);
					} else {
						$task->setCreatedBy(NULL);
					}

					$this->manager->persist($task);
					$this->manager->flush();

					$this->addFlash('success', 'La tâche a bien été ajoutée.');

					return $this->redirectToRoute('task_list');
				}

				return new Response($this->twig->render('task/create.html.twig', [
					'form' => $form->createView(),
				]));
			}

			#[Route("/tasks/{id}/edit", name:"task_edit")]
			public function editAction(Request $request, Task $task): Response
			{
				$form = $this->createForm(TaskType::class, $task);
				$form->handleRequest($request);

				if($form->isSubmitted() && $form->isValid()) {
					$task->setCreatedAt(new \DateTimeImmutable());

					$this->manager->flush();
					$this->addFlash('success', 'La tâche a bien été modifiée.');

					return $this->redirectToRoute('task_list');
				}

				return new Response($this->twig->render('task/edit.html.twig', [
					'form' => $form->createView(),
					'task' => $task
				]));
			}

			/**
			 * marquer comme fait une tâche
			 * @return Response
			 */
			#[Route("/tasks/{id}/toggle", name:"task_toggle")]
			public function toggleTaskAction(Task $task): Response
			{
				$task->toggle(!$task->isIsDone());
				$this->manager->flush();

				$this->addFlash('success', sprintf('La tâche %s a bien été marquée comme réalisée.', $task->getTitle()));

				return $this->redirectToRoute('task_list');
			}

			#[Route("/tasks/{id}/delete", name:"task_delete")]
			public function deleteTaskAction(Task $task): Response
			{
				$this->manager->remove($task);
				$this->manager->flush();

				$this->addFlash('success', 'La tâche a bien été supprimée.');

				return $this->redirectToRoute('task_list');
			}
}