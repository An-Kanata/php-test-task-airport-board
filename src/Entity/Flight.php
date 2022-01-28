<?php

namespace App\Entity;

class Flight
{
    private Airport $fromAirport;
    private string $fromTime;
    private Airport $toAirport;
    private string $toTime;

    public function __construct(Airport $fromAirport, string $fromTime, Airport $toAirport, string $toTime)
    {
        $this->fromAirport = $fromAirport;
        $this->fromTime = $fromTime;
        $this->toAirport = $toAirport;
        $this->toTime = $toTime;
    }

    public function getFromAirport(): Airport
    {
        return $this->fromAirport;
    }

    public function getFromTime(): string
    {
        return $this->fromTime;
    }

    public function getToAirport(): Airport
    {
        return $this->toAirport;
    }

    public function getToTime(): string
    {
        return $this->toTime;
    }

    public function calculateDurationMinutes(): int
    {
        $to = $this->calculateMinutesFromStartDay($this->toTime) - intval($this->toAirport->getTimeZone())*60;
        $from = $this->calculateMinutesFromStartDay($this->fromTime) - intval($this->fromAirport->getTimeZone())*60;
        while ($to < $from) {$to += 1440;} //добавляем сутки если время прилёта меньше времени вылета
        $time = $to - $from;
        return $time;
    }

    private function calculateMinutesFromStartDay(string $time): int
    {
        [$hour, $minutes] = explode(':', $time, 2);

        return 60 * (int) $hour + (int) $minutes;
    }
}