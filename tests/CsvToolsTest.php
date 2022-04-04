<?php

namespace UnitTests\GWSN\CsvTools;

use Exception;
use GWSN\CsvTools\CsvTools;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\CodeCoverage\Report\PHP;

class CsvToolsTest extends TestCase
{
    /**
     * @return array
     */
    public function validateProvider() : array
    {
        $headers = ['testHeader A', 'testHeader B'];
        $rows = [
            ['testContent A', 'testContent B']
        ];
        $validateData = [];

        $headerRow = '"'.implode('";"', $headers).'"';
        $contentRow = '"'.implode('";"', $rows[0]).'"';


        // Normal row
        $validateData[] = [$rows, $headers, $headerRow.PHP_EOL.$contentRow.PHP_EOL];

        // Without headers
        $validateData[] = [$rows, [], $contentRow.PHP_EOL];

        // Without data rows
        $validateData[] = [[], $headers, $headerRow.PHP_EOL];

        // Compleet empty
        $validateData[] = [[], [], ''];


        // With multiple rows
        $rows2 = [
            $rows[0],
            $rows[0],
            $rows[0]
        ];

        $validateData[] = [
            $rows2,
            $headers,
            $headerRow.PHP_EOL.$contentRow.PHP_EOL
            .$contentRow.PHP_EOL
            .$contentRow.PHP_EOL
        ];

        return $validateData;
    }

    /**
     * @param array $rows
     * @param array $headers
     * @param string $result
     * @throws Exception
     * @dataProvider validateProvider
     */
    public function testArrayToCsv(array $rows, array $headers, string $result)
    {
        $this->assertEquals($result, CsvTools::arrayToCsv($rows, $headers));
    }
}
