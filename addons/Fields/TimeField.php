<?php
  namespace Addons\Fields;

  use Illuminate\View\Factory;
  use Themosis\Field\Fields\FieldBuilder;
  use Themosis\Field\Fields\IField;

  class TimeField extends FieldBuilder implements IField
  {
      /**
       * Define a core TextField.
       *
       * @param array $properties The text field properties.
       * @param ViewFactory $view
       */
      public function __construct(array $properties, Factory $view)
      {
          parent::__construct($properties, $view);
          $this->fieldType();
      }

      /**
       * Method to override to define the input type
       * that handles the value.
       *
       * @return void
       */
      protected function fieldType()
      {
          $this->type = 'hour';
      }

      /**
       * Handle the field HTML code for metabox output.
       *
       * @return string
       */
      public function metabox()
      {
        return $this->view->make('fields.timeField', ['field' => $this])->render();
      }

      /**
       * Handle the field HTML code for the Settings API output.
       *
       * @return string
       */
      public function page()
      {
          return $this->metabox();
      }

      /**
       * Handle the field HTML code for the user fields output.
       *
       * @return string
       */
      public function user()
      {
          return $this->metabox();
      }

       /**
       * Handle the field HTML code for the taxonomy output.
       *
       * @return string
       */
      public function taxonomy()
      {
          return $this->metabox();
      }
  }

?>

