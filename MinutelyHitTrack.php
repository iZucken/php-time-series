<?php

namespace timeSeries\hitTrack;

class MinutelyHitTrack extends AbstractCacheHitTrackReport implements HitTrack, HitReport
{
    public function timeFormat () : string {
        return "mdHi";
    }

    public function suggestedOutputTimeFormat () : string {
        return "H:i";
    }

    public function storeDuration () : int {
        return 3600;
    }

    public function storeLookBackFormat () : string {
        return "-1 minute";
    }
}