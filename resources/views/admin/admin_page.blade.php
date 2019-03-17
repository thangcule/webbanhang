@extends('admin.master')
@section('content')
	<section class="content-header">
      <!-- chart  -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{count($orders)}}</h3>

              <p>Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="/admin/orders" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{count($today)}}</h3>

              <p>Orders Today</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/admin/order-today" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{count($customers)}}</h3>

              <p>Customers</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="/admin/customers" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
          
    

          <div class="col-md-3">
              <div class="box box-solid">
                  <div class="box-header with-border">
                      <h4 class="box-title">Products Sales</h4>
                      <div class="box-tools">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      </div>
                  </div>
                  <div class="box-body no-padding">
                      <ul class="nav nav-tabs tabs-left">
                          <li class="active"><a data-toggle="tab" href="#saleDate" >Sale By Date</a></li><br>
                          <li id="saleMonth"><a data-toggle="tab" href="#saleByMonth">Sale By Month</a></li>
                      </ul>
                  </div>
              </div>
          </div>
          <!-- BAR CHART -->
          <div class="col-md-9">
            <div class="tab-content">
              <div id="saleDate" class="tab-pane fade in active">
                  <div class="box box-success">
                      <div class="box-header with-border">
                          <h3 class="box-title">Sale by date</h3>
                          <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                      </div>
                      <div class="box-body chart-responsive">
                          <div class="chart" id="chartSaleDate" style="height: 300px;"></div>
                          <button class="btn btn-info pull-right" id="nextDate">Next</button>
                          <button class="btn btn-info pull-left" id="preDate">Previous</button>
                      </div>
                  </div>
              </div>
              <div id="saleByMonth" class="tab-pane fade">
                  <div class="box box-success">
                      <div class="box-header with-border">
                          <h3 class="box-title">Sale by month</h3>
                          <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                      </div>
                      <div class="box-body chart-responsive">
                          <div class="chart" id="chartSaleMonth" style="height: 300px;"></div>
                          <button class="btn btn-info pull-right" id="nextMonth">Next</button>
                          <button class="btn btn-info pull-left" id="preMonth">Previous</button>
                      </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-md-8"></div>
          <div class="col-md-4">
            <div class="box">
            <div class="box-body no-padding">
              <table class="table table-striped">
                <tbody><tr>
                  <th style="width: 10px">#</th>
                  <th>Task</th>
                  <th>Progress</th>
                  <th style="width: 40px">Label</th>
                </tr>
                <tr>
                  <td>1.</td>
                  <td>Pending</td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-red">{{$orderStatus[0]->number}}</span></td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>Processing</td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-yellow">{{$orderStatus[1]->number}}</span></td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>Shipped</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-light-blue">{{$orderStatus[2]->number}}</span></td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>Success</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-green">{{$orderStatus[3]->number}}</span></td>
                </tr>
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
     </section>
     <button id="click">click</button>
    <script type="text/javascript">
        var dateBar, monthBar;
        var startDate = 0, endDate = 6;
        var startMonth = 0, endMonth = 6;
        $(document).ready(function () {
            ajaxChangeMonth();
            ajaxChangeDate();
        });
        function createSaleDateChart(data) {
            $('#chartSaleDate').html("");
            var dateBar = new Morris.Bar({
                element: 'chartSaleDate',
                resize: true,
                data: data,
                barColors: ['#00a65a'],
                xkey: 'date',
                xLabelMargin: 0,
                ykeys: ['total'],
                labels: ['Sale: '],
                hideHover: 'auto'
            });
            return dateBar;
        }
        function createSaleMonthChart(data) {
            $('#chartSaleMonth').html("");
            var monthBar = new Morris.Bar({
                element: 'chartSaleMonth',
                resize: true,
                data: data,
                barColors: ['#00a65a'],
                xkey: 'month',
                xLabelMargin: 0,
                ykeys: ['total'],
                labels: ['Sale: '],
                hideHover: 'auto'
            });
            return monthBar;     
        }
        function ajaxChangeDate() {
            $.ajax({
                url : '/admin/ajax/saleByDate',
                data : {start : startDate, end: endDate},
                success: function (data) {
                    console.log(data);
                    dateBar = createSaleDateChart(data);
                }
            });
        }
        function ajaxChangeMonth() {
            $.ajax({
                url : '/admin/ajax/saleByMonth',
                data : {start : startMonth, end: endMonth},
                success: function (data) {
                    console.log(data);
                    monthBar = createSaleMonthChart(data);
                }
            });
        }
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var target = $(e.target).attr("href");
            console.log(target);
            switch (target) {
                case "#saleDate":
                    dateBar.redraw();
                    $(window).trigger('resize');
                    break;
                case "#saleByMonth":
                    monthBar.redraw();
                    $(window).trigger('resize');
                    break;
            }
        });
        $('#nextDate').click(function () {
            if(startDate > 0) {
                startDate -= 7;
                endDate -=7;
                ajaxChangeDate();
            }
        });
        $('#preDate').click(function () {
            startDate += 7;
            endDate +=7;
            ajaxChangeDate();
        });
        $('#nextMonth').click(function () {
            if(startMonth > 0) {
                startMonth -= 6;
                endMonth -=6;
                ajaxChangeMonth();
            }
        });
        $('#preMonth').click(function () {
            startMonth += 6;
            endMonth +=6;
            ajaxChangeMonth();
        });
    </script>
@stop