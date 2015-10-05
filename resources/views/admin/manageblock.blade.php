@extends('layout.master')

@section('htmlclass')
<html>
@stop

@section('title')
	Manage Block Details
@stop

@section('nav-desktop')
	<li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="{{ url('admin/manageowner') }}">Owners</a></li>
    <li><a href="{{ url('admin/manageapartment') }}">Apartments</a></li>
    <li class="active"><a href="{{ url('admin/manageblock') }}">Blocks</a></li>
    <li><a href="{{ url('admin/manageindi') }}">Individual Apartments</a></li>
    <li><a href="javascript:void(0)">Receipt</a></li>
@stop

@section('nav-mobile')
	<li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="{{ url('admin/manageowner') }}">Owners</a></li>
    <li><a href="{{ url('admin/manageapartment') }}">Apartments</a></li>
    <li class="active"><a href="{{ url('admin/manageblock') }}">Blocks</a></li>
    <li><a href="{{ url('admin/manageindi') }}">Individual Apartments</a></li>
    <li><a href="javascript:void(0)">Receipt</a></li>
@stop

@section('bodyclass')
	<body class="blue-grey lighten-5">
@stop

@section('body')
	<div class="divcenter center-align table-title" style="font-size:36px;margin-top:30px;font-weight:500;">List of Blocks</div>
	<div class="container apartmenttable-container divcenter">
		<table class="highlight responsive-table centered">
        <thead>
            <tr>
	            <th data-field="block_id">ID</th>
	            <th data-field="block_address">Address</th>
	            <th data-field="block_area">Area</th>
	            <th data-field="created_at">Created At</th>
	            <th data-field="updated_at">Updated At</th>
	            <th></th>
            </tr>
        </thead>

        <tbody>
        
        @foreach($blocks as $block)
            <tr>
            {!! Form::open(['url'=>'/admin/updateblock', 'id'=>"updateform$block->block_id"]) !!}
	            <td width="80">
	            	<span class="" id="id" data-aid="{{ $block->block_id }}">{{ $block->block_id }}</span>
	            </td>
	            <td width="*">
	            	<span class="data-label">{{ $block->block_address }}</span>
	            	{!! Form::text('address', $block->block_address , ['class'=>'hidden center-align']) !!}
	            </td>
	            <td width="80">
	            	<span class="data-label">{{ $block->block_area }}</span>
	            	{!! Form::text('area', $block->block_area , ['class'=>'hidden center-align']) !!}
	            </td>
	            <td width="180">{{ $block->created_at->format('M j, Y') }}</td>
	            <td width="180">{{ $block->updated_at->format('M j, Y') }}</td>
	            <td width="150" id="btn-options" class="">
	            	<!-- href='{{ url("updateblock/$block->block_id") }}' -->
	            	<a href='javascript:void(0)'  style="margin-top:10px;" class="waves-effect waves-teal grey-text text-darken-3 btn-flat edit-btn tooltipped" data-position="top" data-tooltip="Edit" name="{{ $block->block_id }}"><i class="material-icons left" >edit</i></a>

	            	<a href="javascript:void(0)" data-position="top"  data-tooltip="Delete" style="margin-top:10px;" class="waves-effect waves-teal grey-text text-darken-3 btn-flat deleteblock-btn tooltipped" data-aid="{{ $block->block_id }}"><i class="material-icons left" >delete</i></a>


	            	<!-- Fot editing -->
	            	<a href='javascript:void(0)'  style="margin-top:10px;" class="waves-effect waves-green green-text btn-flat update-btn hidden tooltipped" name="{{ $block->block_id }}" data-position="top" data-tooltip="Update"><i class="material-icons left">check</i></a>
	            	<a href='javascript:void(0)'  style="margin-top:10px;" class="waves-effect waves-red red-text btn-flat cancel-btn hidden tooltipped" name="{{ $block->block_id }}" data-position="top" data-tooltip="Cancel"><i class="material-icons left">close</i></a>
	            </td>
	            {!! Form::close() !!}
            </tr>
         @endforeach
         
        </tbody>
      </table>
	</div>


	<!-- Modal Trigger -->
	<center><a href="#addblock-modal" style="margin-top:10px;" class="waves-effect waves-light btn" id="addblock-btn"><i class="material-icons left">add</i>Add More Block</a></center>

  <!--Add apartment Modal Structure -->
  <div id="addblock-modal" class="modal modal-fixed-footer">
    <div class="modal-content">
      <div class="container">
		{!! Form::open(['url'=>'/admin/addblock', 'id'=>'addform']) !!}
		<div class="center-align" style="font-weight:500;font-size:32px;margin-bottom:40px !important;padding-top:20px;">Add an Block</div>

		<div class="row field">
			<div class="input-field col s12">
			<i class="material-icons prefix">location_city</i>
				{!! Form::label('address') !!}
				{!! Form::text('address', null) !!}
				<div class="error-input">
					@foreach($errors->get('address') as $message)
	              		{{ $message }}
	            	@endforeach			
				</div>
			</div>
		</div>

		<div class="row field">
			<div class="input-field col s12">
			<i class="material-icons prefix">grid_on</i>
				{!! Form::label('area') !!}
				{!! Form::text('area', null) !!}
				<div class="error-input">
					@foreach($errors->get('area') as $message)
	              		{{ $message }}
	            	@endforeach			
				</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
      <a href="javascript:void(0)" id="addblock" class=" modal-action modal-close waves-effect waves-green btn-flat">Add</a>
    </div>
  </div>


  <!-- Delete Modal Structure -->
    <div id="delete-modal" class="modal">
	    <div class="modal-content">
	       <h4>Confirm Delete</h4>
	       <p>Are you sure you want to delete this Block?</p>
	    </div>
	    <div class="modal-footer">
	       <a href="javascript:void(0)" id="cancel" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
	       <a href="link" id="yes" class=" modal-action modal-close waves-effect waves-green btn-flat">Yes</a>
	    </div>
    </div>
    @if(!empty($errors->all()))
    <script type="text/javascript">
   		 $('#addblock-modal').openModal();
    </script>
	
	@endif
