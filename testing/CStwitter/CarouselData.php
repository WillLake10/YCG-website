<?php

class CarouselData
{
    public $timeOnSlide;
    public $showEmoji;

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


}