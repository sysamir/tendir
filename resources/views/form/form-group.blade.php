<?php
$type = (isset($type) ? $type : 'text');
switch ($type)
{
    case 'text':
        $field = Form::text($key, ! array_key_exists('notOld', $options) ? (old($key) ? : (isset($item->{$key}) ? $item->{$key} : (array_key_exists('value', $options) ? $options['value'] : null))) : null, $options);
        break;
    case 'textarea':
        $field = Form::textarea($key, ! array_key_exists('notOld', $options) ? (old($key) ? : (isset($item->{$key}) ? $item->{$key} : (array_key_exists('value', $options) ? $options['value'] : null))) : null, $options);
        break;
    case 'editor':
        $field = file_get_contents(resource_path('views/form/editor.blade.php'));
        break;
    case 'password':
        $field = Form::password($key, $options);
        break;
    case 'select':
        $field = Form::select($key, $selects, ! array_key_exists('notOld', $options) ? (old($key) ? : (isset($item) ? (array_key_exists('relation', $options) ? $item->{$key}->{$options['relation']} : (isset($item->{$key}) ? $item->{$key} : null)) : null)) : null, $options);
        break;
    case 'radio':
        $field = '<br/>';

        foreach ($values as $value => $title):
            $field .= '&nbsp' . $title . '&nbsp:&nbsp' . Form::radio($key, $value, (old($key) AND old($key) == $value) ? true : (isset($item->{$key}) and $item->{$key} == $value ? true : false), ['class' => 'flast', 'id' => $key . '_'. $value]);
        endforeach;

        break;

    case 'checkbox':
        $field = '<br/>';
        $field .= Form::checkbox($key, $value, (old($key) AND old($key) == $value) ? true : (isset($item->{$key}) and $item->{$key} == $value ? true : false), ['class' => 'flatd', 'id' => $key]) . '&nbsp&nbsp' . $title;
        break;

    case 'numeric':
        $field = '<button data-type="-" class="btn btn-round btn-warning btn-sm"><i class="fa fa-minus"></i></button>';
        $field .= Form::text($key, ! array_key_exists('notOld', $options) ? (old($key) ? : (isset($item->{$key}) ? $item->{$key} : (array_key_exists('value', $options) ? $options['value'] : null))) : null, $options);
        $field .= '<button data-type="+" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus"></i></button>
                    <a style="position: relative;left: 10px;top: 5px;" data-toggle="tooltip" data-placement="top" title="' . $label . '">
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                    </a>';
        break;
}
?>
<div class="form-group {{ $errors->has($key) ? ' has-error' : '' }} ">
    @if(isset($label))
        {{ Form::label($key, $label) }}
    @endif
    {!! $field !!}
    @if ($errors->has($key))
        <span class="help-block">
            <strong>{!! $errors->first($key) !!}</strong>
        </span>
    @endif
</div>