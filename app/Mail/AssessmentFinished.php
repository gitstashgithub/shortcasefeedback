<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssessmentFinished extends Mailable
{
    use Queueable, SerializesModels;

    protected $items;
    protected $name;
    protected $generalComments;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($items, $name, $generalComments)
    {
        $this->items = $items;
        $this->name = $name;
        $this->generalComments = $generalComments;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.assessments.finished')->with([
            'items' => $this->items,
            'name' => $this->name,
            'generalComments' => $this->generalComments,
        ]);
    }
}
