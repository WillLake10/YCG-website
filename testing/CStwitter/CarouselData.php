<?php

class CarouselData
{
    public $timeOnSlide;

    /**
     * @return mixed
     */
    public function getTimeOnSlide()
    {
        return $this->timeOnSlide;
    }

    /**
     * @param mixed $timeOnSlide
     */
    public function setTimeOnSlide($timeOnSlide): void
    {
        $this->timeOnSlide = $timeOnSlide;
    }
}