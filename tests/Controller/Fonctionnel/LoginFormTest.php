<?php

	namespace App\Tests\Controller\Fonctionnel;

	use App\Repository\UserRepository;
	use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

	class LoginFormTest extends WebTestCase
	{
		public function testVisitingWithLoggedIn(): void
		{
			$client = static::createClient();
			$userRepository = static::getContainer()->get(UserRepository::class);

			$testUser = $userRepository->findOneBy(['email' => 'mcemma.974@gmail.com']);

			$client->loginUser($testUser);

			$client->request('GET', '/');
			$this->assertResponseIsSuccessful();
		}
	}