<?php

	namespace App\Tests\Entity;

	use App\Entity\Task;
	use App\Entity\User;
	use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

	class UserTest extends WebTestCase
	{
		private $user;
		private $tasks;

		public function setUp(): void
		{
			$this->user = new User();
			$this->tasks = new Task();
		}

		public function testUsername(): void
		{
			$this->user->setUsername('Billy');
			$this->assertSame('Billy', $this->user->getUsername());
		}

		public function testEmail(): void
		{
			$this->user->setEmail('test@test.com');
			$this->assertSame('test@test.com', $this->user->getEmail());
		}

		public function testPassword(): void
		{
			$this->user->setPassword('Password');
			$this->assertSame('Password', $this->user->getPassword());
		}

		public function testRole(): void
		{
			$this->user->setRoles(['ROLE_ADMIN']);
			$this->assertSame(['ROLE_ADMIN'], $this->user->getRoles());
		}

		public function testEraseCredential(): void
		{
			$this->assertNull($this->user->eraseCredentials());
		}

		public function testTasks(): void
		{
			$tasks = $this->user->getTasks($this->tasks->getCreatedBy());
			$this->assertSame($this->user->getTasks(), $tasks);

			$this->user->addTask($this->tasks);
			$this->assertCount(1, $this->user->getTasks());

			$this->user->removeTask($this->tasks);
			$this->assertCount(0, $this->user->getTasks());
		}
	}