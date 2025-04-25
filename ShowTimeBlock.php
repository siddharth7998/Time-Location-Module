<?php

namespace Drupal\time_location\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\time_location\Services\TimeService;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'Show Time Block' Block.
 *
 * @Block(
 *   id = "show_time_block",
 *   admin_label = @Translation("Show Time Block"),
 *   category = @Translation("Show Time Block"),
 * )
 */
class ShowTimeBlock extends BlockBase implements ContainerFactoryPluginInterface{

  protected $configFactory;
  protected $timeService;

  public function __construct(array $configuration, $plugin_id, 
    $plugin_definition, ConfigFactoryInterface $config_factory, 
    TimeService $time_service) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->configFactory = $config_factory;
    $this->timeService = $time_service;
}


  public static function create(ContainerInterface $container, 
    array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('config.factory'),
      $container->get('time_location.time_service')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->configFactory->get('time_location.settings');
    $country = $config->get('country');
    $city = $config->get('city');
    $timezone = $this->timeService->getTime();

    return [
      '#theme' => 'time-template',
      '#country' => $country,
      '#city' => $city,
      '#attached' => [
        'library' => [
          'time_location/time_update',
        ],
        
        'drupalSettings' => [
          'site_location_time' => [
            'timezone' => $timezone,
          ],
        ],
      ],
      '#cache' => [
        'tags' => [
          'config:time_location.settings',
        ],
      ],
    ];
  }

}
