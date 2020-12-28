<?php

namespace timeSeries\hitTrack;

class DailyHitTrack extends AbstractCacheHitTrackReport implements HitTrack, HitReport
{
    function storeDuration () : int {
        return 2592000;
    }

    function storeLookBackFormat () : string {
        return "-1 day";
    }

    public function timeFormat () : string {
        return "Ymd";
    }

    public function suggestedOutputTimeFormat () : string {
        return "m.d";
    }
}