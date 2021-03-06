@extends ('layouts.master')

@section ('title')
Admin - Sattapatta
@stop

@section('content')
	
	<div class="row">
		
		<div class="col-md-2">
			
			<div id="menu">
				<div class="panel panel-default list-group">
					<span class="list-group-item panel-heading text-center"><h5>Admin Panel</h5></span>
					<a href="#" class="list-group-item">
						<i class="fa fa-trello" style="font-size:large"></i>&nbsp; Dashboard
					</a>
					<a href="#" class="list-group-item" id="link-users">
						<i class="fa fa-users" style="font-size:large"></i>&nbsp; Users
					</a>
					<a href="#" class="list-group-item" id="link-categories">
						<i class="fa fa-clone" style="font-size:large"></i>&nbsp; Categories
					</a>
					<!-- <div id="sl" class="sublinks collapse">
						<a class="list-group-item small">view categories</a>
						<a class="list-group-item small" id="link-add-category">add new category</a>
					</div> -->
					
					<a href="#" class="list-group-item" data-toggle="collapse" data-target="#sm" data-parent="#menu">
						<i class="fa fa-envelope-o" style="font-size:large"></i>&nbsp; Messages
					</a>
					<div id="sm" class="sublinks collapse">
						<a class="list-group-item small"><span class="glyphicon glyphicon-chevron-right"></span> view categories</a>
						<a class="list-group-item small"><span class="glyphicon glyphicon-chevron-right"></span> add new category</a>
					</div>
					<!-- <a href="#" class="list-group-item">ANOTHER LINK ...<span class="glyphicon glyphicon-stats pull-right"></span></a> -->
				</div>
			</div>

		</div>
		
		<div class="col-md-10">
			<div class="panel panel-default" id="panel-admin">
				<div class="panel-heading" id="panel-heading"><h6>Dashboard</h6></div>
				<div class="panel-body" id="panel-body" style="display:none">
					<i class="fa fa-spinner fa-pulse fa-lg"></i> Loading...
				</div>
				<div id="panel-after-body"></div>
				<div class="panel-footer" id="admin-panel-footer" style="display:none"></div>
			</div>
		</div>
	</div>


@stop

@section ('script')
  {{ HTML::script('js/admin.js') }}
  
  
@stop