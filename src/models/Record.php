<?php
namespace hive2\models;

/**
 * Record object
 */
class Record
{
  private $id;
  private $authorId;
  private $authorName;
  private $owner;
  private $content;
  private $likes;
  private $created;
  private $hasComments;
  private $comments;


  function __construct($id, $authorId, $authorName, $owner, $content, $likes,
                      $created, $hasComments, $comments)
  {
    $this->id = $id;
    $this->authorId = $authorId;
    $this->authorName = $authorName;
    $this->owner = $owner;
    $this->content = $content;
    $this->likes = $likes;
    $this->created = $created;
    $this->hasComments = $hasComments;
    $this->comments = $comments;
  }

    /**
     * Get the value of Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get id of Author
     *
     * @return int
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * Get name of Author
     *
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    public function getOwner()
    {
      return $this->owner;
    }

    /**
     * Get the value of Content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the value of Likes
     *
     * @return int
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Get the value of Created
     *
     * @return DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Get the value of Comments
     *
     * @return boolval
     */
    public function hasComments()
    {
        return $this->hasComments;
    }

    public function getComments()
    {
      return $this->comments;
    }

}
