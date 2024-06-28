<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class CSVReader
{
    // Function to parse CSV file and return the data as an array
    public function parse_file($filepath)
    {
        $csvData = [];
        $header = null;

        if (($handle = fopen($filepath, 'r')) !== false) {
            while (($row = fgetcsv($handle, 0, ',')) !== false) {
                if (!$header) {
                    pre($row,1);
                    $header = $row;
                } else {
                    pre($row,1);
                    $csvData[] = array_combine($header, $row);

                }
            }
            fclose($handle);
        }

        return $csvData;
    }
}
