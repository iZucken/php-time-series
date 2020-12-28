<?php

namespace timeSeries\hitTrack;

use cache\Cache;

abstract class AbstractCacheHitTrackReport implements HitTrack, HitReport
{
    protected Cache $cache;
    function __construct ( Cache $cache ) {
        $this->cache = $cache;
    }

    function addTrackingKey ( $key ) {
        $keys = $this->cache->get( 'Keys' );
        if ( empty ( $keys ) ) {
            $this->cache->set( "Keys", $key, $this->storeDuration() );
        } else {
            if ( !in_array( $key, explode("|",$keys ) )) {
                $this->cache->set( "Keys", "$keys|$key", $this->storeDuration() );
            }
        }
    }

    private function trackingKeys () {
        $keys = $this->cache->get( 'Keys' );
        if ( empty( $keys ) ) {
            return [];
        } else {
            return explode( "|", $keys );
        }
    }

    private function stamp ( string $key, \DateTime $dt = null ) {
        return $key . ( $dt ?? new \DateTime() )->format($this->timeFormat() );
    }

    function trackHit ( string $key ) {
        $this->addTrackingKey( $key );
        $this->cache->add( $this->stamp( $key ), 1, 0, $this->storeDuration() );
    }

    function dumpHits () :array {
        $keys = $this->trackingKeys();
        $dt = new \DateTime();
        $hits = [];
        $has_more = true;
        while ( $has_more ) {
            $dt_part = $dt->format($this->timeFormat() );
            $valid = count($keys);
            $acc = [];
            foreach ( $keys as $key ) {
                $value = $this->cache->get( $this->stamp( $key, $dt ) );
                if ( empty($value) ) {
                    $acc[ $key ] = 0;
                    $valid--;
                } else {
                    $acc[ $key ] = $value;
                }
            }
            if ( $valid <= 1 ) {
                $has_more = false;
            } else {
                $hits[ $dt_part ] = $acc;
                $dt->modify($this->storeLookBackFormat() );
            }
        }
        return $hits;
    }

    public abstract function storeDuration() : int;

    public abstract function storeLookBackFormat() : string;

    public abstract function timeFormat () : string;

    public abstract function suggestedOutputTimeFormat () : string;
}