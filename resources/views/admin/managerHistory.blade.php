@extends('admin.master')
@section('content')
	<section class="content">
		<div class="box tab-pane"  style="" id="comment-hisoty">
           	@foreach($events as $event)
                <div class="comment row">
                    <div class="col-md-1 avatar-comment">
                        <img src="https://t4.ftcdn.net/jpg/01/05/72/55/240_F_105725545_wjyNkHco8leWLvlw3kWJbDas8MwBz9Wl.jpg" alt="">
                    </div>
                    <div class="col-md-9" style="font-size: 16px;">
                        <div class="name-date">
                            <span class="admin">{{$event->getAdmin()->name}}</span>
                        </div>
                        <div class="comment-content"><?php echo $event->action; ?></div>
                    </div>

                    {{--<div class="col-md-1 status-history btn" data-status="{{$event->status}}"></div>--}}
                </div>
            @endforeach
    	</div>
	</section>
@stop