<?php

namespace Drupal\fd_blog\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class FdForm.
 */
class FdForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'fd_blog.api',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'fd_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('fd_blog.api');
    $form['fd_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('URL'),
      '#description' => $this->t('Please copy and paste here you URL'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('fd_url'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('fd_blog.api')
      ->set('fd_url', $form_state->getValue('fd_url'))
      ->save();
  }

}
