<?php
namespace Drupal\demo_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
Use Drupal\Core\Config\ConfigFactory;
use GuzzleHttp\Client;
/**
 * Provides a 'Weather Information' block.
 *
 * @Block(
 *  id = "weather_info",
 *  admin_label = @Translation("Weather Information"),
 * )
 */

Class WeatherBlock extends BlockBase implements ContainerFactoryPluginInterface {
    protected $weatherConfig;
    protected $client;
    public function __construct(array $configuration, $plugin_id, $plugin_definition, ConfigFactory $configFactory, $client) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);
        $this->weatherConfig = $configFactory->get('demo_module.weather');
        $this->client = $client;
      }
      /**
       * {@inheritdoc}
       */
      public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
        return new static(
          $configuration,
          $plugin_id,
          $plugin_definition,
          $container->get('config.factory'),
          $container->get('http_client')
        );
      }

    public function build() {
        //https://samples.openweathermap.org/data/2.5/weather?q=Bangalore&appid=b6907d289e10d714a6e88b30761fae22
        //var_dump($this->weatherConfig); return;
       // $response = $this->client->request('GET', 'http://jsonplaceholder.typicode.com/posts/1');
       // $markup = $response->getBody(); # '{"id": 1420053, "name": "guzzle", ...}'   
       // $markup = json_decode($markup); 
        /*$app_id = $this->weatherConfig->get('api_key');        
        return [
          '#markup' => $app_id,
        ];*/
        $build['data'] = [
            '#theme' => 'demo_module_weather_data',
            '#city' => 'Bangalore',
            '#temp' => '12.7',
            '#attached' => [
                'library' => [
                  'demo_module/weather-block',
                ],
              ],

        ];
        
        
        return $build; 
    }
}