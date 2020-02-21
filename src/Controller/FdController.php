<?php

namespace Drupal\fd_blog\Controller;

use Drupal\Core\Controller\ControllerBase;
use GuzzleHttp\Client;

/**
 * Controller routines for blog routes.
 */
class FdController extends ControllerBase
{

  public function getList()
  {
    $config = \Drupal::config('fd_blog.api');
    $fd_url = $config->get('fd_url');
//    var_dump($fd_url);
    $api = new Client();
//    $items = $api->request('GET', 'https://jsonplaceholder.typicode.com/posts');
    $items = $api->request('GET', $fd_url . '/posts');
    $items = json_decode($items->getBody(), true);
    return array(
      '#theme' => 'fd_blog',
      '#items' => $items,
      '#title' => 'fd blog'
    );

  }

  public function getDetail($post_id)
  {
    $config = \Drupal::config('fd_blog.api');
    $fd_url = $config->get('fd_url');
    $api = new Client();
//    $item = $api->request('GET', 'https://jsonplaceholder.typicode.com/posts/'. $post_id);
    $item = $api->request('GET', $fd_url . '/posts/' .$post_id);
    $item = json_decode($item->getBody(), true);

    return array(
      '#theme' => 'fd_blog_post',
      '#items' => $item,
      '#title' => 'fd blog posts' . ' ' . $item['title'] . '-'. $post_id

    );
  }

}

