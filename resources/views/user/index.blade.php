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
                            <!--<button class="btn btn-icon btn-link btn-primary btn-xs"><span class="fa fa-angle-down"></span></button>
                            <button class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card"><span class="fa fa-sync-alt"></span></button>-->
                            <button class="btn btn-icon btn-link btn-primary btn-xs"><span class="fa fa-times"></span></button>
                        </div>
                    </div>
                    <p class="card-category">
                    Create, Update, Delete and Listing of Data</p>
                </div>
                <div class="card-body">
					@if(Session::has('flash_message'))
						<div class='alert alert-success'>
							{{ Session::get('flash_message') }}
						</div>
					@endif		
					<?php Session::forget('flash_message') ?>
                    <div class="row">                        
                        <div class="col-md-12">
							<a href="{{ url('backend/user/create') }}" class = 'btn btn-success btn-sm'><i class='fa fa-file-o'></i>&nbsp; Add </a>
							<br /><br />
							<table id='example' class="table table-striped table-hover table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
								<thead>
									<th>ID</th>
									<th>User Name</th>				
									<th>Email</th>
									<th style='text-align:center;'>Action</th>
								</thead>
								
								<tbody>
								</tbody>
								
							</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')
<script type='text/javascript'>
	setTimeout(function() {
		$('.alert-success').remove();
	}, 3000); 

	var url_delete = "{{ url('backend/user') }}";
	var oTable = $("#example").DataTable({
		serverSide: true,
		processing: true,
		aoColumnDefs: [
				{ 'bSortable': false, 'aTargets': [ 3 ]},
				{ 'bSearchable': true }
			],
		bPaginate: true,
		ajax: '{{ url("datatables/dataUser") }}',
		columns: [
			{ data: 'id', name: 'id' },
			{ data: 'name', name: 'name' },			
			{ data: 'email', name: 'email' },
			{ data: null, class: 'text-center', render: 
				function(data, type, full ){
					var url_edit = "{{ url('backend/user') }}/" + data.id + '/edit';
					var url_reset = "{{ url('backend/user') }}/" + data.id ;
                    var btn = '<a href='+url_edit+' class ="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit </a>&nbsp;'
                    + '<button class="btn btn-danger btn-sm" type="button" value="'+data.id+'" id="btnDelete'+data.id+'" onClick="deleteData( '+data.id+', url_delete)" >'
                    + '<i class="fa fa-trash-o"></i>&nbsp;Delete</button>&nbsp;'
					+ '<a href='+url_reset+' class ="btn btn-primary btn-sm"><i class="fa fa-refresh"></i>&nbsp;Reset Password </a>&nbsp;';
                    return btn;
				}
            }
		],
		order: [
			[0, "asc"]
		] // set first column as a default sort by asc 
	}); 
	
	function deleteData(id, url){	
		if (confirm("Are you sure delete this data ?"))
		{
			var sURL = url + "/" + id;
			$.ajax({
				type		: "POST",
				url			: sURL,  
				data		: { "_method":"delete", "_token":"{{ csrf_token() }}" },
				success: function(result) {
					console.log(result)
					alert('Successfully Deleted...');
					oTable.ajax.reload();			
				},
				error : function(result){
					console.log(result)
					var msg = jQuery.parseJSON(result.responseText);
					alert(msg.errors.message);
				}									
			});			
		}	
	}	
</script>
@endsection
