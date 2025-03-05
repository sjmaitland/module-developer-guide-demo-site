<?php

declare(strict_types=1);

namespace Drupal\anytown\Controller;

use Drupal\anytown\ForecastClientInterface;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for anytown.weather_page rout.
 */
class WeatherPage extends ControllerBase {
  
  /**
   * Forecast API client.
   * 
   * @var Drupal\anytown\ForecastClientInterface
   */
  private $forecastClient;

  /**
   * WeatherPage controller constructor.
   * 
   * @param \Drupal\anytown\ForecastClientInterface $forecast_client
   *  Forecast API client service.
   */
  public function __construct(ForecastClientInterface $forecast_client) {
    $this->forecastClient = $forecast_client;
  }

  /**
   *  {@inheritDoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('anytown.forecast_client')
    );
  }

  /**
   * Builds the response.
   */
  public function build(string $style): array {
    // Style should be one of 'short', or 'extended'. 'Short' is the default.
    $style = (in_array($style, ['short', 'extended'])) ? $style : 'short';

    $url = 'https://module-developer-guide-demo-site.ddev.site/modules/custom/anytown/data/weather_forecast.json';
    $forecast_data = $this->forecastClient->getForecastData($url);
    if ($forecast_data) {
      $forecast = '<ul>';
      foreach ($forecast_data as $item) {
        [
          'weekday' => $weekday,
          'description' => $description,
          'high' => $high,
          'low' => $low,
        ] = $item;
        $forecast .= "<li>$weekday will be <em>$description</em> with a high of $high and a low of $low.</li>";
      }
      $forecast .= '</ul>';
    }
    else {
      $forecast = '<p>Could not get the weather forecast. Dress for anything.</p>';
    }

    $output = "<p>Check out this weekend's weather forecast and come prepared. The market is mostly outside, and takes place rain or shine.</p>";
    $output .= $forecast;
    $output .= '<h3>Weather related closures</h3><ul><li>Ice rink closed until winter - please stay off while we prepare it.</li><li>Parking behind Apple Lane is still closed from all the rain last week.</li></ul>';

    return [
      '#markup' => $output,
    ];
  }

}
