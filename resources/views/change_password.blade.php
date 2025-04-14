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
						<form class="form-horizontal" role="form" name="myForm" id="myForm" autocomplete="off" action="{{ url('change-password') }}" method="POST" >
							@csrf
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group row">
								<label class="col-lg-4 control-label">New Password :</label>
								<div class="col-lg-8">
									<input class="form-control" type="password" id="password" name="password" value="" autocomplete="off" >
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-4 control-label">Confirm Password :</label>
								<div class="col-lg-8">
									<input class="form-control" type="password" id="password_confirmation" name="password_confirmation" value="" autocomplete="off" >
								</div>
							</div>        				  
							<div class="form-group row">
								<div class="col-md-12">
									<button type="button" class="btn btn-primary" onClick="history.go(-1);return true;"><i class="fa fa-arrow-left"></i> Back</button>
									<button type="submit" class="btn btn-success"><i class="fa fa-edit"></i>&nbsp;Change Data</button>
								</div>
							</div>
						</form>						
						
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
			$.ajax({  
				type 	:form_method,  
				url 	:form_action,  
				cache 	:false,  
				data 	:post_data, 
				beforeSend: function(){
					//$("#loading-box").show();	
				},					
				success : function(result) {  
					if(result.message=='Success'){
						alert('Process Update is Complete...');
						document.location.href="{{ url('/dashboard') }}";
					}
					else
					{
						var msg = jQuery.parseJSON(result.responseText);
						alert(msg.message);
					}
				},
				error : function(result){
					var msg = jQuery.parseJSON(result.responseText);
					alert(msg.message);
				}  				
			});
			return false;  
		});
	});
</script>
@endsection
