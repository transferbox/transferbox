@extends('admin.template')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Transfer user account</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Detailed user information
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Creator Name</label>
                                <p class="form-control-static">{{ $transferuser{0}->tb_name }}</p>
                            </div>
                            <div class="form-group">
                                <label>Creator Email</label>
                                <p class="form-control-static">{{ $transferuser{0}->tb_email }}</p>
                            </div>
                            <div class="form-group">
                                <label>Transfer/Project Name</label>
                                <p class="form-control-static">{{ $transferuser{0}->tb_name }}</p>
                            </div>
                            <div class="form-group">
                                <label>Comment</label>
                                <p class="form-control-static">{{ $transferuser{0}->tb_comment }}</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Registration Date</label>
                                <p class="form-control-static">{{ \Carbon\Carbon::parse($transferuser{0}->tb_regdate)->diffForHumans() }} ({{ $transferuser{0}->tb_regdate }})</p>
                            </div>
                            <div class="form-group">
                                <label>Expiry Date</label>
                                <p class="form-control-static">{{ \Carbon\Carbon::parse($transferuser{0}->tb_expdate)->diffForHumans() }} ({{ $transferuser{0}->tb_expdate }})</p>
                            </div>
                            <div class="form-group">
                                <label>FTP Username</label>
                                <p class="form-control-static">{{ $transferuser{0}->ftp_username }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->

    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Actions
            </div>
            <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      @if(intval($transferuser{0}->tb_status) === 0)
                      <p><a href="/account/reactivate/{{ $userUuid }}"><button type="button" class="btn btn-primary">Reactivate account and add 7 days</button></p>
                      @else
                      <p><a href="/account/resend/{{ $userUuid }}"><button type="button" class="btn btn-primary">Resend information email</button></p>
                      <p><a href="/account/extend/{{ $userUuid }}"><button type="button" class="btn btn-info">Extend account</button></p>
                      <p><a href="/account/delete/{{ $userUuid }}"><button type="button" class="btn btn-danger">Delete account</button></p>
                      @endif
                    </div>
                  </div>
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
