<?php

namespace timeSeries\hitTrack;

class ComboHitTrack implements HitTrack
{
    /**
     * @var HitTrack[]
     */
    private $hitTracks;
    function __construct ( array $hitTracks ) {
        $this->hitTracks = $hitTracks;
    }

    function trackHit ( string $key ) {
        foreach ( $this->hitTracks as $hitTrack ) {
            $hitTrack->trackHit( $key );
        }
    }
}