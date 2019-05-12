<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CustomerRequestNotification extends Notification
{
    use Queueable;

    public $user;
    public $product;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$product)
    {
        $this->user = $user;
        $this->product = $product;
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
                    ->line("A new customer is requesting information on 
                    {$this->product->type} {$this->product->year} {$this->product->make} 
                {$this->product->model} having VIN - {$this->product->vin} belonging
                to {$this->product->dealer->name} at {$this->product->dealer->state},
                {$this->product->dealer->city}, {$this->product->dealer->zip}")
            ->line('Customer Information:')
            ->line('Name: '.$this->user->name)
            ->line('Email: '.$this->user->email)
            ->line('Phone: '.$this->user->phone)
            ->line('Message: '.$this->user->description)
            ->line('Offer Price: '.$this->user->offer_price);

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
