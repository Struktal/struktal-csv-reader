<?php

namespace struktal\CSVReader;

class CSVReader {
    private $file = null;
    private bool $header = false;
    private ?int $maxLength = null;
    private string $delimiter = ",";
    private array $data = [];

    /**
     * Set the CSV File that should be read
     * @param resource $file File Resource
     * @return $this Self
     */
    public function setFile($file): CSVReader {
        $this->file = $file;
        return $this;
    }

    /**
     * State whether the CSV File has a Header Column
     * @param bool $header
     * @return $this Self
     */
    public function setHeader(bool $header): CSVReader {
        $this->header = $header;
        return $this;
    }

    /**
     * Set the maximum Length of a Line
     * @param int|null $maxLength Maximum Length of a Line
     * @return $this Self
     */
    public function setMaxLineLength(?int $maxLength): CSVReader {
        $this->maxLength = $maxLength;
        return $this;
    }

    /**
     * Set the Delimiter that should be used
     * @param string $delimiter Delimiter
     * @return $this Self
     */
    public function setDelimiter(string $delimiter): CSVReader {
        $this->delimiter = substr($delimiter, 0, 1);
        return $this;
    }

    /**
     * Detect the Delimiter from the CSV File
     * @return $this Self
     */
    public function detectDelimiter(): CSVReader {
        if($this->file !== null) {
            $delimiters = ["," => 0, ";" => 0, "\t" => 0, "|" => 0];

            $handle = fopen($this->file, "r");
            $firstLine = fgets($handle);
            fclose($handle);
            foreach($delimiters as $delimiter => &$count) {
                $count = sizeof(str_getcsv($firstLine, $delimiter));
            }

            $this->delimiter = array_search(max($delimiters), $delimiters);
        }

        return $this;
    }

    /**
     * Read all Data from the CSV File
     * @return $this Self
     */
    public function read(): CSVReader {
        if($this->file !== null) {
            $csvHandle = fopen($this->file, "r");

            // Skip Header
            if($this->header) {
                fgetcsv($csvHandle, $this->maxLength, $this->delimiter);
            }

            // Read Data
            while(($data = fgetcsv($csvHandle, $this->maxLength, $this->delimiter)) !== false) {
                $this->data[] = $data;
            }
        }

        return $this;
    }

    /**
     * Get the Data from the CSV File
     * @return array Data from the CSV File
     */
    public function getData(): array {
        return $this->data;
    }
}
