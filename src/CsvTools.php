<?php


namespace GWSN\CsvTools;


class CsvTools
{
    /**
     * @param array $rows
     * @param array $headers
     * @return string
     */
    public static function arrayToCsv(array $rows, array $headers = []): string
    {
        $f = fopen('php://memory', 'w+');

        if(count($headers) > 0) {
            fputcsv($f, $headers, ';');
        }

        if(count($rows) > 0) {
            foreach ($rows as $row) {
                fputcsv($f, $row, ';');
            }
        }

        rewind($f);
        return stream_get_contents($f);
    }
}
