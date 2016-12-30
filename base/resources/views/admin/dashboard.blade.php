@extends('admin.template')

@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Dashboard</h1>
                        <!-- /.row -->
                      <div class="row">
                          <div class="col-lg-3 col-md-6">
                              <div class="panel panel-primary">
                                  <div class="panel-heading">
                                      <div class="row">
                                          <div class="col-xs-3">
                                              <i class="fa fa-user fa-5x"></i>
                                          </div>
                                          <div class="col-xs-9 text-right">
                                              <div class="huge">{{ $activeaccounts }}</div>
                                              <div>Active Accounts</div>
                                          </div>
                                      </div>
                                  </div>
                                  <a href="/admin/users">
                                      <div class="panel-footer">
                                          <span class="pull-left">View Details</span>
                                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                          <div class="clearfix"></div>
                                      </div>
                                  </a>
                              </div>
                          </div>
                          <div class="col-lg-3 col-md-6">
                              <div class="panel panel-green">
                                  <div class="panel-heading">
                                      <div class="row">
                                          <div class="col-xs-3">
                                              <i class="fa fa-database fa-5x"></i>
                                          </div>
                                          <div class="col-xs-9 text-right">
                                              <div class="huge">{{ $freespace }} GB</div>
                                              <div>Free Space</div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection
