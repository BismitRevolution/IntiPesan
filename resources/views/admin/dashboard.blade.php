@extends('admin.layout.master')

@section('sidebar')
<li id="nav-event" class="nav-item">
    <a class="nav-link" href="{{ route('admin.events.index') }}">
        <i class="fas fa-fw fa-calendar"></i>
        <span>Event</span>
    </a>
</li>
<li id="nav-notification" class="nav-item">
    <a class="nav-link" href="{{ route('admin.notifications.index') }}">
        <i class="fas fa-fw fa-bell"></i>
        <span>Notification</span>
    </a>
</li>
<li id="nav-feedback" class="nav-item">
    <a class="nav-link" href="{{ route('admin.questions.index') }}">
        <i class="fas fa-fw fa-newspaper"></i>
        <span>Question</span>
    </a>
</li>
<li id="nav-registrant" class="nav-item">
    <a class="nav-link" href="{{ route('admin.registrants.index') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Registrant</span>
    </a>
</li>
@endsection

@section('counter-notification', 1)
@section('counter-message', 1)

@section('content')
@yield('actions')
@yield('dashboard-content')

<!-- Sticky Footer -->
<footer class="sticky-footer">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright © BismitRevolution 2018</span>
        </div>
    </div>
</footer>
</div>
<!-- /.content-wrapper -->
@endsection
