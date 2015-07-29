<?php

/**
 * Class SlideRoomClient
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
  private $oauthToken;

  /**
   * @var string
   */
  private $apiUrl;

  /**
   * @param string $oauthToken
   * @param string $apiUrl
   */
  public function __construct($oauthToken, $apiUrl = NULL) {
    $this->oauthToken = $oauthToken;
    $this->apiUrl = $apiUrl ? $apiUrl : self::DEFAULT_API_URL;

    $this->application = new SlideRoomApplicationResource($this);
    $this->export = new SlideRoomExportResource($this);
  }

  /**
   * @param string $method
   * @param string $url
   * @param array $queryParameters
   * @param array $bodyParams
   */
  public function executeRequest($method, $url, $queryParameters = array(), $bodyParams = array()) {

  }
}

/**
 * Class SlideRoomApplicationResource
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
   * @param string $applicationId
   * @param array $params
   */
  public function requestExportByApplicationId($applicationId, $params = array()) {

  }

  /**
   * @param array $params
   */
  public function requestExport($params = array()) {

  }
}

/**
 * Class SlideRoomExportResource
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
   * @param string $token
   */
  public function get($token) {

  }
}

class SlideRoomApiErrorException extends Exception {

}