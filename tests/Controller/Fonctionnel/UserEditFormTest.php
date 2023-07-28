<?php

	namespace App\Tests\Controller\Fonctionnel;

	use App\Repository\UserRepository;
	use Symfony\Bundle\FrameworkBundle\KernelBrowser;
	use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
	use Symfony\Component\DomCrawler\Crawler;
	use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

	class UserEditFormTest extends WebTestCase
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

		public function testEditUser(): void
		{
			$this->client = static::createClient();

			$userRepo = static::getContainer()->get(UserRepository::class);
			$testUser = $userRepo->findOneBy(["email" => "mcemma.974@gmail.com"]);

			$param = $testUser->getId();
			$url = $this->getUrl('user_edit', ["id" => $param]);

			$this->crawler = $this->client->request('GET', $url);

			$this->assertResponseIsSuccessful();
		}

	}