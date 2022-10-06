<?php

class CarouselData
{
    public $timeOnSlide;
    public $showEmoji;
    public $numWeeks;

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

    /**
     * @return mixed
     */
    public function getShowEmoji()
    {
        return $this->showEmoji;
    }

    /**
     * @param mixed $showEmoji
     */
    public function setShowEmoji($showEmoji): void
    {
        $this->showEmoji = $showEmoji;
    }

    /**
     * @return mixed
     */
    public function getNumWeeks()
    {
        return $this->numWeeks;
    }

    /**
     * @param mixed $numWeeks
     */
    public function setNumWeeks($numWeeks): void
    {
        $this->numWeeks = $numWeeks;
    }
}