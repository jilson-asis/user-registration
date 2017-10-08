<?php

namespace Tests\Unit;

use App\Repositories\MessageRepository;
use Tests\TestCase;

class MessageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateMessage()
    {
        $messageRepository = new MessageRepository();

        $response = $messageRepository->createNewMessage(
            'Test Subject',
            'Unit Test Message',
            1,
            2,
            null,
            null
        );

        $this->assertTrue(!is_null($response));
    }

    public function testGetMessages()
    {
        $messageRepository = new MessageRepository();

        $response = $messageRepository->getAllThreadById(1);

        $this->assertTrue(!is_null($response));

        $response = $messageRepository->getByThreadId(1);

        $this->assertTrue(!is_null($response));
    }
}
