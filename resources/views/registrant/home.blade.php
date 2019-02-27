@extends('registrant.dashboard')

@section('extra-js')
<!-- <script type="text/javascript" src="{{ asset('js/registrant.js') }}"></script> -->
@endsection

@section('breadcrumb')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('registrant.home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Overview</li>
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
                <div class="mr-5">Register to Event</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">REGISTER</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div> -->
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5">Feedback Forms</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('registrant.feedbacks.index') }}">
                <span class="float-left">REVIEW</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-music"></i>
                </div>
                <div class="mr-5">Presentation Attachments</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('registrant.attachments.index') }}">
                <span class="float-left">VIEW</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
    <!-- <div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-warning o-hidden h-100">
			<div class="card-body">
				<div class="card-body-icon">
					<i class="fas fa-fw fa-list"></i>
				</div>
				<div class="mr-5">View events</div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="#">
				<span class="float-left">VIEW</span>
				<span class="float-right">
					<i class="fas fa-angle-right"></i>
				</span>
			</a>
		</div>
	</div> -->
</div>
@endsection
