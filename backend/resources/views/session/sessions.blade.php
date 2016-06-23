@extends('layouts.main')

@section('content')
		<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">My Sessions</h3>
				</div><!-- /.box-header -->
				<!-- Check all button -->

				<div class="box-body sessions-table">
					<div class="pull-right filter-btn">
						<button class="btn btn-default btn-sm"><i class="fa fa-filter margin-r-5"></i> Filter parametars</button>
					</div>

					<!-- /.pull-right -->
					<table id="my-sessions" class="table table-hover table-bordered table-striped">
						<thead>
						<tr>
							<th class="smallest-th nosort">#</th>
							<th>Session</th>
							<th class="nosort">Comments</th>
							<th class="nosort">Date/Time</th>
							<th class="nosort">Power</th>
							<th class="nosort">Strokes</th>
							<th class="nosort">Distance</th>
							<th class="nosort">HR</th>
							<th class="nosort">Pace</th>
							<th class="nosort">Time</th>
							<th class="nosort">Action</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td data-title="#">1</td>
							<td>Session 1</td>
							<td data-title="Comments">I need to work...</td>
							<td data-title="Date/Time">February 12, 2016 12:10</td>
							<td data-title="Power">87-86 W</th>
							<td data-title="Strokes">21 str</td>
							<td data-title="Distance">0.223 km</td>
							<td data-title="HR">30 bpm</td>
							<td data-title="Pace">02:12 (500m)</td>
							<td data-title="Time">00:00:56.9</td>
							<td  class="action-td" data-title="Action">
                       <span>
                        <a href="#" class="mailedit-box-attachment-name" data-toggle="modal" data-target="#edit-session">
							<i class="fa fa-edit inline btn btn-sm btn-default"></i>
						</a>
                        <a href="#" class="mailedit-box-attachment-name" data-toggle="modal" data-target="#delete-session">
							<i class="fa fa-trash-o inline btn btn-sm btn-primary"></i>
						</a>

                        </span>
							</td>
						</tr>
						<tr>
							<td data-title="#">2</td>
							<td >Session 2</td>
							<td data-title="Comments">Working on it...</td>
							<td data-title="Date/Time">February 12, 2016 12:10</td>
							<td data-title="Power">87-86 W</th>
							<td data-title="Strokes">21 str</td>
							<td data-title="Distance">0.223 km</td>
							<td data-title="HR">30 bpm</td>
							<td data-title="Pace">02:12 (500m)</td>
							<td data-title="Time">00:00:56.9</td>
							<td  class="action-td" data-title="Action"><span>
                        <a href="#" class="mailedit-box-attachment-name" data-toggle="modal" data-target="#edit-session">
							<i class="fa fa-edit inline btn btn-sm btn-default"></i>
						</a>
                        <a href="#" class="mailedit-box-attachment-name" data-toggle="modal" data-target="#delete-session">
							<i class="fa fa-trash-o inline btn btn-sm btn-primary"></i>
						</a>

                        </span>
							</td>
						</tr>

					</table>
					<!-- Edit Session -->
					<div class="example-modal">
						<div class="modal" id="edit-session">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title">Edit Session</h4>
									</div>
									<div class="modal-body">

										<form id="edit-train-session">
											<h5 class="text-blue bold">Name</h5>
											<input type="text" class="oneLine-input" placeholder="Name of the session">
											<h5 class="text-blue bold">Comment</h5>
											<textarea rows="4" placeholder="I need to work on my strength" class="oneLine-input"></textarea>
										</form>
										</form>

									</div>
									<div class="modal-footer no-border">
										<button type="button" class="btn btn-primary pull-left"><i class="fa fa-edit margin-r-5"></i> Save changes</button>
										<button type="button" class="btn btn-default pull-left"  data-dismiss="modal"><i class="fa fa-times margin-r-5"></i> Cancel</button>
									</div>

								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
					</div><!-- / end of Edit Session -->

					<!-- Remove Session -->
					<div class="example-modal">
						<div class="modal" id="delete-session">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title">Delete Session</h4>
									</div>
									<div class="modal-body">

										<h4>Are you sure you want to delete thid session?</h4>

									</div>

									<div class="modal-footer no-border">
										<button type="button" class="btn btn-default pull-right"  data-dismiss="modal"><i class="fa fa-times margin-r-5"></i> Cancel</button>
										<button type="button" class="btn btn-primary pull-right margin-r-5"><i class="fa fa-check margin-r-5"></i> OK</button>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
					</div><!-- / end of Remove Session -->

				</div><!-- /.box-body -->

			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</section><!-- /.content -->
</div>



</div>
<!-- /.row -->
</section><!-- /.content -->

@endsection
@section('page-scripts')
		<!-- DataTables -->
<script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
	$(function () {
		$('my-sessions').DataTable({
			responsive: true
		});
	});

	$(function () {
		//Enable iCheck plugin for checkboxes
		//iCheck for checkbox and radio inputs
		$('.sessions-table input[type="checkbox"]').iCheck({
			checkboxClass: 'icheckbox_flat-blue',
			radioClass: 'iradio_flat-blue'
		});

		//Enable check and uncheck all functionality
		$(".checkbox-toggle").click(function () {
			var clicks = $(this).data('clicks');
			if (clicks) {
				//Uncheck all checkboxes
				$(".sessions-table input[type='checkbox']").iCheck("uncheck");
				$(this).addClass('icheckbox_flat-blue').removeClass('checked');
			} else {
				//Check all checkboxes
				$(".sessions-table input[type='checkbox']").iCheck("check");
				$(this).addClass('checked');
			}
			$(this).data("clicks", !clicks);
		});

	});


	var table = $('#my-sessions').DataTable({
		'aoColumnDefs': [{
			'bSortable': false,
			'aTargets': ['nosort']
		}]
	});
</script>
@endsection
