<?php

namespace timeSeries\hitTrack;

interface HitReport
{
    public function timeFormat() : string;
    public function suggestedOutputTimeFormat() : string;
    public function dumpHits() : array;
}