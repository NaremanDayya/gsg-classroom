<?php

namespace App\Listeners;

use App\Events\ClassworkCreated;
use App\Jobs\SendClassroomNotification;
use App\Models\User;
use App\Notifications\NewClassworkNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNotificationToAssignedStudents
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ClassworkCreated $event): void
    {
        //عشان نبعت بس لواحد 
        // $user = User::find(1);
        // $user->notify(new NewClassworkNotification($event->classwork));
       
        //لكل ال يوزرز
        // foreach($event->classwork->users as $user)
        // {
        //     $user->notify(new NewClassworkNotification($event->classwork));
        // }
        //عشان نستدعي job 
        $classwork = $event->classwork;
        $job= dispatch(new SendClassroomNotification($classwork->users,
         new NewClassworkNotification($classwork)
        ));
        $job->onQueue('notifications')->onConnection('database');
        // dispatch($job)->onQueue('notifications');
        // SendClassroomNotification::dispatch($classwork ->users, new NewClassworkNotification($classwork));
        //باستخدام ال notification facade     
        // Notification::send($classwork->users , new NewClassworkNotification($classwork));

    }
}
