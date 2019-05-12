<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ContactUsRequestSupport extends Notification
{
    use Queueable;

    public $infodetails;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($infodetails)
    {
        $this->user = $infodetails;
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line("A new customer is requesting customer support information are:")
            ->line('Contact Person: '.$this->user->contact_person)
            ->line('Dealership Name: '.$this->user->dealership_name)
            ->line('Email: '.$this->user->email)
            ->line('City: '.$this->user->city)
            ->line('State: '.$this->user->state)
            ->line('Zip: '.$this->user->zipcode)
            ->line('Phone: '.$this->user->phone)
            ->line('Issue type: '.$this->user->issue_type)
            ->line('Issue Details: '.$this->user->issuedetails);

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
