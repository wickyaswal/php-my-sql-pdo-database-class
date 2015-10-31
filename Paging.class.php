<?php
/**
 * Class Paging
 *
 * @author    Reza Seyf <reza.safe@icloud.com> 
 * @version   under development
 * @copyright Astara360.com Development Team
 * @link      http://developers.astara360.com
 *
 *
 * USAGE :
 * -------  
 * // include() the class into your code:
 * require_once("Paging.class.php");
 * 
 * // create an instance of the class:
 * $paginate = new Paging();
 *
 * // get the current page_number from the URL
 * $paginate->setPageNumber($_GET['page_number']);
 *
 * // set the count of records you want to show in per page
 * $paginate->setRecordsPerPage(5);
 *
 * // define your SELECT or SHOW query in a different variable:
 * $query = "SELECT * FROM users";
 *
 * // set the query
 * $paginate->setQuery($query);
 *
 * // Generates the limited Query SQL
 * $newQuery = $paginate->generatePagingQuery();
 *
 * // create the result:
 * $listOfUsers = $paginate->query($newQuery);
 *
 * // TIP: you can check the results with var_dump($listOfUsers);
 *
 * // Pass the $listOfUsers array to your view to print the Data in HTML.
 * // or Pass it to the $paginate->generateHtmlView($newQuery)
 *
 * // Now we are going to create HyperLinks for Pagination:
 * $paginate->generatePagingLinks($newPaging);
 *
 * If You Like this code , follow me on the github
 * @git             https://github.com/RezaSeyf
 * Happy coding!
 *
 */ 
    require_once("Db.class.php");

    class Paging extends DB
{
    /**
     * @access private
     * @property array $db_query database query
     */
    protected  $query;

    /**
     * @access private
     * @property integer $records_per_page count of the records inside per page
     */
    protected  $records_per_page;

    /**
     * @access private
     * @property integer $pageNumber page number
     */
    protected  $pageNumber;

    /*************************
     ********* SETTERS ********
     *************************/
    /**
     * Sets Database Query that will be used for pagination
     *
     * @method void setQuery()
     * @param array $value Sets Database Query that will be used for pagination
     */
    public function setQuery($value)
    {
        $this->query = $value;
    }

    /**
     * Sets The Count of Records Per Page
     *
     * @method void setRecordPerPage()
     * @param integer $value Sets The Count of Records Per Page
     */
    public function setRecordsPerPage($value)
    {
        $this->records_per_page = $value;
    }

     /**
     * Sets Page Number
     *
     * @method void setQuery()
     * @param integer $value Sets Page Number
     */
    public function setPageNumber($value)
    {
        $this->pageNumber = $value;
    }



    /*************************
     ********* GETTERS ********
     *************************/
    /**
     * Gets Query of Database
     *
     * @method array getQuery()
     * @return array Gets Query of Database
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Gets Count of the Records Per Page
     *
     * @method integer getRecordPerPage()
     * @return integer Gets Count of the Records Per Page
     */
    public function getRecordsPerPage()
    {
        return $this->records_per_page;
    }


     /**
      * Gets Count of the Records Per Page
      *
      * @method integer getRecordPerPage()
      * @return integer Gets Count of the Records Per Page
      */
      public function getPageNumber()
      {
          return $this->pageNumber;
      }



        /*************************
        ********* Methods ********
        *************************/
    /**
     * Generates Paging Query for further uses.
     *
     * Required properties:
     * --------------------
     *  setQuery()
     *  setRecordsPerPage()
     *
     *
     * @method string generatePagingQuery()
     * @return string Generates Paging Query for further uses.
     */
    public function generatePagingQuery()
    {
        if (empty($this->query) or empty($this->records_per_page))
        {
            return false;
        }
        else
        {
            $starting_position = 0;

            if(isset($this->pageNumber))
                $starting_position = (($this->getPageNumber())-1) * $this->getRecordsPerPage();

            $limitedQuery = $this->getQuery()." LIMIT $starting_position  , " . $this->getRecordsPerPage();
            return $limitedQuery;
        }
    }


    /**
     * Generates HTML View for your Query Results.
     *
     * CAUTION:
     * --------
     * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     * !!! THIS METHOD IS NOT A GOOD PRACTICE FOR PROGRAMMING !!!
     * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     *
     *
     * The best practice for showing your data in html is to write a foreach for the
     * array output of the generatePagingQuery() method.
     * @see    header comments of this file.
     *
     * @param  object $queryString
     * @method void generateHtmlView()
     * @return void Generates HTML View for your Query Results.
     */
    public function generateHtmlView($queryString)
    {

        $countOfRecords = 0;

        $queryExecute = $this->query($queryString);
        foreach ($queryExecute as $r)
            $countOfRecords += 1;


        if ($countOfRecords > 0) {
            foreach ($queryString as $row)
            {
                    echo "<div>".$row['your_db_field_here']." </div>";
                    echo "<div>".$row['your_db_field_here']." </div>";
                    echo "<div>".$row['your_db_field_here']." </div>";
            }
        }
        else
        {
            ?>
            <div> Nothing to Show!</div>
        <?php
        }
    }


    /**
     * Generates Pagination HTML list for the all of pages.
     *
     * @param string $queryString
     * @method void generatePagingLinks()
     * @return void Generates Pagination HTML list for the all of pages.
     */
    public function generatePagingLinks($queryString)
    {
        $self = $_SERVER['PHP_SELF'];
        $countOfRecords = 0;
        $queryExecute = $this->query($queryString);
        foreach ($queryExecute as $r)
           $countOfRecords++;

        if($countOfRecords > 0)
        {
            echo "<ul class='list-inline'>";
                $total_no_of_pages = ceil($countOfRecords/$this->getRecordsPerPage());
                $current_page = 1;

                if(isset($this->pageNumber))
                    $current_page = $this->pageNumber;
            if( $current_page  !=  1)
                {
                    $previous = $current_page - 1;
                      ?><li><a href="<?= $self ?>?page_number=1">اولین</a></li>
                        <li><a href="<?= $self ?>?page_number=<?= $previous ?>">قبلی</a></li><?php
                }
                for($i = 1; $i <= $total_no_of_pages; $i++ )
                {
                    if($i == $current_page )
                        echo "<li><strong>".$i."</strong></li>";
                    else
                        echo "<li><a href='".$self."?page_number=".$i."'>".$i."</a></li>";

                }

                if($current_page  !=  $total_no_of_pages)
                {
                    $next = $current_page + 1;
                    ?><li><a href="<?= $self ?>?page_number=1">اولین</a></li>
                    <li><a href="<?= $self ?>?page_number=<?= $next ?>">قبلی</a></li><?php
                }

            echo "</ul>";
        }
    }

} // End of Paging Class
