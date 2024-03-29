<?php

	namespace App\Tests\Controller\Fonctionnel;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
	use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
	use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

	class TaskControllerTest extends WebTestCase
	{

		private Crawler $crawler;
		private KernelBrowser $client;

		protected function setUp(): void
		{
			parent::setUp(); // TODO: Change the autogenerated stub
			$this->client = static::createClient();
		}
		protected static function getUrl($route, $params = [])
		{
			return self::$kernel->getContainer()->get('router')->generate($route, $params, UrlGeneratorInterface::ABSOLUTE_URL);
		}

		public function testListTasksIsEmpty(): void
		{
			$this->crawler = $this->client->request('GET', '/tasks');
			$this->assertResponseIsSuccessful();
			$this->assertSelectorNotExists('col-sm-4 col-lg-4 col-md-4', 'La liste des taches n\'apparait pas ');
		}

		public function testTaskIsDone(): void
		{
			$taskRepo = static::getContainer()->get(TaskRepository::class);
			$testTask = $taskRepo->findOneBy(['id' => 5]);
	
			$param = $testTask->getId();
			$url = $this->getUrl('task_toggle', ['id' => $param]);
	
			$this->crawler = $this->client->request('GET', $url);
	
			$this->assertResponseIsSuccessful();
		}

		public function testTaskIsDelete(): void
		{
			$taskRepo = static::getContainer()->get(TaskRepository::class);
			$testTask = $taskRepo->findOneBy(['id' => 6]);
			$param = $testTask->getId();
			$url = $this->getUrl('task_delete', ['id' => $param]);
			$this->crawler = $this->client->request('GET', $url);
			$this->assertResponseIsSuccessful();
			
		}

	}