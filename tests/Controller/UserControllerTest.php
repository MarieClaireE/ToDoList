<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testCreateUser(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/users/create');

				//$buttonCreate = $crawler->selectButton('submit');
	      $buttonCreate = $client->submitForm('submit', [
					'form[username]' => 'Pete'
	      ]);
				//$form = $buttonCreate->form();

				//$form['form[username]'] = 'Pete';
				//$client->submit($form);
				$client->followRedirect();
				echo $client->getResponse()->getContent();

        //$this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('h1', 'Créer un utilisateur');
    }
}
