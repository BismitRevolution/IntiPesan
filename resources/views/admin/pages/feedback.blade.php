@extends('admin.dashboard')

@section('extra-js')
<script type="text/javascript" src="{{ asset('js/admin/event.js') }}"></script>
@yield('more-js')
@endsection

@section('breadcrumb')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.events.show', $event_id) }}">Event #{{ $event_id }}</a>
    </li>
    <li class="breadcrumb-item active">Feedback</li>
</ol>
@endsection

@section('actions')
<!-- Icon Cards-->
<div class="row">
    <!-- <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">Add new track</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('admin.tracks.add', $event_id) }}">
                <span class="float-left">ADD</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-warning o-hidden h-100">
			<div class="card-body">
				<div class="card-body-icon">
					<i class="fas fa-fw fa-list"></i>
				</div>
				<div class="mr-5">View tracks</div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="{{ route('admin.tracks.show', $event_id) }}">
				<span class="float-left">VIEW</span>
				<span class="float-right">
					<i class="fas fa-angle-right"></i>
				</span>
			</a>
		</div>
	</div> -->
    @yield('extra-actions')
    <!-- <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5">Archived Article</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">ARCHIVED</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div> -->
    <!-- <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5">Delete Article</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">DELETE</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div> -->
</div>
@endsection
