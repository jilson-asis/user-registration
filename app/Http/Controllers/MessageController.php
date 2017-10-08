<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Repositories\MessageRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    public function compose()
    {
        return view('message.compose');
    }

    public function listMessages(MessageRepository $messageRepository)
    {
        $messages = $messageRepository->getAllThreadById(Auth::id());

        return view('message.list', ['messages' => $messages]);
    }

    public function viewMessage(MessageRepository $messageRepository)
    {
        $messages = $messageRepository->getByThreadId(request('tid'));

        return view('message.view', ['messages' => $messages]);
    }

    public function send(MessageRepository $messageRepository)
    {
        $this->validate(
            request(),
            [
                'subject' => 'required',
                'message' => 'required',
                'to_email' => 'required|exists:users,email',
            ],
            [
                'to_email.exists' => 'The email does not exists.',
                'to_email.required' => 'Recipient email is required.',
            ]
        );

        $receiver_id = User::where('email', request('to_email'))->first()->id;

        $attachment = null;

        if (request()->hasFile('attachment')) {
            $attachment = $this->saveAttachedFile(request()->file('attachment'));
        }

        $messageRepository->createNewMessage(
            request('subject'),
            request('message'),
            Auth::id(),
            $receiver_id,
            null,
            $attachment
        );

        return back()->with('success', 'Your message has been sent!');
    }

    public function reply(MessageRepository $messageRepository)
    {
        $this->validate(request(), [
            'message' => 'required',
            'receiver_id' => 'required|exists:users,id',
            'thread_id' => 'required',
        ]);

        $attachment = null;

        if (request()->hasFile('attachment')) {
            $attachment = $this->saveAttachedFile(request()->file('attachment'));
        }

        $messageRepository->createNewMessage(
            null,
            request('message'),
            Auth::id(),
            request('receiver_id'),
            request('thread_id'),
            $attachment
        );

        return back()->with('success', 'Your reply has been sent!');
    }

    /**
     * @param \Illuminate\Http\UploadedFile $attachment
     * @return Attachment
     */
    private function saveAttachedFile($attachment)
    {
        $filename = md5(sprintf('%s:%s', time(), $attachment->getFilename())) . '.' . $attachment->getClientOriginalExtension();

        $file_path = $attachment->storeAs('attachments', $filename);

        $attachment = Attachment::create([
            'filename' => $attachment->getFilename(),
            'file_path' => $file_path
        ]);

        return $attachment;
    }

}
