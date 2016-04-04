<?php

/**
 * @file
 * Contains \Drupal\datetime_repeat\Plugin\Field\FieldFormatter\DateRruleFieldFormatter.
 */

namespace Drupal\datetime_repeat\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Entity\Plugin\DataType\EntityAdapter;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\datetime\Plugin\Field\FieldFormatter\DateTimeCustomFormatter;
use Drupal\node\Entity\Node;
use Drupal\system\Plugin\migrate\process\d6\TimeZone;
use Recurr\Recurrence;

/**
 * Plugin implementation of the 'date_rrule_field_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "date_rrule_field_formatter",
 *   label = @Translation("Date rrule field formatter"),
 *   field_types = {
 *     "string", "string_long"
 *   }
 * )
 */
class DateRruleFieldFormatter extends FormatterBase {
  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      // Implement default settings.
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    return array(
      // Implement settings form.
    ) + parent::settingsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    // Implement settings summary.

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode)
  {
    $elements = [];
    foreach ($items as $delta => $item) {
      $elements[$delta] = ['#markup' => $this->viewValue($item)];
    }

    return $elements;
  }

  /**
   * Generate the output appropriate for one field item.
   *
   * @param \Drupal\Core\Field\FieldItemInterface $item
   *   One field item.
   *
   * @return string
   *   The textual output generated.
   */
  protected function viewValue(FieldItemInterface $item) {

    /** @var Node $entity */
    $entity = $item->getParent()->getParent()->getValue();
    $startDate = $entity->get('field_date_start');
    $startDate = \DateTime::createFromFormat("Y-m-d\TH:i:s", $startDate->get(0)->getValue()['value']);

    $endDate = $entity->get('field_date_end');
    if (!$endDate->isEmpty()) {
      $endDate = \DateTime::createFromFormat("Y-m-d\TH:i:s", $endDate->get(0)->getValue()['value']);
    }

    $values = $item->getValue();
    $rule = substr($values['value'], strlen('RRULE:'), strlen($values['value']));

    $rule        = new \Recurr\Rule($rule, $startDate);
    $arrayTransformer = new \Recurr\Transformer\ArrayTransformer();
    $array = $arrayTransformer->transform($rule)->map(function (Recurrence $recurrence) {
      return $recurrence->getStart()->format('c') .' - '. $recurrence->getEnd()->format('c');
    });

    return implode(PHP_EOL, $array->getValues());
  }

}
