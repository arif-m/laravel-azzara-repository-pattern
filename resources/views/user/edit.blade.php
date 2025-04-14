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
						@if(Session::has('flash_message'))
							<div class='alert alert-success'>
								{{ Session::get('flash_message') }}
							</div>
						@endif		
						<?php Session::forget('flash_message') ?>  
						<div class="col-md-12">                   
							<form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data" id="myForm">
								@method('PUT')							
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="form-group">
									<label class="col-md-4 control-label">Name</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="name" value="{{ $user->name }}">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-4 control-label">E-Mail Address</label>
									<div class="col-md-6">
										<input type="email" class="form-control" name="email" value="{{ $user->email }}">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-4 control-label">Group</label>
									<div class="col-md-6">
										<select id="select-group" name="group" class="form-control">
											<option value="">-- Select Group --</option>
											@foreach($group as $key=>$value)
												<option value="{{ $key }}" <?php if ($user->level == $key) echo 'selected'; ?>>
												{{ $value }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-4 control-label"for="published">Published</label>
									<div class="col-md-6">
										<input type='checkbox' id='published' name='published' <?php if ($user->published==1){ echo 'Checked' ;} ?> value="{{ $user->published }}" onClick="check(this.form)" /> 
										<input type="hidden" class="form-control" id="published2" name="published2" value="<?php if ($user->published==1){ echo 'Checked' ;} ?>">
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" class="btn btn-success">Update Data</button>
										<button type="button" class="btn btn-default" onClick="history.go(-1);return true;">Cancel</button>
									</div>
								</div>
							</form>
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
		$("#myForm").submit(function() {			
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
						//alert('Process is Complete...');
						document.location.href="{{ url('/backend/user/') }}";
					}
					else
					{
						alert('Process is Failed...');
					}
					//$("#loading-box").hide();
				},
				error : function(result){
					var msg = jQuery.parseJSON(result.responseText);
					alert(msg.message);
				}
			});  
			return false;  
		});
	});
	
	function check(frm) {   
		frm.published2.value='Unchecked'
		if (frm.published.checked) {
			frm.published2.value='Checked'
		}
	}
</script>
@endsection