@stop

@section('callback')
	
	//$('tr').hover(function(){
	//	$(this).find('#btn-options').fadeIn();
	//}).mouseleave(function(){
	//	$(this).find('#btn-options').fadeOut();
	//});

	$('#addblock-btn').click(function(){
		$('#addblock-modal').openModal();
	});

	$('#addblock').click(function(){
		$('#addform').submit();
	});

	$('.edit-btn').click(function(){
		//var id = $('#deleteblock-btn').attr('name');
		//location.href="{{ URL::to('updateblock') }}"+'/'+id;

		$(this).parent().siblings('td').find('input').toggleClass('hidden');
		$(this).parent().siblings('td').find('.data-label').toggleClass('hidden');
		$(this).siblings('a.update-btn, a.cancel-btn, a.deleteblock-btn').toggleClass('hidden');
		$(this).toggleClass('hidden');
		$(this).parent().parent().siblings('tr').find('a.cancel-btn:visible').click();
	});

	$('.cancel-btn').click(function(e){
		e.preventDefault();

		$(this).parent().siblings('td').find('input').toggleClass('hidden')
			.each(function(i, e){
				$(e).val($(e).siblings('span').text());
			});
		$(this).parent().siblings('td').find('.data-label').toggleClass('hidden');
		$(this).siblings('a.update-btn, a.edit-btn, a.deleteblock-btn').toggleClass('hidden');
		$(this).toggleClass('hidden');
	});


	$('.deleteblock-btn').click(function(){
		var id = $(this).data('aid');
		console.log(id);
		$('#delete-modal').openModal();
		$('.modal-footer #yes').attr('href', "{{ url('admin/deleteblock') }}"+'/'+id);
	});

	$('.update-btn').click(function(){
		var apart_id = $(this).parent().siblings('td').find('#id').data('aid');
		var form = $(this).parent().parent().find('form');
		console.log(form);
		form.attr('action','{{ url("admin/updateblock") }}'+'/'+apart_id);
		form.submit();
	});
@stop