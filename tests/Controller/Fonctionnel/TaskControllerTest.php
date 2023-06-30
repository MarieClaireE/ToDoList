<?php

	namespace App\Tests\Controller\Fonctionnel;

	use Symfony\Bundle\FrameworkBundle\KernelBrowser;
	use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
	use Symfony\Component\DomCrawler\Crawler;

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

		public function testTaskIsDone(): void
		{

		}
	}