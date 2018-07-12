<?php

require_once("model/manager/Manager.php");
require_once("model/Comment.php");

class CommentManager extends Manager {
  private $_db;

  public function __construct(){
    $db = $this->dbConnect();
    $this->_db = $db;
  }

  public function getComments($postId) {
    $comments = [];
    $query = $this->_db->prepare('SELECT * FROM comment WHERE postId = ? AND status < 2 ORDER BY date DESC');
    $query->execute(array($postId));
  
    while($commentData = $query->fetch()){
      $comments[] = new Comment($commentData);
    }

    return $comments;
  }

  public function getAllComments() {
    $comments = [];
    $query = $this->_db->query('SELECT * FROM comment ORDER BY date DESC');
  
    while($commentData = $query->fetch()){
      $comments[] = new Comment($commentData);
    }

    return $comments;
  }
  
  public function postComment(Comment $comment) {
    $comments = $this->_db->prepare('INSERT INTO comment(postId, author, email, content,responseId, date) VALUES(?,?,?,?,?,NOW())');
    $affectedLines = $comments->execute(array($comment->postId(), $comment->author(), $comment->email(), $comment->content(), $comment->responseId()));
  
    return $affectedLines;
  }

  public function status($commentId, $status){
    $comment = $this->_db->prepare('UPDATE comment SET status = ?, flagged = 0 WHERE id = ?');
    $affectedLines = $comment->execute(array($status, $commentId));

    return $affectedLines;
  }

  public function flag($commentId) {
    $comment = $this->_db->prepare('UPDATE comment SET flagged = 1 WHERE id = ?');
    $affectedLines = $comment->execute(array($commentId));

    return $affectedLines;
  }

  public function delete(Comment $comment){}
  
  public function getAllCommentsWithPagination(){
    $totalRows = $this->_db->query('SELECT COUNT(*) from comment')->fetchColumn();
    $itemsPerPage = 30;
    $totalPages = ceil($totalRows / $itemsPerPage);

    $currentPage = min($totalPages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
      'options' =>array(
        'default'   => 1,
        'min_range' => 1,
      ),
    )));
    
    // Calculate the offset for the query
    $offset = ($currentPage - 1)  * $totalPages;

    // Some information to display to the user
    $start = $offset + 1;
    $end = min(($offset + $itemsPerPage), $totalRows);
    $prevlink = ($currentPage > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($currentPage - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';
    
    $nextlink = ($currentPage < $totalPages) ? '<a href="?page=' . ($currentPage + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $totalPages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';
    
    // Display the paging information
    echo '<div id="paging"><p>', $prevlink, ' Page ', $currentPage, ' of ', $totalPages, ' pages, displaying ', $start, '-', $end, ' of ', $totalRows, ' results ', $nextlink, ' </p></div>';
    
    // Prepare the paged query
    $result = $_db->prepare('
        SELECT
            *
        FROM
            table
        ORDER BY
            name
        LIMIT
            :limit
        OFFSET
            :offset
    ');
    
    // Bind the query params
    $result->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
    $result->bindParam(':offset', $offset, PDO::PARAM_INT);
    $result->execute();
    
    // Do we have any results?
    if ($result->rowCount() > 0) {
        // Define how we want to fetch the results
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $iterator = new IteratorIterator($result);
    
        // Display the results
        foreach ($iterator as $row) {
            echo '<p>', $row['name'], '</p>';
        }
    
    } else {
        echo '<p>No results could be displayed.</p>';
    }
  }
}


