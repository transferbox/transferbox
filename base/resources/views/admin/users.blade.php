@extends('admin.template')

@section('css')
<!-- DataTables CSS -->
<link href="/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
@endsection

@section('content')
<div id="page-wrapper">
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Transfer Accounts</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                {{ $headingtext }}
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                      <thead>
                          <tr>
                              <th>Project Title</th>
                              <th>Creator Name</th>
                              <th>Creator Email</th>
                              <th>Username</th>
                              <th>Expiry Date</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($transferusers as $user)
                          <tr class="">
                              <td>{{ $user->tb_title }}</td>
                              <td>{{ $user->tb_name }}</td>
                              <td>{{ $user->tb_email }}</td>
                              <td>{{ $user->ftp_username }}</td>
                              <td>{{ $user->tb_expdate }}</td>
                              <td><a href="/admin/users/view/{{ $user->tb_uuid }}"><button type="button" class="btn btn-success btn-circle"><i class="fa fa-link"></i></button></a></td>
                          </tr>
                        @endforeach
                      </tbody>
                  </table>
              </div>
              <!-- /.panel-body -->
          </div>
          <!-- /.panel -->
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
</div>
<!-- /#page-wrapper -->
@endsection

@section('scripts')
    <!-- DataTables JavaScript -->
    <script src="/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables').DataTable({
            responsive: true
        });
    });
    </script>
@endsection
