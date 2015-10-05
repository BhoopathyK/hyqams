@extends('layout.master')

@section('htmlclass')
<html>
@stop

@section('title')
	Manage Individual Apartment Details
@stop

@section('nav-desktop')
	<li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="{{ url('admin/managetenant') }}">Tenants</a></li>
    <li><a href="{{ url('admin/manageapartment') }}">Apartments</a></li>
    <li class="active"><a href="{{ url('admin/manageindi') }}">Individual Apartments</a></li>
    <li><a href="javascript:void(0)">Receipt</a></li>
@stop

@section('nav-mobile')
	<li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="{{ url('admin/managetenant') }}">Tenants</a></li>
    <li><a href="{{ url('admin/manageapartment') }}">Apartments</a></li>
    <li class="active"><a href="{{ url('admin/manageindi') }}">Individual Apartments</a></li>
    <li><a href="javascript:void(0)">Receipt</a></li>
@stop

@section('bodyclass')
	<body class="blue-grey lighten-5">
@stop

@section('body')
	<div class="divcenter center-align table-title" style="font-size:36px;margin-top:30px;font-weight:500;">List of Individual Apartments</div>
	<div class="container indiaparttable-container divcenter">
		<table class="highlight responsive-table centered">
        <thead>
            <tr>
	            <th data-field="indiapart_id">ID</th>
	            <th data-field="indiapart_num_of_occupant">Number of Occupant</th>
	            <th data-field="indiapart_date_rented">Date Rented</th>
	            <th data-field="indiapart_payment_duedate">Due Date</th>
	            <th data-field="indiapart_monthly_amount">Monthly Amount</th>
	            <th data-field="apartment_id">Apartment ID</th>
	            <th data-field="tenant_id">Tenant</th>
	            <th data-field="created_at">Created At</th>
	            <th data-field="updated_at">Updated At</th>
	            <th></th>
            </tr>
        </thead>

        <tbody>
        @foreach($indiapart as $indi)
            <tr>
        	{!! Form::open(['url'=>'/admin/updateindi', 'id'=>"updateform$indi->indiapart_id"]) !!}
	            <td width="60">
	            	<span class="" id="id" data-aid="{{ $indi->indiapart_id }}">{{ $indi->indiapart_id }}</span>
	            </td>
	            <td width="60">
	            	<span class="data-label">{{ $indi->indiapart_num_of_occupant }}</span>
	            	{!! Form::text('num_of_occupant', $indi->indiapart_num_of_occupant , ['class'=>'hidden center-align']) !!}
	            </td>
	            <td width="80">
	            	<span class="data-label">{{ $indi->indiapart_date_rented }}</span>
	            	<input id="date_rented" value="{{ $indi->indiapart_date_rented }}" name="date_rented" type="date" class="datepicker hidden">
	            </td>
	            <td width="80">
	            	<span class="data-label">{{ $indi->indiapart_payment_duedate }}</span>
	            	<input id="duedate" value="{{ $indi->indiapart_payment_duedate }}" name="payment_duedate" type="date" class="datepicker hidden">
	            </td>

	            <td width="60">
	            	<span class="data-label">{{ $indi->indiapart_monthly_amount }}</span>
	            	{!! Form::text('monthly_amount', $indi->indiapart_monthly_amount , ['class'=>'hidden center-align']) !!}
	            </td>
	            <td width="60">
	            	<span class="data-label">{{ $indi->apartment_id }}</span>
	            	{!! Form::text('apartment_id', $indi->apartment_id , ['class'=>'hidden center-align']) !!}
	            </td>
	            <td width="100">
	            	<span class="data-label">{{ $indi->tenant_id }}</span>
	            	{!! Form::text('tenant_id', $indi->tenant_id , ['class'=>'hidden center-align']) !!}
	            </td>
	            <td width="180">{{ $indi->created_at->format('M j, Y') }}</td>
	            <td width="180">{{ $indi->updated_at->format('M j, Y') }}</td>
	            <td width="150">
	            	<!-- href='{{ url("updateapartment/$indi->apartment_id") }}' -->
	            	<a href='javascript:void(0)'  style="margin-top:10px;" class="waves-effect waves-teal grey-text text-darken-3 btn-flat edit-btn tooltipped" data-position="top" data-tooltip="Edit" name="{{ $indi->indiapart_id }}"><i class="material-icons left" >edit</i></a>

	            	<a href="javascript:void(0)" data-position="top"  data-tooltip="Delete" style="margin-top:10px;" class="waves-effect waves-teal grey-text text-darken-3 btn-flat deleteindiapart-btn tooltipped" data-aid="{{ $indi->indiapart_id }}"><i class="material-icons left" >delete</i></a>


	            	<!-- Fot editing -->
	            	<a href='javascript:void(0)'  style="margin-top:10px;" class="waves-effect waves-green green-text btn-flat update-btn hidden tooltipped" name="{{ $indi->indiapart_id }}" data-position="top" data-tooltip="Update"><i class="material-icons left">check</i></a>
	            	<a href='javascript:void(0)'  style="margin-top:10px;" class="waves-effect waves-red red-text btn-flat cancel-btn hidden tooltipped" name="{{ $indi->indiapart_id }}" data-position="top" data-tooltip="Cancel"><i class="material-icons left">close</i></a>
	            </td>
         	{!! Form::close() !!}
            </tr>
         @endforeach
        </tbody>
      </table>
	</div>


	<!-- Modal Trigger -->
	<center><a href="#addindiapart-modal" style="margin-top:10px;" class="waves-effect waves-light btn" id="addindiapart-btn"><i class="material-icons left">add</i>Add More Individual Apartment</a></center>

  <!--Add apartment Modal Structure -->
  <div id="addindiapart-modal" class="modal modal-fixed-footer">
    <div class="modal-content">
      <div class="container">
		{!! Form::open(['url'=>'/admin/addindi', 'id'=>'addform']) !!}
		<div class="center-align" style="font-weight:500;font-size:32px;margin-bottom:40px !important;padding-top:20px;">Add Individual Apartment</div>

		<div class="row field">
			<div class="input-field col s12">
			<i class="material-icons prefix">vpn_key</i>
				{!! Form::label('id') !!}
				{!! Form::text('id', null ) !!}
				<div class="error-input">
					@foreach($errors->get('id') as $message)
	              		{{ $message }}
	            	@endforeach			
				</div>			
			</div>
		</div>

		<div class="row field">
			<div class="input-field col s12">
			<i class="material-icons prefix">filter_1</i>
				{!! Form::label('num_of_occupant') !!}
				{!! Form::text('num_of_occupant', null) !!}
				<div class="error-input">
					@foreach($errors->get('num_of_occupant') as $message)
	              		{{ $message }}
	            	@endforeach			
				</div>			
			</div>
		</div>

		<div class="row field">
			<div class="input-field col s12">
			<i class="material-icons prefix">today</i>
					<label for="date_rented">Date Rented</label>
					<input id="date_rented" name="date_rented" type="date" class="datepicker">
					<div class="error-input">
					@foreach($errors->get('date_rented') as $message)
	              		{{ $message }}
	            	@endforeach			
				</div>
			</div>
		</div>

		<div class="row field">
			<div class="input-field col s12">
			<i class="material-icons prefix">today</i>
					<label for="duedate">Due Date</label>
					<input id="duedate" name="payment_duedate" type="date" class="datepicker">
					<div class="error-input">
					@foreach($errors->get('payment_duedate') as $message)
	              		{{ $message }}
	            	@endforeach			
				</div>
			</div>
		</div>

		<div class="row field">
			<div class="input-field col s12">
			<i class="material-icons prefix">local_atm</i>
				{!! Form::label('monthly_amount') !!}
				{!! Form::text('monthly_amount', null) !!}
				<div class="error-input">
					@foreach($errors->get('monthly_amount') as $message)
	              		{{ $message }}
	            	@endforeach			
				</div>			
			</div>
		</div>

		<div class="row field">
			<div class="input-field col s12">
			<!-- <i class="material-icons prefix">location_city</i> -->
				{!! Form::select('apartment_id', $apartment, ['class'=>'browser-default']) !!}
				<div class="error-input">
					@foreach($errors->get('apartment_id') as $message)
	              		{{ $message }}
	            	@endforeach			
				</div>
			</div>
		</div>

		<div class="row field">
			<div class="input-field col s12">
			<!-- <i class="material-icons prefix">account_circle</i> -->
				{!! Form::select('tenant_id', $tenant, ['class'=>'browser-default']) !!}
				<div class="error-input">
					@foreach($errors->get('tenant_id') as $message)
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
      <a href="javascript:void(0)" id="addindiapart" class=" modal-action modal-close waves-effect waves-green btn-flat">Add</a>
    </div>
  </div>


  <!-- Delete Modal Structure -->
    <div id="delete-modal" class="modal">
	    <div class="modal-content">
	       <h4>Confirm Delete</h4>
	       <p>Are you sure you want to delete this Individual Apartment from Database?</p>
	    </div>
	    <div class="modal-footer">
	       <a href="javascript:void(0)" id="cancel" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
	       <a href="link" id="yes" class=" modal-action modal-close waves-effect waves-green btn-flat">Yes</a>
	    </div>
	    @if(!empty($errors->all()))
		    <script type="text/javascript">
		   		 $('#addindiapart-modal').openModal();
		    </script>
		@endif
    </div>
