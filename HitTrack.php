<?php

namespace timeSeries\hitTrack;

interface HitTrack
{
    public function trackHit( string $key );
}