<?php

namespace App\Listeners;

use App\Events\UserRegistrated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Setting;

class CreateSettingRecords
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistrated  $event
     * @return void
     */
    public function handle(UserRegistrated $event)
    {
        $settings = [
            ['name' => 'level', 'description' => 'Show level in dashboard', 'value' => true],
            ['name' => 'instructions', 'description' => 'Show instructions in dashboard', 'value' => false]
        ];

        foreach ($settings as $setting) {
            Setting::create([
                'user_id' =>  $event->id,
                'name' => $setting['name'],
                'description' => $setting['description'],
                'value' => $setting['value']
          ]);
        }


    }
}
