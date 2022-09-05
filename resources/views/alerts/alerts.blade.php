@if (Session::has('success'))
<div class="alert callout callout-success alert-dismissible shadow">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <b>{{ Session::get('success') }}</b>
</div>
@endif
@if (Session::has('error'))
<div class="alert callout callout-danger alert-dismissible shadow">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <b>{{ Session::get('error') }}</b>
</div>
@endif
@if(count($errors) > 0)
<div class="alert callout callout-danger alert-dismissible shadow">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
			aria-hidden="true">×</span></button>
	<ul class="text-left {{ count($errors) == 1 ? 'list-unstyled' : '' }}">
		@foreach($errors->all() as $error)
		<li>
            <b>{{$error}}</b>
        </li>
		@endforeach
	</ul>
</div>
@endif
