<?php

	namespace App\Tests\Entity;


	use App\Entity\Task;
	use App\Entity\User;
	use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

	class TaskTest extends WebTestCase
	{
		private $task;
		private $date;
		private $user;

		public function setUp(): void
		{
			$this->task = new Task();
			$this->date = new \DateTimeImmutable();
			$this->user = new User();
		}

		public function testCreatedAt(): void
		{
			$this->task->setCreatedAt($this->date);
			$this->assertSame($this->date, $this->task->getCreatedAt());
		}

		public function testTitle(): void
		{
			$this->task->setTitle('Test titre');
			$this->assertSame('Test titre', $this->task->getTitle());
		}

		public function testContent(): void
		{
			$this->task->setContent('Test content');
			$this->assertSame('Test content', $this->task->getContent());
		}

		public function testIsDone(): void
		{
			$this->task->toggle(true);
			$this->assertEquals(true, $this->task->isIsDone());
		}

		public function testCreatedBy(): void
		{
			$this->task->setCreatedBy($this->user);
			$this->assertInstanceOf(User::class, $this->task->getCreatedBy());
		}

	}