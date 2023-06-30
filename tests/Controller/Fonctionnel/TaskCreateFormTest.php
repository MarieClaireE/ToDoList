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

		public function testTitleIsEmpty(): void
		{
			$form = $this->crawler->selectButton('Ajouter')->form();
			$titre = 'Titre';
			$form['task[title]'] = $titre;
			$this->client->submit($form);
			$this->assertSame('', $titre);
			// $this->client->followRedirect();
		}


		public function testContentIsEmpty(): void
		{
			$form = $this->crawler->selectButton('Ajouter')->form();
			$content = '';
			$form['task[content]'] = $content;
			$this->client->submit($form);
			$this->assertSame('', $content);
			// $this->client->followRedirect();
		}
	}