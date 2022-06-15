<?php


namespace Drupal\time_location\Services;

use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Datetime\DrupalDateTimeZone;

class TimeService {

  /**
   * Drupal\Core\Config\ConfigFactory definition.
   *
   * @var Drupal\Core\Config\ConfigFactory
   */
  protected $config_factory;
  /**
   * Constructor.
   */
  public function __construct(ConfigFactory $config_factory) {
    $this->config_factory = $config_factory;
  }
  
  /**
   * In this method we are using the Drupal config service to
   * load the variables.
   */
  public function getTime() {
    $config = $this->config_factory->get('time_location.settings');
    $time_zone = $config->get('time_zone');
    $time = new DrupalDateTime("now", $time_zone );
    $required_time_format = strftime($time->format('dS M Y - h:i A'));
    return $required_time_format;

  }
  public function getCountry() {
    $config = $this->config_factory->get('time_location.settings');
    $country = $config->get('country');
    return $country;

  }
  public function getCity() {
    $config = $this->config_factory->get('time_location.settings');
    $city = $config->get('city');
    return $city;
  }

}