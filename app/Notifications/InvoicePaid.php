<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvoicePaid extends Notification
{
    use Queueable;
    public $token;
    public static $toMailCallback;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage)
            ->subject(Lang::getFromJson('Восстановление пароля'))
            ->line(Lang::getFromJson('Вы получили это письма, потому что к нам поступил запрос на сброс пароля для вашей учётной записи.'))
            ->action(Lang::getFromJson('Восстановить пароль'), url(route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
            ->line(Lang::getFromJson('Срок действия ссылки истекает через :count минут.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::getFromJson('Если вы не запрашивали сброс пароля, никаких дальнейших действий не требуется.'));
    }


    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
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
