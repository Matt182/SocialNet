<?php
namespace hive2\models;

/**
 * Record object
 */
class Record
{
  private $id;
  private $author;
  private $content;
  private $likes;
  private $created;
  private $comments;

  function __construct($id, $author, $content, $likes, $created, $comments)
  {
    $this->id = $id;
    $this->author = $author;
    $this->content = $content;
    $this->likes = $likes;
    $this->created = $created;
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
     * Get the value of Author
     *
     * @return int
     */
    public function getAuthor()
    {
        return $this->author;
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
    public function getComments()
    {
        return $this->comments;
    }

}
