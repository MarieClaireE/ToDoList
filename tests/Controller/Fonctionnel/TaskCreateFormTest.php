<?php

	namespace App\Tests\Controller\Fonctionnel;


	use Symfony\Bundle\FrameworkBundle\KernelBrowser;
	use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
	use Symfony\Component\DomCrawler\Crawler;

	class TaskCreateFormTest extends WebTestCase
	{
		private Crawler $crawler;
		private KernelBrowser $client;

		protected function setUp(): void
		{
			parent::setUp();
			$this->client = static::createClient();
			$this->crawler = $this->client->request('GET', '/tasks/create');
			$this->assertResponseIsSuccessful();
		}

		public function testTitleIsNotEmpty(): void
		{
			$form = $this->crawler->selectButton('Ajouter')->form();
			$titre = '';
			$form['task[title]'] = $titre;
			$this->client->submit($form);
			$this->assertSame('', $titre);
		}


		public function testContentIsNotEmpty(): void
		{
			$form = $this->crawler->selectButton('Ajouter')->form();
			$content = '';
			$form['task[content]'] = $content;
			$this->client->submit($form);
			$this->assertSame('', $content);
		}
	}