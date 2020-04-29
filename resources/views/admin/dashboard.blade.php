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
                              <div class="panel panel-red">
                                  <div class="panel-heading">
                                      <div class="row">
                                          <div class="col-xs-3">
                                              <i class="fa fa-trash-o fa-5x"></i>
                                          </div>
                                          <div class="col-xs-9 text-right">
                                              <div class="huge">{{ $systemstatus->dashboard_expirednondeleted }}</div>
                                              <div>Expired accounts not yet deleted</div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-3 col-md-6">
                              <div class="panel panel-yellow">
                                  <div class="panel-heading">
                                      <div class="row">
                                          <div class="col-xs-3">
                                              <i class="fa fa-database fa-5x"></i>
                                          </div>
                                          <div class="col-xs-9 text-right">
                                              <div class="huge">{{ round($systemstatus->ftpdata_totalspace / 1024 / 1024 / 1024) }} GB</div>
                                              <div>Total Space</div>
                                          </div>
                                      </div>
                                  </div>
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
                                              <div class="huge">{{ round($systemstatus->ftpdata_freespace / 1024 / 1024 / 1024) }} GB</div>
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
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Space usage on system in GB
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="spaceusage"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
              </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection

@section('scripts')
      <script>
      new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'spaceusage',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
          @foreach ($systemstatusmore as $status)
            { day: '{{ $status->created_at }}', used: {{ round($status->ftpdata_usedspace / 1024 / 1024 / 1024) }} },
          @endforeach
        ],
        // The name of the data record attribute that contains x-values.
        xkey: 'day',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['used'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['GB Used']
      });
      </script>
@endsection
