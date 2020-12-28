<?php

namespace timeSeries\hitTrack;

class HourlyHitTrack extends AbstractCacheHitTrackReport implements HitTrack, HitReport
{
    public function timeFormat () : string {
        return "YmdH";
    }

    public function suggestedOutputTimeFormat () : string {
        return "d/H";
    }

    public function storeDuration () : int {
        return 86400;
    }

    public function storeLookBackFormat () : string {
        return "-1 hour";
    }
}