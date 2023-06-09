<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testHomepage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

				//$client->clickLink('Créer une nouvelle tâche');
				$linkCreateTask = $crawler->selectLink('Créer une nouvelle tâche')->link();
				$linkTaskList = $crawler->selectLink('Consulter la liste des tâches à faire')->link();
				$linkTaskDone = $crawler->selectLink('Consulter la liste des tâches terminées')->link();
				$linkCreateUser = $crawler->selectLink('Créer un utilisateur')->link();
				$linkConnection = $crawler->selectLink('Se connecter')->link();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Bienvenue sur Todo List, l\'application vous permettant de gérer l\'ensemble de vos tâches sans effort !');
				$client->click($linkCreateTask);
				$client->click($linkTaskList);
				$client->click($linkTaskDone);
	      $client->click($linkCreateUser);
	      $client->click($linkConnection);



    }
}
