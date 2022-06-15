<?php

namespace Drupal\time_location\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Show Time Block' Block.
 *
 * @Block(
 *   id = "show_time_block",
 *   admin_label = @Translation("Show Time Block"),
 *   category = @Translation("Show Time Block"),
 * )
 */
class ShowTimeBlock extends BlockBase {
    
  protected $loaddata;
  /**
   * Constructor.
   */
  public function __construct() {
    $this->loaddata = \Drupal::service('time_location.time_service');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $time = $this->loaddata->getTime();
    $country = $this->loaddata->getCountry();
    $city = $this->loaddata->getCity();
    $output = array(
      'time'  => $time,
      'city' => $city ,
      'country' => $country ,
    );
    return [
      '#theme' => 'time-template',
      '#data' => $output ,
      '#cache' => [
        'tags' => [
          'config:time_location.settings',
        ],
      ],
    ];
  }
  public function getCacheMaxAge () {
    \Drupal::service('page_cache_kill_switch')->trigger();
    return 0;
  }

}