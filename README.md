# reading-record
A simple Web interface for an avid reader who would like to keep a record of his/her reading collection electronically. (An assessed exercise for SCC130 Term 3)

## ../config.php Sample
```
if (defined("CONFIG_NO_DIRECT")) {
    define("DB_HOST", "[HOST]");
    define("DB_USER", "[USERNAME]");
    define("DB_PASSWORD", "[PASSWORD]");
    define("DB_NAME", "[NAME]");

    $genres = [
        1 => "Action and adventure",
        2 => "Art",
        3 => "Autobiography",
        4 => "Biography",
        5 => "Book review",
        6 => "Cookbook",
        7 => "Comic book",
        8 => "Diary",
        9 => "Dictionary",
        10 => "Crime",
        11 => "Encyclopedia",
        12 => "Drama",
        13 => "Fairytale",
        14 => "Health",
        15 => "Fantasy",
        16 => "History",
        17 => "Journal",
        18 => "Math",
        19 => "Horror",
        20 => "Mystery",
        21 => "Textbook",
        22 => "Poetry",
        23 => "Review",
        24 => "Science",
        25 => "Romance",
        26 => "Travel",
        27 => "Thriller"
    ];
} else {
    echo "hello, what do you think you're doing here?";
}
```
