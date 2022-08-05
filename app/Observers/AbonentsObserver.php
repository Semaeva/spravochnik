<?php

namespace App\Observers;

use App\Models\Abonents;

class AbonentsObserver
{
    /**
     * Handle the Abonents "created" event.
     *
     * @param  \App\Models\Abonents  $abonents
     * @return void
     */
    public function created(Abonents $abonents)
    {
//        $abonents->name = 'Новый-'.$abonents->name;
//        $abonents->save();
//        return redirect()->back()->with('message','Operation Successful !');
    }

    /**
     * Handle the Abonents "updated" event.
     *
     * @param  \App\Models\Abonents  $abonents
     * @return void
     */
    public function updated(Abonents $abonents)
    {
        //
    }

    /**
     * Handle the Abonents "deleted" event.
     *
     * @param  \App\Models\Abonents  $abonents
     * @return void
     */
    public function deleted(Abonents $abonents)
    {
        //
    }

    /**
     * Handle the Abonents "restored" event.
     *
     * @param  \App\Models\Abonents  $abonents
     * @return void
     */
    public function restored(Abonents $abonents)
    {
        //
    }

    /**
     * Handle the Abonents "force deleted" event.
     *
     * @param  \App\Models\Abonents  $abonents
     * @return void
     */
    public function forceDeleted(Abonents $abonents)
    {
        //
    }
}
