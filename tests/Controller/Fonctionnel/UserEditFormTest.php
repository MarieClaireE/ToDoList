<?php

	namespace App\Tests\Controller\Fonctionnel;

	use App\Repository\UserRepository;
	use Symfony\Bundle\FrameworkBundle\KernelBrowser;
	use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
	use Symfony\Component\DomCrawler\Crawler;
	use Symfony\Component\HttpFoundation\Response;

	class UserEditFormTest extends WebTestCase
	{
		private Crawler $crawler;
		private KernelBrowser $client;

		protected function setUp(): void
		{
			parent::setUp();
			$this->client = static::createClient();
			$userRepository = static::getContainer()->get(UserRepository::class);
			$user = $userRepository->find(2);
			$id = $user->getId();
			$this->crawler = $this->client->request('GET', "users/{$id}/edit");
			$this->assertResponseIsSuccessful();
		}

		public function testEditPasswordMustBeTheSame(): void
		{
			$this->assertSelectorNotExists('#user ul li');
			$form = $this->crawler->selectButton('Ajouter')->form();

			$form['user[password]'] = [
				'first' => "pass",
				'second' => "passs"
			];

			$this->client->submit($form);
			$this->assertSelectorExists('#user ul li', "Les deux mots de passe doivent correspondre.");
		}


		public function testEditUsernameIsNotEmpty(): void
		{
			$form = $this->crawler->selectButton('Ajouter')->form();
			$userRepository = static::getContainer()->get(UserRepository::class);
			$user = $userRepository->find(2);
			$username = $user->getUsername();
			$form['user[username]'] = $username;
			$this->client->submit($form);
			// $this->assertSame('', $username);
			// $this->client->followRedirect();
		}

		public function testEditEmailIsNotEmpty(): void
		{
			$form = $this->crawler->selectButton('Ajouter')->form();
			$email = '';
			$form['user[email]'] = $email;
			$this->client->submit($form);
			$this->assertSame('', $email);
			// $this->client->followRedirect();
		}

		/* public function testRoleUser(): void
		{
			$form = $this->crawler->selectButton('Ajouter')->form();
			$role[] = 'ROLE_ADMIN';
			$form['user[roles-select]'] = $role;
			$this->client->submit($form);
			$this->assertSame('["ROLE_USER"]', $role);
		} */

	}