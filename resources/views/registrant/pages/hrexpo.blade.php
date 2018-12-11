@extends('registrant.dashboard')

@section('extra-js')
<script type="text/javascript" src="{{ asset('js/admin/event.js') }}"></script>
@endsection

@section('breadcrumb')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Overview</li>
</ol>
@endsection

@section('dashboard-content')
<style media="screen">
    #feedback-button > div {
        margin-bottom: 15px;
    }
</style>

<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Feedback Forms
	</div>
	<div id="feedback-button" class="card-body row">
        <div class="col-12">
            <h5 class=""><small>TESTING</small></h5>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_testing_feedback" target="_blank">TESTING</a>
        </div>

        <div class="col-12">
            <h5 class=""><small>PLENO</small></h5>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_pleno1_feedback" target="_blank">PLENO 1</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_pleno2b_feedback" target="_blank">PLENO 2</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_pleno3_feedback" target="_blank">PLENO 3</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_pleno4_feedback" target="_blank">PLENO 4</a>
        </div>

        <div class="col-12">
            <h5 class=""><small>TRACKS</small></h5>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track1_feedback" target="_blank">TRACK 1</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track2_feedback" target="_blank">TRACK 2</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track3_feedback" target="_blank">TRACK 3</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track4_feedback" target="_blank">TRACK 4</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track5_feedback" target="_blank">TRACK 5</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track6_feedback" target="_blank">TRACK 6</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track7_feedback" target="_blank">TRACK 7</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track8_feedback" target="_blank">TRACK 8</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track9_feedback" target="_blank">TRACK 9</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track10_feedback" target="_blank">TRACK 10</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track11_feedback" target="_blank">TRACK 11</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track12_feedback" target="_blank">TRACK 12</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track13_feedback" target="_blank">TRACK 13</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track14_feedback" target="_blank">TRACK 14</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track15_feedback" target="_blank">TRACK 15</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track16_feedback" target="_blank">TRACK 16</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track17_feedback" target="_blank">TRACK 17</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track18_feedback" target="_blank">TRACK 18</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track19_feedback" target="_blank">TRACK 19</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track20_feedback" target="_blank">TRACK 20</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track21_feedback" target="_blank">TRACK 21</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track22_feedback" target="_blank">TRACK 22</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track23_feedback" target="_blank">TRACK 23</a>
        </div>
        <div class="col">
            <a class="btn col-12 bg-green white" href="https://bit.ly/HRE_track24_feedback" target="_blank">TRACK 24</a>
        </div>
    </div>
</div>
@endsection
