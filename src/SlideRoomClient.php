<?php

/**
 * Class SlideRoomClient
 *
 * PHP SDK for SlideRoom API V2
 *
 * @link https://api.slideroom.com/
 */
class SlideRoomClient {

  const DEFAULT_API_URL = "https://api.slideroom.com";

  /**
   * @var SlideRoomApplicationResource
   */
  public $application;

  /**
   * @var SlideRoomExportResource
   */
  public $export;

  /**
   * @var string
   */
  private $oauth_token;

  /**
   * @var string
   */
  private $api_url;

  /**
   * @param string $oauth_token
   * @param string $api_url
   */
  public function __construct($oauth_token, $api_url = NULL) {
    $this->oauth_token = $oauth_token;
    $this->api_url = $api_url ? $api_url : self::DEFAULT_API_URL;

    $this->application = new SlideRoomApplicationResource($this);
    $this->export = new SlideRoomExportResource($this);
  }

  /**
   * @param string $method
   * @param string $url
   * @param array $query_parameters
   * @param array $body_params
   *
   * @throws SlideRoomApiErrorException
   * @return array
   */
  public function executeRequest($method, $url, $query_parameters = array(), $body_params = array()) {
    $curl = curl_init();

    $curl_options[CURLOPT_RETURNTRANSFER] = 1;
    $curl_options[CURLOPT_URL] = $this->api_url . $url . "?" . http_build_query($query_parameters);

    switch ($method) {
      case "POST":
        $curl_options[CURLOPT_POST] = 1;
        $curl_options[CURLOPT_POSTFIELDS] = $body_params;
        break;
    }

    $curl_options[CURLOPT_HTTPHEADER] = array(
      "Authorization: Bearer $this->oauth_token",
      "Accept: application/json"
    );
    $curl_options[CURLOPT_USERAGENT] = "slideroom/slideroom-api-php";

    curl_setopt_array($curl, $curl_options);

    $curl_result = curl_exec($curl);

    $curl_error = curl_error($curl);
    $curl_errno = curl_errno($curl);
    if ($curl_error || $curl_errno) {
      throw new SlideRoomApiErrorException($curl_error, $curl_errno);
    }

    curl_close($curl);

    $result = NULL;

    try {
      $result = json_decode($curl_result, 1);
    }
    catch (Exception $e) {
      // Handle empty and invalid curl responses consistently.
    }

    if (!$result) {
      throw new SlideRoomApiErrorException("Invalid SlideRoom API response.");
    }

    return $result;
  }
}

/**
 * Class SlideRoomApplicationResource
 * @private
 */
class SlideRoomApplicationResource {
  /**
   * @var SlideRoomClient
   */
  private $client;

  /**
   * @param SlideRoomClient $client
   */
  public function __construct(SlideRoomClient $client) {
    $this->client = $client;
  }

  /**
   * Requests the generation of a single application export file (tabular, pdf, zip).
   *
   * @param string $application_id
   * @param array $params
   *
   * @throws SlideRoomApiErrorException
   * @return array
   */
  public function requestExportByApplicationId($application_id, $params = array()) {
    $url = "/api/v2/application/$application_id/request-export";
    return $this->client->executeRequest("POST", $url, $params);
  }

  /**
   * Requests the generation of application export files (tabular, pdf, zip).
   *
   * @param array $params
   *
   * @throws SlideRoomApiErrorException
   * @return array
   */
  public function requestExport($params = array()) {
    $url = "/api/v2/application/request-export";
    return $this->client->executeRequest("POST", $url, $params);
  }
}

/**
 * Class SlideRoomExportResource
 * @private
 */
class SlideRoomExportResource {
  /**
   * @var SlideRoomClient
   */
  private $client;

  /**
   * @param SlideRoomClient $client
   */
  public function __construct(SlideRoomClient $client) {
    $this->client = $client;
  }

  /**
   * Gets the status/result of a requested export.
   *
   * @param string $token
   *
   * @throws SlideRoomApiErrorException
   * @return array
   */
  public function get($token) {
    $url = "/api/v2/export/$token";
    return $this->client->executeRequest("GET", $url);
  }
}

/**
 * Class SlideRoomApiErrorException
 */
class SlideRoomApiErrorException extends Exception {

}
