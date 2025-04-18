<?php

namespace Drupal\Tests\anytown\Unit;

use Drupal\anytown\ForecastClient;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\Tests\UnitTestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use Psr\Log\LoggerInterface;

/**
 *  Unit tests for ForecastClient service.
 */
class ForecastClientTest extends UnitTestCase {

  /**
   *  Tests the kelvinToFahrenheit method.
   * 
   *  @covers \Drupal\anytown\ForecastClient::kelvinToFahrenheit()
   */
  public function testKelvinToFahrenheit() {
    // Example test cases.
    $testCases = [
      // Absolute zero.
      [
        'f' => -460,
        'k' => 0,
      ],
      // Freezing point of water.
      [
        'f' => 32,
        'k' => 273.15,
      ],
    ];

    foreach ($testCases as $case) {
      
    }
  }
}