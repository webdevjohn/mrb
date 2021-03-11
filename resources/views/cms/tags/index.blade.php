@extends('cms-layout')
@section('title', 'Tags')

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li>&gt;</li>
	<li class="active-breadcrum">{{ $page }}</li>
@stop

@section('content')

	<section class="table-con">
		
		<a href="{{ route('cms.tags.create') }}" class="btn btn-new-record float-right" title="New Record">New Record +</a>
		
		<h1 class="section-header">Tags</h1>

		<table>
			<thead>
				<tr>
					<th class="table-col-tags-tag">Tag</th>				
					<th>Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="4"><a href="{{ route('cms.tags.create') }}">Create a New Tag</a></td>
				</tr>
			</tfoot>
			<tbody>
				@foreach($tags as $tag)
				<tr>
					<td>{{ $tag->tag }}</td>				
					<td>
						<ul class="frm-crud-buttons">
							<li>
								<a href="{{ route('cms.tags.edit', $tag->id) }}" class="btn btn-edit-record" title="Edit Record">Edit</a>
							</li>
						</ul>
					</td>
				</tr>	
				@endforeach
			</tbody>
		</table>
	</section>
	{!! $tags->appends(request()->input())->render() !!}	
@stop