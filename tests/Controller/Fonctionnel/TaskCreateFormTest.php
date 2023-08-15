<?php

	namespace App\Tests\Controller\Fonctionnel;

use App\Entity\Task;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class TaskCreateFormTest extends WebTestCase
{
	private Crawler $crawler;
	private KernelBrowser $client;
	private EntityManagerInterface $em;


	protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();
        $url = $this->getUrl('task_create');
        $this->crawler = $this->client->request('GET', $url);
    }

	

    protected static function getUrl($route, $params = [])
    {
        return self::$kernel->getContainer()->get('router')->generate($route, $params, UrlGeneratorInterface::ABSOLUTE_URL);
    }

    public function testTaskCreate(): void
    {

		// $clientRepo = static::getContainer()->get(UserRepository::class);
		
		// $user = $clientRepo->findOneBy(['id' => 2]);

		// $task = new Task;
		// $task->setTitle('titre 6');
		// $task->setContent('content 6');
		// $task->setCreatedBy($user);
		
		
		// $this->em->persist($task);
		

		$form = $this->crawler->selectButton('Ajouter')->form();

		// $form['task[title]'] = $task->getTitle();
		// $form['task[content]'] = $task->getContent();

		$this->client->submit($form);

		$this->client->request('GET', '/tasks');
		$this->assertResponseIsSuccessful();
    }	
}