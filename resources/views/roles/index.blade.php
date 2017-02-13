@extends('app')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default panel-shadow">
			  <div class="panel-heading">
			    <h1 class="panel-title"><strong>Roles</strong></h1>
          <?php echo Session::get('message'); ?>
			  </div>
			  <div class="panel-body">
          <div class="pull-left">
              <span>Filter by: </span>
              <form id="filterForm">
              <select class="form-control" onchange="filterRoles()" name="filter" id="filter">
                <option value=""></option>
                @foreach($expansions as $expansion)
                  <option value="{{ $expansion->id }}" {{ (Request::input('filter') == $expansion->id) ? 'selected' : "" }}>{{ $expansion->name }}</option>
                @endforeach
              </select>
            </form>
            <script>
              function filterRoles() {
                    document.getElementById("filterForm").submit();
                }
            </script>
          </div>
          <div class="pull-right"><a href="/roles/create" class="btn btn-primary">Create Role <i class="fa fa-plus-square"></i></a></div>
			  	<div style="clear:both;"></div>
			  	<div class="row">
					<div class="col-sm-12">
						<p><strong>Roles:</strong></p>
						<div class="table-responsive">
              <table class="table dataTable table-striped table-hover">
                <col width="5%">
                <col width="20%">
                <col width="10%">
                <col width="10%">
                <col width="20%">
                <col width="10%">
                <col width="20%">
                <col width="5%">
						    <thead>
						    	<tr>
                    <th>#</th>
						    		<th>Name</th>
                    <th></th>
                    <th>Impact</th>
                    <th>Expansion</th>
                    <th>Status</th>
						    		<th></th>
                    <th></th>
						    	</tr>
						    </thead>
						    <tbody class="sortable" data-entityname="roles">
						    	@foreach($roles as $role)
							      <tr data-itemId="{{ $role->id }}">
                      <td scope="row" class="id-column">{{ $role->position }}</td>
                      <td>{{ $role->name }}</td>
                      <td><img src="{{ $role->image }}" class="img-responsive" /></td>
                      <td>{{ $role->impact }}</td>
                      <td>{{ $role->expansion->name }}</td>
                      <td>
                        @if($role->status)
                          <i class="fa {{ $role->status->icon }} fa-2x" style="color: #{{ $role->status->colour }};" aria-hidden="true"></i>
                        @endif
						    		  <td><a href="/roles/{{ $role->id }}/edit" class="btn btn-warning">Edit <i class="fa fa-pencil-square-o"></i></a></td>
                      <td class="sortable-handle"><span class="glyphicon glyphicon-sort"></span></td>
						    	  </tr>
						    	@endforeach
						    </tbody>
						  </table>
						</div>
					</div>
				</div>
			  </div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
  <script>
  /**
   *
   * @param type string 'insertAfter' or 'insertBefore'
   * @param entityName
   * @param id
   * @param positionId
   */
  var changePosition = function(requestData){
      $.ajax({
          'url': '/sort',
          'type': 'POST',
          'headers': {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
              'XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
              'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          'data': requestData,
          'success': function(data) {
              if (data.success) {
                  location.reload();
              } else {
                  console.error(data.errors);
              }
          },
          'error': function(){
              console.error('Something wrong!');
          }
      });
  };

  $(document).ready(function(){
      var $sortableTable = $('.sortable');
      if ($sortableTable.length > 0) {
          $sortableTable.sortable({
              handle: '.sortable-handle',
              axis: 'y',
              update: function(a, b){

                  var entityName = $(this).data('entityname');
                  var $sorted = b.item;

                  var $previous = $sorted.prev();
                  var $next = $sorted.next();

                  if ($previous.length > 0) {
                      changePosition({
                          parentId: $sorted.data('parentid'),
                          type: 'moveAfter',
                          entityName: entityName,
                          id: $sorted.data('itemid'),
                          positionEntityId: $previous.data('itemid')
                      });
                  } else if ($next.length > 0) {
                      changePosition({
                          parentId: $sorted.data('parentid'),
                          type: 'moveBefore',
                          entityName: entityName,
                          id: $sorted.data('itemid'),
                          positionEntityId: $next.data('itemid')
                      });
                  } else {
                      console.error('Something wrong!');
                  }
              },
              cursor: "move"
          });
      }
  });
  </script>
@endsection
