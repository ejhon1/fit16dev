

<?php
App::uses('FormHelper', 'View/Helper');

/**
 * AppForm Helper
 *
 */
class AppFormHelper extends FormHelper {

    /**
     * Returns an HTML FORM element with disabled client side validation -> novalidate="novalidate".
     *
     * @param array $options An array of html attributes and options.
     * @return string An formatted opening FORM tag.
     */
    public function create($model = null, $options = array()) {
        // Disable client side validation
        $defaults = array('novalidate' => true);
        $options = array_merge($defaults, $options);

        return parent::create($model, $options);
    }
}

