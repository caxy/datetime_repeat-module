
/**
 * @file
 * Attaches comment behaviors to the entity form.
 */

(function ($) {

    'use strict';

    /**
     *
     * @type {Drupal~behavior}
     */
    Drupal.behaviors.dateRepeatRecurrenceInput = {
        attach: function (context) {
            var $context = $(context);
            $context.find('.ui-scheduler').each(function () {
                $('.field--widget-date-rrule-field-widget input').recurrenceinput();
            });
        }
    };

})(jQuery);
