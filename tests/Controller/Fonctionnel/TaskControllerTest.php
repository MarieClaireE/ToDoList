<?php

	namespace App\Tests\Controller\Fonctionnel;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
	use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
	use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Request;

	class TaskControllerTest extends WebTestCase
	{

		private Crawler $crawler;
		private KernelBrowser $client;

		protected function setUp(): void
		{
			parent::setUp(); // TODO: Change the autogenerated stub
			$this->client = static::createClient();
		}

		public function testListTasksIsEmpty(): void
		{
			$this->crawler = $this->client->request('GET', '/tasks');
			$this->assertResponseIsSuccessful();
			$this->assertSelectorNotExists('col-sm-4 col-lg-4 col-md-4', 'La liste des taches n\'apparait pas ');
		}

		public function testTaskIsNotDone(): void
		{
			$this->crawler = $this->client->request('GET', '/tasks');
			$this->assertResponseIsSuccessful();
			$this->assertSelectorNotExists('glyphicon glyphicon-ok', 'La tache n\'est pas terminé');
		}

		public function testButtonDeleteNotAppears(): void
		{
			$this->crawler = $this->client->request('GET', '/tasks');
			$this->assertResponseIsSuccessful();
			$this->assertSelectorNotExists('btn btn-danger btn-sm pull-right', 'Le bouton supprimer n\'apparait pas.');
		}

	
	}