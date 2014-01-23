@section('head')

	{{ HTML::script(asset('js/list.js')) }}

@stop


@section('addButton')
	<a href="{{ route('admin.pages.create') }}" class=""><span class="glyphicon glyphicon glyphicon-plus-sign"></span><span class="sr-only">{{ ucfirst(trans('modules.pages.New')) }}</span></a>&nbsp;
@stop


@section('main')

	<div class="list-form" lang="{{ Config::get('app.locale') }}">

		@include('admin._toolbar')

		{{ $models->getList() }}

	</div>

@stop