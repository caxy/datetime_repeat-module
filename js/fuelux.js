
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
    Drupal.behaviors.dateRepeatFueluxInput = {
        attach: function (context) {
            var $context = $(context);
            $context.find('.ui-scheduler').each(function () {
                $(this).scheduler();
            });
        }
    };

})(jQuery);
