
	@if (auth()->user()->roles[0]->id == '3')
	<li class="nav-item dropdown">
		<?php
			$notification_technician = notificationTechnician();
			$notification_technician_count = count($notification_technician);
		?>
		<a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
			<i class="icon-bell3"></i>
			<span class="d-md-none ml-2">Work for Tomorrow</span>
			@if ($notification_technician_count > 0)
				<span class="badge badge-pill bg-warning-400 ml-auto ml-md-0">{{$notification_technician_count}}</span>
			@endif
		</a>
		<div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
			<div class="dropdown-content-header">
				<span class="font-weight-semibold">Schedules for Tomorrow</span>
				<a href="#" class="text-default"><i class="icon-bell3"></i></a>
			</div>
			<div class="dropdown-content-body dropdown-scrollable">
				<ul class="media-list">
					@if ($notification_technician_count > 0)
						@foreach ($notification_technician as $notif)
						<li class="media">
							<div class="media-body">
								<div class="media-title">
									<a href="{{$notif['url']}}">
										<span class="font-weight-semibold">{{$notif['number']}}</span>
									</a>
								</div>
									<span class="text-muted">{{$notif['count']}} job instruction ready to work tomorrow.</span>
							</div>
						</li>
						@endforeach
					@else
						<li class="media">
							<div class="media-body">
								<span class="text-muted">No schedule for tomorrow.</span>
							</div>
						</li>
					@endif
				</ul>
			</div>

			<div class="dropdown-content-footer justify-content-center p-0">
				<a class="bg-light text-grey w-100 py-2" data-popup="tooltip" ><i class="icon-menu7 d-block top-0"></i></a>
			</div>
		</div>
	</li>
	@endif
	<li class="nav-item dropdown">
		<?php
			$notification = notificationWT();
			$notification_count = count($notification);
		?>
		<a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
			<i class="icon-bubbles4"></i>
			<span class="d-md-none ml-2">Noification</span>
			@if ($notification_count > 0)
				<span class="badge badge-pill bg-warning-400 ml-auto ml-md-0">{{$notification_count}}</span>
			@endif
		</a>
		<div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
			<div class="dropdown-content-header">
				<span class="font-weight-semibold">Notifications</span>
				<a href="#" class="text-default"><i class="icon-bubbles4"></i></a>
			</div>
			<div class="dropdown-content-body dropdown-scrollable">
				<ul class="media-list">
					@if ($notification_count > 0)
						@foreach ($notification as $notif)
						<li class="media">
							<div class="media-body">
								<div class="media-title">
									<a href="{{$notif['url']}}">
										<span class="font-weight-semibold">{{$notif['number']}}</span>
										<span class="text-muted float-right font-size-sm">{{$notif['time']}}</span>
									</a>
								</div>
								@if (!empty($notif['count']))
									@if ( $notif['type'] == 'Evidence' )
										<span class="text-muted">{{count($notif['count'])}} Evidence Status is <b>{{$notif['status']}}</b>. {{$notif['note']}}.</span>
									@elseif ($notif['type'] == 'Test Form')
										<span class="text-muted">{{count($notif['count'])}} Test Form Status is <b>{{$notif['status']}}</b>. {{$notif['note']}}.</span>
									@else
										<span class="text-muted">{{$notif['count']}} Quick Report Status is <b>{{$notif['status']}}</b>. {{$notif['note']}}.</span>
									@endif
								@else
									<span class="text-muted">Status is <b>{{$notif['status']}}</b>. {{$notif['note']}}.</span>
								@endif
							</div>
						</li>
						@endforeach
					@else
						<li class="media">
							<div class="media-body">
								<span class="text-muted">Notification is empty.</span>
							</div>
						</li>
					@endif
				</ul>
			</div>

			<div class="dropdown-content-footer justify-content-center p-0">
				<a class="bg-light text-grey w-100 py-2" data-popup="tooltip" ><i class="icon-menu7 d-block top-0"></i></a>
			</div>
		</div>
	</li>