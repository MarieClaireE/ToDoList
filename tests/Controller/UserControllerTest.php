<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserControllerTest extends WebTestCase
{
    public function testCreateUser(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/users/create');

				$form = $crawler->selectButton('Ajouter')->form();
				//dd($form);

				$form['user[password]'] = [
					'first' => "pass",
					'second' => "passs"
				];
				$client->submit($form);
				$this->assertSame('Erreur: mots de passe ');
				echo $client->getResponse()->getContent();

    }
}
