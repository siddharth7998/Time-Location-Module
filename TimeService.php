<?php


namespace Drupal\time_location\Services;

use Drupal\Core\Config\ConfigFactory;

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
   * load the timezone variable.
   */
  public function getTime() {
    $config = $this->config_factory->get('time_location.settings');
    $time_zone = $config->get('time_zone');
    return $time_zone;
  }
}