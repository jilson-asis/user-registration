<?php

namespace App\Repositories;

use App\Models\Attachment;
use App\Models\Message;

class MessageRepository
{
    /**
     * @var Message
     */
    protected $model;

    public function __construct()
    {
        $this->model = new Message();
    }

    /**
     * @param string $subject
     * @param string $message
     * @param int $sender_id
     * @param int $receiver_id
     * @param null $thread_id
     * @param Attachment $attachment
     * @return Message
     */
    public function createNewMessage($subject, $message, $sender_id, $receiver_id, $thread_id = null, $attachment = null)
    {
        $thread_id = !is_null($thread_id) ? $thread_id : $this->createNewThreadId($subject, $receiver_id);

        return $this->model->create([
            'subject' => $subject,
            'body' => $message,
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'attachment_id' => !is_null($attachment) ? $attachment->id : null,
            'thread_id' => $thread_id,
        ]);
    }

    /**
     * @param string $subject
     * @param int $receiver_id
     * @return string
     */
    protected function createNewThreadId($subject, $receiver_id)
    {
        return md5(sprintf(
            '%s:%s:%s',
            time(),
            $subject,
            $receiver_id
        ));
    }
}
