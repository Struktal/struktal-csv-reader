# PHP-CSVReader
This is a PHP library to easily read CSV files. 

## Installation
To install this library, include it in your project using composer:
```json
{
    "require": {
        "jensostertag/php-csvreader": "dev-main"
    }
}
```

## Usage
<details>
<summary><b>Read all entries from a CSV file</b></summary>

To read all entries from a CSV file, use the following code:
```php
$csvReader = new CSVReader();

// CSV Reader Options
$csvReader->setFile("path/to/file.csv")
          ->setDelimiter(";")
          ->setMaxLineLength(null)
          ->read();

// Get the CSV Data
$data = $csvReader->getData();
```

Instead of explicitly setting the delimiter, you can also use the `detectDelimiter()` method. This method uses the first line of the CSV file to detect which character of `,`, `;`, `\t` or `|` occurs most often and uses it as the delimiter.
> Warning: If the first line of the CSV file contains `,`, `;`, `\t` or `|` more often than the actual delimiter, the method will not detect the correct delimiter. 

As an example, if the CSV file looks like this:
```csv
Alice;25;New York
Bob;30;London
Charlie;20;Berlin
David;35;Paris
Frank;40;Tokyo
```
with the values standing for name, age and city, the returned `$data` array would be:
```php
[
    [
        "Alice",
        "25",
        "New York"
    ],
    [
        "Bob",
        "30",
        "London"
    ],
    [
        "Charlie",
        "20",
        "Berlin"
    ],
    [
        "David",
        "35",
        "Paris"
    ],
    [
        "Frank",
        "40",
        "Tokyo"
    ]
]
```
</details>
