<?php

class TweetAdmin
{
    public $id;
    public $hideFromCarousel;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getHideFromCarousel()
    {
        return $this->hideFromCarousel;
    }

    /**
     * @param mixed $hideFromCarousel
     */
    public function setHideFromCarousel($hideFromCarousel)
    {
        $this->hideFromCarousel = $hideFromCarousel;
    }

    public function __toString()
    {
        return "Id: $this->id; HideFromCarousel: $this->hideFromCarousel";
    }
}