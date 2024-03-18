<!Doctype html>
<html>

<head>

</head>

<body>

    <?php

    abstract class Literature
    {
        protected $author, $name, $pages, $date, $cover;

        function __construct($author, $name, $pages, $date, $cover)
        {
            $this->author = $author;
            $this->name = $name;
            $this->pages = $pages;
            $this->date = $date;
            $this->cover = $cover;
        }

        protected function showInfo($author, $name, $pages, $date, $cover)
        {
            echo "
                <div>
                    <p> " .
                        $name . "
                    </p>
                </div>
            ";
        }

        abstract protected function render();
    }
    class Book extends Literature
    {
        public $publisher;

        function __construct($author, $name, $pages, $date, $cover, $publisher)
        {
            parent::__construct($author, $name, $pages, $date, $cover);
            $this->publisher = $publisher;
        }

        public function showInfo($author, $name, $pages, $date, $cover)
        {
        }

        public function render()
        {
        }
    }

    ?>

</body>

</html>
