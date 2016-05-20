<?php
namespace hive2\models;

class Comment{
  private $id;
  private $record_id;
  private $author_id;
  private $author_name;
  private $content;
  private $created;

  public function __construct($id, $record_id, $author_id, $author_name, $content, $created)
  {
    $this->id = $id;
    $this->record_id = $record_id;
    $this->author_id = $author_id;
    $this->author_name = $author_name;
    $this->content = $content;
    $this->created = $created;
  }

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of Record Id
     *
     * @return mixed
     */
    public function getRecordId()
    {
        return $this->record_id;
    }

    /**
     * Get the value of Author Id
     *
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->author_id;
    }

    /**
     * Get the value of Author Name
     *
     * @return mixed
     */
    public function getAuthorName()
    {
        return $this->author_name;
    }

    /**
     * Get the value of Content
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the value of Created
     *
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

}
