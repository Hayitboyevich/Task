<?php

namespace App\Mail;

use App\Models\Tag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TagMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $tag;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('tag.mail', ['tag' => $this->tag]);
    }
}
