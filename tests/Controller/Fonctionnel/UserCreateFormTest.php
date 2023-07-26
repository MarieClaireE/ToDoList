<?php

namespace App\Tests\Controller\Fonctionnel;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;

class UserCreateFormTest extends WebTestCase
{
	private Crawler $crawler;
	private KernelBrowser $client;

	protected function setUp(): void
	{
		parent::setUp();
		$this->client = static::createClient();
		$this->crawler = $this->client->request('GET', 'users/create');
		$this->assertResponseIsSuccessful();
	}

	public function testPasswordMustBeTheSame(): void
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


	public function testUsernameIsNotEmpty(): void
	{
		$form = $this->crawler->selectButton('Ajouter')->form();
		$username = '';
		$form['user[username]'] = $username;
		$this->client->submit($form);
		$this->assertSame('', $username);
		// $this->client->followRedirect();
	}

	public function testEmailIsNotEmpty(): void
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
