<?php

namespace App\Notifications;

use App\Models\Classwork;
use App\Notifications\Channels\HadaraSmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;

class NewClassworkNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Classwork $classwork)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        //Channels:mail ,database ,broadcast(pusher),vonage/nexmo9و اقل:(sms),slack  
        // return ['mail'];
        // $via = ['database'];
        // receive_mail_notifications لو عنا حقل بالداتابيز عند اليوزر اسمه 
        // if($notifiable->receive_mail_notifications){
        //     $via[] = 'mail';
        // }
        // if($notifiable->receive_push_notifications){
        //     $via[] = 'broadcast';
        // }
        return [
            'database',
            FcmChannel::class,
            // HadaraSmsChannel::class,
            //  'broadcast',
            //   'mail',
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $classwork = $this->classwork;
        $content = __(':name posted a new :type: :title', [
            'name' => $classwork->user->name,
            'type' => $classwork->type,
            'title' => $classwork->title,
        ]);
        return (new MailMessage)
            ->subject(__('New :type', [
                'type' => $classwork->type
            ]))
            ->greeting(__('Hi :name', [
                'name' => $notifiable->name
            ]))
            ->line($content)
            ->action('Go to classwork', route('classroom.classwork.show', [
                'classroom' => $classwork->classroom,
                'classwork' => $classwork->id
            ]))
            ->line('Thank you for using our application!');
    }
    public function toFcm($notifiable)
    {
        $classwork=$this->classwork;
        $content = __(':name posted a new :type: :title', [
            'name' => $classwork->user->name,
            'type' => $classwork->type,
            'title' => $classwork->title,
        ]);
        return FcmMessage::create()
            ->setData([
             'classwork_id' => $classwork->id,
             'user_id' => $classwork->user_id,
             ])
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle('New Classwork')
                ->setBody($content)
                ->setImage('http://example.com/url-to-image-here.png'))
            ->setAndroid(
                AndroidConfig::create()
                    ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
                    ->setNotification(AndroidNotification::create()->setColor('#0A0A0A'))
            )->setApns(
                ApnsConfig::create()
                    ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios')));
    }
    public function toDatabase(object $notifiable): DatabaseMessage
    {
        //بدنا نتعامل مع ستركتشر ثابت 
        return new DatabaseMessage($this->createMessage());
    }
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->createMessage());

    } 

    protected function createMessage()
    {
        $classwork = $this->classwork;
        $content = __(':name posted a new :type: :title', [
            'name' => $classwork->user->name,
            'type' => $classwork->type,
            'title' => $classwork->title,
        ]);
        //بدنا نتعامل مع ستركتشر ثابت 
        return ([
            'title' => (__('New :type', [
                'type' => $classwork->type
            ])),
            'body' => $content,
            'image' => '',
            'link' => route('classroom.classwork.show', [
                'classroom' => $classwork->classroom,
                'classwork' => $classwork->id
            ]),
            'classwork_id' => $classwork->id,
        ]);
    }

    public function toVonage(object $notifiable): VonageMessage
    {
        return (new VonageMessage)
        ->content(__('A new classwork created!'));
    }
     public function toHadara(object $notifiable): string
    {
        return __('A new classwork created!');
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
