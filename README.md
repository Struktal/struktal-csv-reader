# CSVReader for PHP
This is a PHP library to easily read CSV files. 

## Installation
To install this library, include it in your project using composer:
```json
{
    "require": {
        "jensostertag/csvreader": "1.0.0"
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
          ->setHeader(false)
          ->setDelimiter(";")
          ->setMaxLineLength(null)
          ->read();

// Get the CSV Data
$data = $csvReader->getData();
```
You can use the `setHeader(bool $header)` method to specify whether the CSV file contains a header or not. If the method is called with `true` as parameter, the first row will be skipped and not returned in the `$data` array. By default, no header is assumed.

Instead of explicitly setting the delimiter, you can also use the `detectDelimiter()` method. This method uses the first line of the CSV file to detect which character of `,`, `;`, `\t` or `|` occurs most often and uses it as the delimiter.
> Warning: If the first line of the CSV file contains `,`, `;`, `\t` or `|` more often than the actual delimiter, the method will not detect the correct delimiter. 

As an example, if the CSV file looks like this:
```csv
name;age;city
Alice;25;New York
Bob;30;London
Charlie;20;Berlin
David;35;Paris
Frank;40;Tokyo
```
the returned `$data` array would be:
```php
[
    [
        "name",
        "age",
        "city"
    ],
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
If you'd call the `setHeader(bool $header)` method with `true` as parameter, the contents of the first row will be omitted from the `$data` array:
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
