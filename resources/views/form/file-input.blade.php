<div class="form-group {{ $errors->has($key) ? ' has-error' : '' }}">
    <div class="fileinput fileinput-new" data-provides="fileinput">
        <div class="fileinput-new thumbnail" style="width: 200px; height: auto">
            <img src="{{ (isset($item->{$key}) ? $item->{$key} : "https://placeholdit.imgix.net/~text?txtsize=45&txt=" . $label . "&w=300&h=300") }}">
        </div>
        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;"></div>
        <div>
        <span class="btn btn-default btn-file">
            <span class="fileinput-new">Choose {{ $label }} </span>
            <span class="fileinput-exists">Change</span>
            <input type="file" name="{{ $key }}">
        </span>
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Delete</a>
        </div>
    </div>
</div>