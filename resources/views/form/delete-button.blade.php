{{ Form::open(['class' => 'delete-it', 'route' => $route, 'method' => 'delete']) }}
<button @if(isset($class)) class="{{ $class }}" @endif type="submit">Delete</button>
{{ Form::close() }}