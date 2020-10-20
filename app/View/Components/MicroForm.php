<?php

namespace App\View\Components;

use App\Http\Controllers\SFElementController;
use App\Http\Controllers\SFSessionController;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\Component;

class MicroForm extends Component {

    public $api_status;
    public $field_data;
    public $label;

    /**
     * Create a new component instance.
     *
     * @param string $label
     * @param array $query
     */
    public function __construct($label = '', $query = '') {

        $this -> label = $label;
        $query_fields = explode(" ", $query);

        $session_controller = new SFSessionController();
        $element_controller = new SFElementController();

        $session = $session_controller -> current();
        $raw_data = $element_controller -> describe_element($session, 'ServiceContracts');

        $this -> api_status = $raw_data['success'];

        if ($this -> api_status) {
            $raw_fields = $raw_data['result']['fields'];
            $field_queue = array();
            $queue_size = sizeof($query_fields);
            $timer = 0;

            foreach ($raw_fields as $field) {
                if ($timer == $queue_size) {
                    continue;
                }
                foreach($query_fields as $query_element) {
                    if ($field['name'] == $query_element) {
                        $timer += 1;
                        array_push($field_queue, $field);
                        continue;
                    }
                }
            }

            $blade_fields = array();

            foreach($field_queue as $field) {
                array_push($blade_fields, self::constructType($field));
            }

            $this -> field_data = $blade_fields;

            $rendered_fields = '';
            foreach($blade_fields as $field) {
                $rendered_fields .= self::renderField($field);
            }

            $this -> field_data = $rendered_fields;

        }

    }

    private static function getType($var) {
        return $var['type']['name'];
    }

    private static function rewritePicklist($var) {
        $raw_options = $var['type']['picklistValues'];
        $options = array();
        foreach($raw_options as $raw) {
            array_push($options, [
                'option' => $raw['label'],
                'value' => $raw['value']
            ]);
        }
        return $options;
    }

    private static function constructType($var) {
        $type = self::getType($var);

        switch ($type) {

            case 'string':
                return [
                    'type' => 'text',
                    'name' => $var['name'],
                    'label' => $var['label'],
                    'editable' => $var['editable'],
                    'mandatory' => $var['mandatory'],
                    'value' => $var['default']
                ];

            case 'date':
                return [
                    'type' => 'date',
                    'name' => $var['name'],
                    'label' => $var['label'],
                    'editable' => $var['editable'],
                    'mandatory' => $var['mandatory'],
                    'value' => $var['default']
                ];

            case 'double':case 'integer':
                return [
                    'type' => 'number',
                    'name' => $var['name'],
                    'label' => $var['label'],
                    'editable' => $var['editable'],
                    'mandatory' => $var['mandatory'],
                    'value' => $var['default']
                ];

            case 'picklist':
                return [
                    'type' => 'select',
                    'name' => $var['name'],
                    'label' => $var['label'],
                    'editable' => $var['editable'],
                    'mandatory' => $var['mandatory'],
                    'options' => self::rewritePicklist($var),
                    'value' => $var['default']
                ];

            case 'multipicklist':
                return [
                    'type' => 'multiselect',
                    'name' => $var['name'],
                    'label' => $var['label'],
                    'editable' => $var['editable'],
                    'mandatory' => $var['mandatory'],
                    'options' => self::rewritePicklist($var),
                    'value' => $var['default']
                ];

            default:
                return [
                    'type' => 'undefined',
                ];

        }
    }

    private static function renderOptions($field) {
        $base = '';
        foreach($field['options'] as $option) {
            $base .= strtr('<option value="$val">$lab</option>', [
                '$val' => $option['value'],
                '$lab' => $option['option']
            ]);
        }
        return $base;
    }

    private static function fitMandatory($field) {
        return $field['mandatory'] == true ? 'required' : '';
    }

    private static function renderField($field) {

        $df = $field['value'];
        $nm = $field['name'];
        $lab = $field['label'];
        $mn = self::fitMandatory($field);

        switch ($field['type']) {

            case 'select':
                $optval = self::renderOptions($field);
                return '<div class="form-group row"><label class="col-sm-6 col-form-label text-right" for="'.$nm.'">'.$lab.'</label><div class="col-sm-6"><select class="selectpicker show-tick form-control" data-live-search="true" id="'.$nm.'" value="'.$df.'" '.$mn.'>'.$optval.'</select></div>'.'</div>';

            case 'multiselect':
                $optval = self::renderOptions($field);
                return '<div class="form-group row"><label class="col-sm-6 col-form-label text-right" for="'.$nm.'">'.$lab.'</label><div class="col-sm-6"><select class="selectpicker form-control" data-live-search="true" multiple id="'.$nm.'" value="'.$df.'" '.$mn.'>'.$optval.'</select></div>'.'</div>';

            case 'text':
                return '<div class="form-group row"><label class="col-sm-6 col-form-label text-right" for="'.$nm.'">'.$lab.'</label><div class="col-sm-6"><input type="text" class="form-control" id="'.$nm.'" value="'.$df.'" '.$mn.'></div>'.'</div>';

            case 'number':
                return '<div class="form-group row"><label class="col-sm-6 col-form-label text-right" for="'.$nm.'">'.$lab.'</label><div class="col-sm-6"><input type="number" class="form-control" id="'.$nm.'" value="'.$df.'" '.$mn.'></div>'.'</div>';

            case 'date':
                return '<div class="form-group row"><label class="col-sm-6 col-form-label text-right" for="'.$nm.'">'.$lab.'</label><div class="col-sm-6"><input type="date" class="form-control" id="'.$nm.'" value="'.$df.'" '.$mn.'></div>'.'</div>';

            default:
                return '';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render() {
        return view('components.micro-form');
    }

}
