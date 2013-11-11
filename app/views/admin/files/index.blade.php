@section('head')

	{{ HTML::script(asset('js/list.js')) }}

@stop


@section('buttons')

@stop


@section('header')

	<h1><span id="nb_elements">{{ $models->getTotal() }}</span> {{ trans_choice('global.modules.files', $models->getTotal()) }}</h1>

@stop


@section('main')

	<div class="list-form" lang="{{ Config::get('app.locale') }}">

		<div class="btn-toolbar"></div>

		{{ Former::vertical_open_for_files()->route('admin.files.upload')->class('thumbnail thumbnail-dropzone')->id('uploader') }}
			@foreach (Config::get('app.locales') as $locale)
				{{ Former::hidden($locale.'[alt_attribute]')->value(''); }}
			@endforeach
			@if($relatedModel)
			{{ Former::hidden('fileable_id')->value($relatedModel->id); }}
			{{ Former::hidden('fileable_type')->value(get_class($relatedModel)); }}
			@endif
			<div class="dz-message">{{ trans('global.Drop files to upload (or click)') }}</div>
			<div class="fallback">
			{{ Former::file('file')->accept('image')->max(2, 'MB')->class('fileInput'); }}
			{{ Former::actions()->primary_submit('Submit') }}
			</div>
		{{ Former::close() }}

		<div class="dropzone-previews"></div>

		<div class="sortable sortable-thumbnails">
		@foreach ($models as $key => $model)
			<div class="thumbnail @if($model->status == 1) online @else offline @endif" id="item_{{ $model->id }}">
				<input type="checkbox" value="{{ $model->id }}">
				<img src="{{ Croppa::url('/'.$model->path.'/'.$model->filename, 100, 100) }}" alt="{{ $model->alt_attribute }}">
				<div class="caption">
					<div>{{ $model->filename }}</div>
					<div>{{ $model->alt_attribute }}</div>
				</div>
			</div>
		@endforeach
		</div>

	</div>

	{{-- $models->links() --}}

@stop