<?php

namespace App\Entity;

class Flight
{
    private Airport $fromAirport;
    private string $fromTime;
    private Airport $toAirport;
    private string $toTime;
    private string $fromDate;
    private string $toDate;

    public function __construct(Airport $fromAirport, string $fromTime, string $fromDate, Airport $toAirport, string $toTime, string $toDate)
    {
        $this->fromAirport = $fromAirport;
        $this->fromTime = $fromTime;
        $this->toAirport = $toAirport;
        $this->toTime = $toTime;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
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

    public function getFromDate(): string
    {
        return $this->fromDate;
    }

    public function getToDate(): string
    {
        return $this->toDate;
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