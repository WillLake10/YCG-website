<?php

class Tweet {
    public $id;
    public $text;
    public $type;
    public $createdAt;
    public $authorId;
    public $authorName;
    public $authorUsername;
    public $authorProfileImgUrl;
    public $hasImg;
    public $imgAlt;
    public $imgType;
    public $imgUrl;

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
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @param mixed $authorId
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
    }

    /**
     * @return mixed
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @param mixed $authorName
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;
    }

    /**
     * @return mixed
     */
    public function getAuthorUsername()
    {
        return $this->authorUsername;
    }

    /**
     * @param mixed $authorUsername
     */
    public function setAuthorUsername($authorUsername)
    {
        $this->authorUsername = $authorUsername;
    }

    /**
     * @return mixed
     */
    public function getAuthorProfileImgUrl()
    {
        return $this->authorProfileImgUrl;
    }

    /**
     * @param mixed $authorProfileImgUrl
     */
    public function setAuthorProfileImgUrl($authorProfileImgUrl)
    {
        $this->authorProfileImgUrl = $authorProfileImgUrl;
    }

    /**
     * @return mixed
     */
    public function getHasImg()
    {
        return $this->hasImg;
    }

    /**
     * @param mixed $hasImg
     */
    public function setHasImg($hasImg)
    {
        $this->hasImg = $hasImg;
    }

    /**
     * @return mixed
     */
    public function getImgAlt()
    {
        return $this->imgAlt;
    }

    /**
     * @param mixed $imgAlt
     */
    public function setImgAlt($imgAlt)
    {
        $this->imgAlt = $imgAlt;
    }

    /**
     * @return mixed
     */
    public function getImgType()
    {
        return $this->imgType;
    }

    /**
     * @param mixed $imgType
     */
    public function setImgType($imgType)
    {
        $this->imgType = $imgType;
    }

    /**
     * @return mixed
     */
    public function getImgUrl()
    {
        return $this->imgUrl;
    }

    /**
     * @param mixed $imgUrl
     */
    public function setImgUrl($imgUrl)
    {
        $this->imgUrl = $imgUrl;
    }
}
