<?php
/**
 * Developer: ONUR KAYA
 * Contact: empatisoft@gmail.com
 */

use GuzzleHttp\Client;

class Diyanet {

    private $client;
    private $baseUrl = 'https://namazvakitleri.diyanet.gov.tr/';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getData($uri, $period = 'monthly', $type = 0) {

        $tab = $period == 'monthly' ? 1 : 0;

        $response = $this->client->request('GET', $this->baseUrl.$uri);
        $content = $response->getBody()->getContents();

        $data = array();
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($content);
        libxml_clear_errors();
        $xpath = new DOMXpath($dom);

        $table_rows = $xpath->query('//div[@id="tab-'.$tab.'"]//table[@class="table vakit-table"]/tbody');
        foreach($table_rows as $row => $tr) {
            foreach($tr->childNodes as $td) {
                $row_values = preg_split("/\s+(.)\s+/", trim($td->nodeValue));
                if(count($row_values) > 1)
                {
                    preg_match('/(.*) (.*) (.*) (.*)/', $row_values[0], $date);
                    $day = $date[1] ?? NULL;
                    $month = $date[2] ?? NULL;
                    $month = $month != NULL ? $this->month($month) : NULL;
                    $year = $date[3] ?? NULL;

                    $data[] = [
                        'miladi' => $row_values[0],
                        'hicri' => $row_values[1],
                        'imsak' => $row_values[2],
                        'gunes' => $row_values[3],
                        'ogle' => $row_values[4],
                        'ikindi' => $row_values[5],
                        'aksam' => $row_values[6],
                        'yatsi' => $row_values[7],
                        'date' => $year.'-'.$month.'-'.$day
                    ];
                }

            }
        }

        if($type == 0) {
            header('Content-type: application/json');
            echo json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
            exit();
        } else if($type == 1) {
            $data = $this->toObject($data);
        }

        return $data;

    }

    private function month($month)
    {
        $names = array(
            '01' => 'Ocak',
            '02' => 'Şubat',
            '03' => 'Mart',
            '04' => 'Nisan',
            '05' => 'Mayıs',
            '06' => 'Haziran',
            '07' => 'Temmuz',
            '08' => 'Ağustos',
            '09' => 'Eylül',
            '10' => 'Ekim',
            '11' => 'Kasım',
            '12' => 'Aralık'
        );
        return array_search($month,$names);
    }


    private function toObject($array) {
        return json_decode(json_encode($array), FALSE);
    }

}