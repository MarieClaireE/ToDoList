<?php

	namespace App\Tests\Controller\Fonctionnel;


	use Symfony\Bundle\FrameworkBundle\KernelBrowser;
	use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
	use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

	class TaskCreateFormTest extends WebTestCase
	{
		private Crawler $crawler;
		private KernelBrowser $client;

		protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $url = $this->getUrl('task_create');
        $this->crawler = $this->client->request('GET', $url);
        $this->assertResponseIsSuccessful();
    }

    protected static function getUrl($route, $params = [])
    {
        return self::$kernel->getContainer()->get('router')->generate($route, $params, UrlGeneratorInterface::ABSOLUTE_URL);
    }

    public function testTaskCreate(): void
    {

       $form = $this->crawler->selectButton('Ajouter')->form();
       $this->client->submit($form);
       $this->client->request('GET', '/tasks');
       $this->assertResponseIsSuccessful();
    }
		// protected function setUp(): void
		// {
		// 	parent::setUp();
		// 	$this->client = static::createClient();
		// 	$this->crawler = $this->client->request('GET', '/tasks/create');
		// 	$this->assertResponseIsSuccessful();
		// }

		// public function testTaskCreate(): void
		// {
		// 	$form = $this->crawler->selectButton('Ajouter')->form();

		// 	$this->client->submit($form);

		// 	$this->client->request('GET', '/tasks');
       	// 	$this->assertResponseIsSuccessful();
		// }
		// public function testTitleIsEmpty(): void
		// {
		// 	$form = $this->crawler->selectButton('Ajouter')->form();
		// 	$titre = '';
		// 	$form['task[title]'] = $titre;
		// 	$this->client->submit($form);
		// 	$this->assertSame('', $titre);
		// 	// $this->client->followRedirect();
		// }


		// public function testContentIsEmpty(): void
		// {
		// 	$form = $this->crawler->selectButton('Ajouter')->form();
		// 	$content = '';
		// 	$form['task[content]'] = $content;
		// 	$this->client->submit($form);
		// 	$this->assertSame('', $content);
		// 	// $this->client->followRedirect();
		// }
	}