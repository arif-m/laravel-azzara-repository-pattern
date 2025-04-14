@extends('layouts.dashboard')

@section('styles')
@endsection

@section('page-header')
<div class="page-header">
    <h4 class="page-title">{{ $page_title }}</h4>
</div>
@endsection

@section('content')
<div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <h4 class="card-title">{{ $page_title }} Information</h4>
                        <div class="card-tools">
                            <button class="btn btn-icon btn-link btn-primary btn-xs"><span class="fa fa-times"></span></button>
                        </div>
                    </div>
                    <p class="card-category">
                    Update Data</p>
                </div>
                <div class="card-body">
                    <div class="row">   
						<form class="form-horizontal" role="form" name="myForm" id="myForm" autocomplete="off" action="" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group row">
								<label class="col-lg-3 control-label">First name:</label>
								<div class="col-lg-9">
									<input class="form-control" disabled id="full_name" name="full_name" value="{{ Auth::getUser()->name }}">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label">Email:</label>
								<div class="col-lg-9">
									<input class="form-control" disabled id="email" name="email" value="{{ Auth::getUser()->email }}" type="text">
								</div>
							</div>        
							<div class="form-group row">
								<label class="col-lg-3 control-label">Register Date:</label>
								<div class="col-lg-9">
									<input class="form-control" disabled id="register_date" name="register_date" value="{{ Auth::getUser()->created_at }}" type="text">
								</div>
							</div>     
							<div class="form-group row">
								<div class="col-md-12">
									<button type="button" class="btn btn-primary" onClick="history.go(-1);return true;"><i class="fa fa-arrow-left"></i> Back</button>
									<a href="#EditImage" data-toggle="modal" class="btn btn-success"><i class="fa fa-edit"></i> Change Image </a>  
								</div>
							</div>
						</form>
						
						<div class="modal fade" id="EditImage" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title"> Change Image</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>                         
									<form role="form" name="myForm2" id="myForm2" action="{{ url('backend/change-image') }}" method="POST" enctype="multipart/form-data">
									@csrf
									<div class="modal-body">
										<div class="container">
											<div class="row">						  
												<div class="col-md-3">
														<div class="form-group row">
														<label for="path_picture">Photo </label>  
														<input type="file" class="form-control" id="uploadPhoto" name="uploadPhoto"  accept='image/*'  >
														<input type="hidden" name="file_path" id="file_path" value="{{ Auth::getUser()->file_path }}"><input type="hidden" class="form-control" name="file_name" id="file_name" value="{{ Auth::getUser()->file_name }}"><input type="hidden" name="file_name2" id="file_name2" value="{{ Auth::getUser()->file_name }}">
														</div>
												</div>      
											</div>   
										</div>
									</div>
									<div class="modal-footer">
										<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
										<button type="submit" class="btn btn-success">Save changes</button>
									</div>
									</form>
								</div>			
							</div>	
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')

<script type='text/javascript'>
	$(document).ready(function(){
		$("#uploadPhoto").on("change", function (e) {		
			var file = this.files[0];
			var form_data = new FormData();
			form_data.append("uploadPhoto", file);
			$.ajax({
				url			: "{{ url('upload/fileProfileUpload') }}",
				dataType	: 'POST',
				cache		: false,
				contentType	: false,
				processData	: false,
				data		: form_data,                         // Setting the data attribute of ajax with file_data
				type		: 'POST',
				headers		: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success: function (result) {
					var path = "images";
					$("#file_path").val(path);
					var file = jQuery.parseJSON(result.responseText);
					$("#file_name").val(file.files[0].fileName);
				},
				error: function (result) {
					if(result.status==200){
						var path = "images";
						$("#file_path").val(path);
						var file = jQuery.parseJSON(result.responseText);
						$("#file_name").val(file.files[0].fileName);
						return false;
					}
				}
			}) 
		});	
		
		$("#myForm2").submit(function() {	
			var post_data = $(this).serialize();  
			var form_action = $(this).attr("Action");  
			var form_method = $(this).attr("Method"); 

			$.ajax( {  
				type 		: form_method,  
				url 		: form_action, 
				cache 		: false,  
				data 		: post_data, 
				beforeSend	: function(){
					//$("#loading-box").show();	
				},					
				success : function(result) {  
					if(result.message=='Success'){
						alert('Process is Successful')
						document.location.href="{{ url('/backend/profile') }}";
					}
					else
					{
						alert('Process is Failed...');
					}
					//$("#loading-box").hide();
				}
			});  
			return false;  
		});
	});
</script>
@endsection
