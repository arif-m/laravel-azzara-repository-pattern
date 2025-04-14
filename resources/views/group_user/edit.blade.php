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
						<div class="col-md-12">                   
							<form action="{{ route('group-user.update', $group_user->id) }}" method="POST" enctype="multipart/form-data" id="myForm">
								@method('PUT')							
								<input type="hidden" name="_token" value="{{ csrf_token() }}">

								<div class="form-group">
									<label class="col-md-4 control-label">Group Name</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="group" value="{{ $group_user->group }}" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-4 control-label">Description</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="description" value="{{ $group_user->description }}">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-4 control-label"for="published">Published</label>
									<div class="col-md-6">
										<input type='checkbox' id='published' name='published' <?php if ($group_user->published==1){ echo 'Checked' ;} ?> value="{{ $group_user->published }}" onClick="check(this.form)" /> 
										<input type="hidden" class="form-control" id="published2" name="published2" value="<?php if ($group_user->published==1){ echo 'Checked' ;} ?>">
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
						console.log("update success");
						document.location.href="{{ url('/backend/group-user/') }}";
					}
					else
					{
						console.log("update failed");
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
