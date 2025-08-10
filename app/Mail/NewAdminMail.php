<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewAdminMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $created_by="";
    protected $email="";
    protected $password="";
    /**
     * Create a new message instance.
     */
    public function __construct($creator_name, $admin_email, $admin_password)
    {
        $this->created_by=$creator_name;
       $this->email=$admin_email;
       $this->password=$admin_password;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Admin Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
           markdown: 'admin.mail.newadminmail',
             with: [
            'created_by' => $this->created_by,
            'email' => $this->email,
            'password' => $this->password,
        ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
