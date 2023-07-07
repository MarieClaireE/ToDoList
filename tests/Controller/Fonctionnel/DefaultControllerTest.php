<?php

namespace App\Tests\Controller\Fonctionnel;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testHomepage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
	      $this->assertResponseIsSuccessful();
				$this->assertSelectorExists('a[href="/login"]');

    }
}
