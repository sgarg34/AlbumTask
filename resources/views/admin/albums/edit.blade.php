@inject('GetCommon', 'App\Traits\GetCommon')
@extends('admin.layouts.cmlayout')
@section('body')
<link rel="stylesheet" href="{{asset('dist/css/lightbox.min.css')}}">
<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Blog List</h1>
	</div>
	<div class="flash-message">
	@if(session()->has('status'))
	    @if(session()->get('status') == 'error')
		<div class="alert alert-danger  alert-dismissible">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			{{ session()->get('message') }}
		</div>
		@endif
	@endif
	</div>
	<!-- end .flash-message -->
	<div class="row mt-4">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body pt-2 pb-3 manageClinicSection">
					<h5 class="mt-3 mb-4">
						Update Album Detail
						<a href="{{route('album.list')}}" class="float-right"><i data-feather="x"></i></a>
					</h5>
					<form action="{{route('album.update')}}" method="post" class="user" id="update_blog_form" enctype="multipart/form-data">
					@csrf
						<input type="hidden" name="edit_record_id" value="{{$album->id}}">
						<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="form-group">
									<label>Title<span class="required">*</span>
									</label>
                                   <input type="text" name="title" id="title" value="{{old('title',$album->title)}}" class="form-control form-control-user" />
                                    @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
								</div>
							</div>
                        </div>
						
						
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="form-group">
									<label for="document-0" class="document-label">Album Cover</label>
									<input type="file" name="cover_photo" id="cover_photo" placeholder="Cover Photo" value="{{old('cover_photo',$album->cover_photo)}}"  class="form-control form-control-user"/>
									<input type="hidden" name="cover_photo_old"value="{{ $album->cover_photo}}" />
									@if ($errors->has('cover_photo'))
										<span class="text-danger">{{ $errors->first('cover_photo') }}</span>
									@endif
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 category-img">
								<div class="form-group mt-4 pt-2">
								@php
									   
										$type = explode(".",$album->album_cover)[1];
										
										$image = $GetCommon->createThumbnail(public_path('assets/album/images/'.$album->album_cover), $type, 175, 75);
										
									@endphp
										@if($image)

										<a class="example-image-link" href="{{url('assets/album/images/'.$album->album_cover)}}" data-lightbox="example-1"><img class="example-image" style="padding-right:10px; padding-bottom:10px" src="{{ 'data:image/' .$type. ';base64,' .base64_encode($image) }}" width="100px" alt="Blog Image"></a>

										@endif
								</div>
							</div>
                        </div>
						<div class="mt-1 mb-1">
							<div class="text-left d-print-none mt-4">
								<button type="submit" id="edit-genre-btn"  class="btn btn-primary">Update</button>
								<a href="{{route('album.list')}}" class="btn btn-light">Cancel</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- end row -->
	</div>
	</div>
	<!-- container-fluid -->
	@endsection
	@section('scripts')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
	<script src="https://cdn.tiny.cloud/1/g2adjiwgk9zbu2xzir736ppgxzuciishwhkpnplf46rni4g8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
	jQuery( document ).ready(function() {
		tinymce.init({
			selector: 'textarea.editor',
			plugins: 'code',
			toolbar: 'code',
			content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
		});

		jQuery("form[id='update_blog_form']").validate({
				// Specify validation rules
				ignore: '',
				rules: {
					title: {
						required: true,
					},
					content: {
						required: true,
					},
					cover_photo:{
						extension: "jpg|jpeg|png"
					}
				},
				// Specify validation error messages
				messages: {
					title: {
						required: 'Title field is required',
					},
					content: {
						required: 'Content field is required',
					},
					cover_photo: {
						extension: 'Choose the image jpg,jpeg or png format Only',
					}
				},
				submitHandler: function(form) {
					form.submit();
				}
			});
		});
		jQuery("form button[type=submit]").click(function(e) {
				tinymce.triggerSave();
		  	});
		jQuery('.datetimepicker').datetimepicker({
			minDate : 0,
			// mask:true
		});

		jQuery("input[name='scheduleOn']").click(function() {
        var publishVal = jQuery(this).val();
			if(publishVal == '2'){
 				jQuery("#displayDiv").show();
			}else{
				jQuery("#displayDiv").hide();
			}
    	});
    </script>
	@stop