<?php

	namespace App\Controller;

	use App\Entity\Task;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\Routing\Annotation\Route;

	class TaskController extends AbstractController
	{
		#[Route("/tasks", name:"task_list")]
		public function listAction() {}

		#[Route("/tasks/create", name:"task_create")]
		public function createTask(Request $request) {}

		#[Route("/tasks/{id}/edit", name:"task_edit")]
		public function editAction(Request $request, Task $task) {}

		#[Route("/tasks/{id}/toggle", name:"task_toggle")]
		public function toggleTaskAction(Task $task) {}

		#[Route("/tasks/{id}/delete", name:"task_delete")]
		public function deleteTaskAction(Task $task) {}
	}