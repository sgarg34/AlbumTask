@inject('GetCommon', 'App\Traits\GetCommon')
@extends('admin.layouts.cmlayout')

@section('body')
<link rel="stylesheet" href="{{asset('dist/css/lightbox.min.css')}}">
<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Albums List</h1>
	</div>
	<div class="flash-message">
		@if(session()->has('status'))
			@if(session()->get('status') == 'success')
				<div class="alert alert-success  alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session()->get('message') }}
				</div>
			@endif
		@endif
	</div> <!-- end .flash-message -->
	<div class="row">
        <div class="col-xl-12 col-md-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<form class="form-inline float-left" id="search-form">
						<div class="form-group">
							<input type="text" class="form-control" data-model="User" value="{{$keyword}}" id="search_keyword" name="search_keyword" placeholder="What are you looking for?">
						</div>
						<button type="submit" class="btn btn-primary ml-10">Search</button>
					</form>
					<div class="buttons-right">
						<a class="m-0 font-weight-bold btn-department-add pull-right hover-white" href="{{route('album.create')}}">Add Create <i class="fa fa-plus"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
					<table class="table table-hover dt-responsive nowrap">
						<thead>
							<tr>
								<th>S.No</th>
								<th>@sortablelink('title', 'Title')</th>
								<th>@sortablelink('album_cover', 'Album Cover')</th>
								<th>@sortablelink('created_at', 'Created Date')</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@php $i = 1 @endphp
						@foreach($data as $key => $row)
							<tr>

								<td>{{$i++}}</td>
								<td>{{$row->title ? $row->title : 'N/A' }}</td>
								<td>
								    @php
									   
										$type = explode(".",$row->album_cover)[1];
										
										$image = $GetCommon->createThumbnail(public_path('assets/album/images/'.$row->album_cover), $type, 175, 75);
										
									@endphp
										@if($image)

										<a class="example-image-link" href="{{url('assets/album/images/'.$row->album_cover)}}" data-lightbox="example-1"><img class="example-image" style="padding-right:10px; padding-bottom:10px" src="{{ 'data:image/' .$type. ';base64,' .base64_encode($image) }}" width="100px" alt="Blog Image">

										@endif
								</td>
								<td>{{$row->created_at ? $row->created_at : 'N/A'}}</td>
								<td><a class="anchorLess">
										<a title="Click to Edit" href="{{route('album.edit',[$row->id])}}" class="anchorLess"><i class="fas fa-edit info" aria-hidden="true" ></i></a>
										<a title="Click to Delete" href="{{route('album.delete',[$row->id])}}" class="anchorLess delete-confirm"><i class="fas fa-trash danger" aria-hidden="true" ></i></a>
								</td>
							</tr>
						@endforeach
							@if ($data->count() == 0)
								<tr>
									<td colspan="10" class="text-center text-danger">No Album to display.</td>
								</tr>
								@endif
						</tbody>
					</table>
					{{ $data->appends(request()->except('page'))->links() }}
						<p>
							Displaying {{$data->count()}} of {{ $data->total() }} Album(s).
						</p>
					</div>
				</div>
			</div>
        </div>
	</div>
</div>
<style>
.no-margin{margin:0px;}
</style>
<!-- /.container-fluid -->
@endsection
