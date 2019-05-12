<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ContactUsRequestInfo extends Notification
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
            ->line("A new customer is requesting more information :")
            ->line('Name: '.$this->user->first_name.''.$this->user->last_name)
            ->line('Title: '.$this->user->title)
            ->line('Dealership Type: '.$this->user->dealership_type)
            ->line('Dealership Name: '.$this->user->dealership_name)
            ->line('Dealership Street Address: '.$this->user->dealership_street_address)
            ->line('City: '.$this->user->city)
            ->line('State: '.$this->user->state)
            ->line('Zipcode: '.$this->user->zipcode)
            ->line('Shipping Country: '.$this->user->shipping_country)
            ->line('Email: '.$this->user->email)
            ->line('Phone: '.$this->user->phone)
            ->line('Comments: '.$this->user->description);

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