@stop

@section('callback')

	$('.datepicker').pickadate({
		labelMonthNext: 'Next month',
		labelMonthPrev: 'Previous month',
		monthsFull: [ 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ],
		weekdaysFull: [ 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' ],
		today: 'Today',
		clear: 'Clear',
		close: 'Close',
		closeOnSelect: true,
		closeOnClear: false,
		selectYears: 160,
		format: 'yyyy-mm-dd',
	  	selectMonths: true
	});

	$('#addindiapart-btn').click(function(){
		$('#addindiapart-modal').openModal();
	});

	$('#addindiapart').click(function(){
		$('#addform').submit();
	});

	$('.edit-btn').click(function(){
		//var id = $('#deleteindiapart-btn').attr('name');
		//location.href="{{ URL::to('updateapartment') }}"+'/'+id;

		$(this).parent().siblings('td').find('input').toggleClass('hidden');
		$(this).parent().siblings('td').find('.data-label').toggleClass('hidden');
		$(this).siblings('a.update-btn, a.cancel-btn, a.deleteindiapart-btn').toggleClass('hidden');
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
		$(this).siblings('a.update-btn, a.edit-btn, a.deleteindiapart-btn').toggleClass('hidden');
		$(this).toggleClass('hidden');
	});


	$('.deleteindiapart-btn').click(function(){
		var id = $(this).data('aid');
		console.log(id);
		$('#delete-modal').openModal();
		$('.modal-footer #yes').attr('href', "{{ url('admin/deleteindi') }}"+'/'+id);
	});

	$('.update-btn').click(function(){
		var apart_id = $(this).parent().siblings('td').find('#id').data('aid');
		var form = $(this).parent().parent().find('form');
		form.attr('action','{{ url("admin/updateindi") }}'+'/'+apart_id);
		form.submit();
	});
@stop