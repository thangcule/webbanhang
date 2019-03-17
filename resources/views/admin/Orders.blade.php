@extends('admin.master')
@section('content')
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <div  class="col-md-12">
          @if(session('justDelete'))
          <div class="alert alert-info">
            <strong>Orders {{session('justDelete')}}</strong> has been remove.
          </div>
      @endif
        <div class="box box-info">
            <div class="box-header with-border"> 
              <h4 id="today"></h4>  
              <h3 class="box-title">Orders : <span id="total">{{--number_format((string)intval($total)) --}}</span></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <div class="row dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="col-md-6">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                        <input type="text" name="daterange" value="" id="daterange" />
                    </div>
                    <div class="col-md-6">
                        <span style="float: right;">Status
                            <select id="filter-status" class="form-control">
                                <option value="0">View all</option>
                                <option value="1">Pending</option>
                                <option value="2">Processing</option>
                                <option value="3">Shipped</option>
                                <option value="4">Success</option>
                            </select>
                        </span>   
                    </div>
                </div>
                <table class="table no-margin data_table table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Created at</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody id="listOrder">  
                    @foreach($allOrders as $order)
                    <tr data-status="{{$order->status}}" data-id="{{$order->id}}" class="order-detail">
                        <td>{{$order->id}}</td>
                        <td>{{$order->name}}</td>
                        <td>{{$order->total}}</td>
                        <td>
                          @if($order->status == 1)
                              <span class="label label-warning"><i class="fa fa-refresh fa-spin"></i>&nbsp;   Pending</span>
                          @elseif($order->status == 2)
                              <span class="label label-info"><i class="fa fa-refresh fa-spin"></i>&nbsp;   Processing</span>
                          @elseif($order->status == 3)
                              <span class="label label-success"><i class="fa fa-refresh fa-spin"></i>&nbsp;   Shipped</span>
                          @else 
                              <span class="label label-primary"><i class="fa fa-check"></i>&nbsp;   Success</span>
                          @endif
                        </td>
                        <td>
                          @if($order->payment_status == 1)
                              <p>Yes</p>
                          @else
                              <p>No</p>
                          @endif
                        </td>
                        <td>{{$order->created_at}}</td>
                        <td class="action">
                            <a href="/admin/orders/{{$order->id}}" type="button" class="btn btn-info"><i class="fa fa-edit"></i>&nbsp;  View </a>
                            <button type="button" class="btn btn-danger delete" data-toggle="modal" data-name="" data-target="#deleteModal"><i class="fa fa-trash-o"></i>&nbsp;  Delete </button>
                        </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer -->
          </div>
      </div>
      <div class="col-md-4">
    </div>
    <div class="modal fade" id="deleteModal" role="dialog">
            <div class="modal-dialog">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-tags"></i>Remove order</h3>
                  <strong><h3 id="pickProduct"></h3></strong>
                </div>
                <div class="box-body">
                    <form class="form-group" action="/admin/orders/delete" method="post" id="delete_form">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="id" value="{{$order->id}}">
                      <input onclick="form_submit()" class="btn btn-info" name="delete" data-dismiss="modal" value="Ok" style="text-align: left; width: 45px;">
                      <input type="button" class="btn btn-default" name="cancel" data-dismiss="modal" value="Cancel"> 
                    </form>
                </div>
              </div>
            </div>
        </div>
    </section>
      
    <script type="text/javascript">
          function form_submit() {
            document.getElementById("delete_form").submit();
          } 
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
         
          //$('#datepicker').datepicker('setDate', new Date());
          $(document).ready(function() {
              var today = new Date();
              $('#today').html(today.toString().substr(0,15));
              $('.datepicker').datepicker().on('changeDate', dateChanged);

              // filter theo status
              $('#filter-status').on('change', function (e) {
                  var option = $("option:selected", this);
                  var value = this.value;

                  if(value == 0){
                      $('.order-detail').each(function () {
                          $(this).css("display","table-row");
                      });  
                  }else{
                      $('.order-detail').each(function () {
                          if(value != $(this).data("status"))
                              $(this).css("display","none");
                          else $(this).css("display","table-row");
                      });
                  }
                  /*$('.input-sm').val(""+value).keyup();*/
              });
          });

          // date range picker
          $('#daterange').on('apply.daterangepicker', function(ev, picker) {
              var date1 = picker.startDate.format('YYYY-MM-DD');
              var date2 = picker.endDate.format('YYYY-MM-DD');
              dateRange(date1, date2);
          });
          function dateChanged(ev) {
              var date = $.datepicker.formatDate('yy-mm-dd', ev.date);
              date = date.split('-');
              getOrderInDate(date)
          }
          function dateRange(date1, date2) {
              date1 = date1.split('-');
              date2 = date2.split('-');
              getOrderInDate(date1,date2);
          }
          function getOrderInDate(date1,date2) {
             $.post({
               data: {year1 : date1[0], month1: date1[1], day1: date1[2], 
                      year2 : date2[0], month2: date2[1], day2: date2[2]},
               type: "POST",
               url: '/admin/orders/filter',
               success: function (data) {
                  
                  var allOrders = $.map(data.allOrders, function(value, index) {
                      return [value];
                  });
                  /*$('#listOrder').html("");*/
                  $('.order-detail').each(function () {
                      $(this).css("display","none");
                  });
                  allOrders.forEach(function (order) {
                    $('tr[data-id='+order.id+']').css("display","table-row");
                  });
                  console.log(data.total);
                  $('#total').html(data.total);
               },
            });
          }
    </script>
@stop