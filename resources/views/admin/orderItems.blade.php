@extends('admin.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header"></section>
    <section class="content">
        <div class="col-md-3">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h4 class="box-title">Order View</h4>

                <div class="box-tools">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="box-body no-padding">
                  <ul class="nav nav-tabs tabs-left">
                      <li class="active"><a href="#infomation" data-toggle="tab">Information</a></li><br>
                      <li><a href="#comment-hisoty" data-toggle="tab">Comments History</a></li>
                  </ul>
              </div>
              <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-9 tab-content">
          <div class="box box-info tab-pane active" id="infomation">
              <div class="box-header with-border">
                <div class="box-info col-md-6">
                    <h3>Order information</h3>
                    <table class="table-striped">
                        <tr>
                            <td>Order ID</td>
                            <td>#{{$order->id}}</td> 
                        </tr>
                        <tr>
                            <td>Order Date</td>
                            <td>{{$order->created_at}}</td>
                        </tr>
                        <tr>
                            <td>Order Status</td>
                            <?php 
                               $arr = array("Pending","Processing","Shipped","Delivery","Success");
                               echo "<td>".$arr[$order->status-1]."</td>";
                            ?>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <div class="box-info col-md-6">
                    <h3>Acount information</h3>
                    <table class="table-striped">
                        <tr>
                            <td>Customer name</td>
                            <td>{{$order->name}} </td> 
                        </tr>
                        <tr>
                            <td>Customer email</td>
                            <td>{{$order->email}} </td>
                        </tr>
                    </table>
                </div>
                <div style="clear: both;"></div>
                <div class="box-info col-md-6">
                    <h3>Address information</h3>
                    <table class="table-striped">
                        <tr>
                            <td>Address</td>
                            <td>{{$order->address}}</td> 
                        </tr>
                    </table>
                </div>
                <div class="box-info col-md-6">
                    <h3>Payment information</h3>
                    <table class="table-striped">
                        <tr>
                            <td>Payment</td>
                            <td>
                                @if($order->payment_status == 0)
                                  No
                                @else Yes
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div style="clear: both;"></div>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                  <form class="form-horizontal" action="/admin/orders/update" method="post">
                        {{ csrf_field() }}
                      <!-- id cua don hang minh dinh update -->
                      <input type="hidden" name="order_id" value="{{$order->id}}">
                      <input type="hidden" name="order_status" value="{{$order->status}}" id="order_status"> 
                      <input type="hidden" name="payment_status" value="{{$order->payment_status}}" id="payment_status">

                        <h3 class="box-title">Items ordered</h3>
                     
                    <!-- /.box-header -->
                        <div class="table-responsive">
                          <table class="table no-margin">
                            <thead>
                            <tr>
                              <th>Item ID</th>
                              <th>Name</th>
                              <th>Quantity</th>
                              <th>Price</th>
                            </tr>
                            </thead>
                            <tbody>
                              @foreach($allItems as $item)
                              <tr>
                                  <td>{{$item->getProduct()->id}}</td>
                                  <td>{{$item->getProduct()->name}}</td>
                                  <!-- id cua tung san pham san pham trong don hang --> 
                                  <td>{{$item->quantity}}</td>
                                  <td>{{$item->price}}</td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>                  

                        <div class="box-info col-md-12" style="margin-top: 30px;">
                          <!-- done, spin , wait -->
                            <div class="row" id="process-bar">
                                <div class="col-md-3 col-md-offset-1 status">
                                    <div class="circle"><i class="fa fa-check"></i><i class="fa fa-refresh fa-spin"></i></div>
                                    <div class="line"></div>
                                    <div class="progress">Pending</div>
                                </div>
                                <div class="col-md-3 status">
                                    <div class="circle"><i class="fa fa-check"></i><i class="fa fa-refresh fa-spin"></i></div>
                                    <div class="line"></div>
                                    <div class="progress">Processing</div>
                                </div>
                                <div class="col-md-3 status">
                                    <div class="circle"><i class="fa fa-check"></i><i class="fa fa-refresh fa-spin"></i></div>
                                    <div class="line"></div>
                                    <div class="progress">Shipped</div>
                                </div>
                                <div class="col-md-1 status">
                                    <div class="circle"><i class="fa fa-check"></i><i class="fa fa-refresh fa-spin"></i></div>
                                    <div class="progress">Success</div>
                                </div>
                            </div>
                          <h3 id="total-title">Order total</h3>
                          <div id="note" class="col-md-6">
                              <h4>Note for this order</h4>
                              <table>
                                  <tr>
                                      <td><span> Status</span></td>
                                      <td><span> Payment</span></td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <select id="select_status">
                                              <option value="1">Pending</option>
                                              <option value="2">Processing</option>
                                              <option value="3">Shipped</option>
                                              <option value="4">Successful</option>
                                          </select>
                                      </td>
                                      <td>
                                          <select id="select_payment_status">
                                              <option value="1">Yes</option>
                                              <option value="0">No</option>
                                          </select>    
                                      </td>
                                  </tr>
                              </table>
                              <button type="submit" name="update" value="Update" class="btn btn-info pull-right" style="font-weight: bold">Update</button>
                              <!-- /.table-responsive -->
                    </form>
                          </div>
                          <div id="order-total" class="box-info col-md-6">
                              <h4>Amount Due 2/22/2014</h4>
                              <table class="table-striped">
                                      <tr>
                                        <td>Subtotal</td>
                                        <td>{{$order->nettotal}}</td>
                                      </tr>
                                      <tr>
                                        <td>Tax(3%)</td>
                                        <td>{{$order->tax}}</td>
                                      </tr>
                                      <tr>
                                        <td>Total</td>
                                        <td>{{$order->total}}</td>
                                      </tr>
                              </table>
                            </div>
                      </div>
                  </div>
                </div>
                <!-- /.box-body -->
          <div class="box tab-pane"  style="" id="comment-hisoty">
              @foreach($events as $eventsInDay)
                <?php echo \Carbon\Carbon::parse($eventsInDay[0]->created_at)->format('d-m-Y'); ?>
                @foreach($eventsInDay as $event)
                <div class="comment row">
                    <div class="col-md-1 avatar-comment">
                        <img src="https://t4.ftcdn.net/jpg/01/05/72/55/240_F_105725545_wjyNkHco8leWLvlw3kWJbDas8MwBz9Wl.jpg" alt="">
                    </div>
                    <div class="col-md-9">
                        <div class="name-date">
                            <span class="admin">Admin {{$event->admin_id}}</span>
                            <span class="pull-right">
                                <?php echo \Carbon\Carbon::parse($eventsInDay[0]->created_at)->format('h:i:s A'); ?>
                            </span>
                        </div>
                        <div class="comment-content">{{$event->subcrible}}</div>
                    </div>

                    {{--<div class="col-md-1 status-history btn" data-status="{{$event->status}}"></div>--}}
                </div>
                @endforeach
              @endforeach
          </div>
        </div>
    </section>
    <script type="text/javascript">
            var arr_status = ["pending", "processing", "shipped", "delivery", "success"];
            var arr_status_class = ["btn-warning", "btn-info", "btn-success", "btn-danger", "btn-primary"];

            /*===================================*/
            var order_status = parseInt($('#order_status').val());
            $('#select_status').val(order_status);
            changeProgressSubcrible();
            var payment_status = parseInt($('#payment_status').val());
            $('#select_payment_status').val(payment_status);

            $(document).ready(function () {
                //status int to text
                $('#select_status').change(function () {            
                    changeProgressSubcrible();
                });
                $('#select_payment_status').change(function () {            
                    payment_status = parseInt($('#select_payment_status').val());
                    $('#payment_status').val(payment_status);
                });
                // trong comment history
                $('.status-history').each(function(){
                    status = $(this).data("status");
                    $(this).html(arr_status[status-1]);
                    $(this).addClass(arr_status_class[status-1]);
                });
            });    
            function changeProgressSubcrible() {
                    order_status = parseInt($('#select_status').val());
                    $('#order_status').val(order_status);
                    console.log(order_status);
                    var i = 1;
                    $('#process-bar > div').each(function () {
                        if($(this).hasClass('done')) $(this).removeClass('done');
                        if($(this).hasClass('spin')) $(this).removeClass('spin');
                        if($(this).hasClass('wait')) $(this).removeClass('wait');

                        if(i < order_status){
                            $(this).addClass('done');
                        }
                        else if(i > order_status){
                            $(this).addClass('wait');   
                        }
                        else {
                          if(order_status != 4)
                            $(this).addClass('spin');
                          else $(this).addClass('done');
                        }
                        i++;
                    });
            }
    </script>
@stop