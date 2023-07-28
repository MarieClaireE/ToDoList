<?php

namespace App\Tests\Controller\Fonctionnel;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class TaskEditFormTest extends WebTestCase
{
    private Crawler $crawler;
    private KernelBrowser $client;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected static function getUrl($route, $params = [])
    {
        return self::$kernel->getContainer()->get('router')->generate($route, $params, UrlGeneratorInterface::ABSOLUTE_URL);
    }

    public function testformEdit(): void
    {

        $this->client = static::createClient();

        $taskRepo = static::getContainer()->get(TaskRepository::class);
        $testTask = $taskRepo->findOneBy(['id' => 5]);

        $param = $testTask->getId();
        $url = $this->getUrl('task_edit', ['id' => $param]);

        $this->crawler = $this->client->request('GET', $url);

        $this->assertResponseIsSuccessful();

    }
}