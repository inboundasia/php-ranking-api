<?php

namespace InboundAsia\Ranking;

class Ranking
{
    const SiteListEndpoint = 'https://api.ranking.works/sites';
    const SerpHistoryEndpoint = 'https://api.ranking.works/serps_history';

    /** @var string */
    private $apikey;

    /**
     * Constructor
     *
     * @param string $apikey
     */
    public function __construct(string $apikey)
    {
        $this->apikey = $apikey;
    }

    public function site_list()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::SiteListEndpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apikey
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $output = curl_exec($ch);
        $response = json_decode($output);

        return $response;
    }

    public function serp_history(array $keywords, $url, $date_range)
    {
        $params = [
            'keywords' => $keywords,
            'url' => $url,
            'date_range' => $date_range
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::SerpHistoryEndpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apikey
        ]);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($ch);
        $response = json_decode($output);

        return $response;
    }
}