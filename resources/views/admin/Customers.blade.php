@extends('admin.master')
@section('content')
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <!-- tao cac thong bao them sua xoa -->
      @if(session('addNew'))
          <div class="alert alert-info">
            <strong>customers {{session('addNew')}}</strong> has been add.
          </div>
      @endif
      @if(session('justDelete'))
          <div class="alert alert-info">
            <strong>customers {{session('justDelete')}}</strong> has been remove.
          </div>
      @endif      
      @if(session('justEdit'))
          <div class="alert alert-info">
            <strong>customers {{session('justEdit')}}</strong> has been edit.
          </div>
      @endif      
    </section>

    <!-- Main content -->
    <section class="content">
          <div class="box box-info">
            <div class="box-header">
            	<h3 class="box-title"><i class="fa fa-user"></i> Customers</h3>
          	</div>
            <!-- /.box-header -->
            <div class="box-body">
              <table  class=" data_table table table-bordered table-hover">
					<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
            <th>Address</th>
            <th>Count</th>
					</tr>
					</thead>
					<tbody>
				      @foreach($allCustomers as $customer)
                  <tr class="viewOrdersByCustomer" data-href="/admin/order-customer/{{$customer->email}}">
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->email}}</td>
                    <td>{{$customer->address}}</td>
                    <td>{{$customer->count}}</td>
                  </tr>
                @endforeach
					</tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
  </section>

    <script type="text/javascript">      
          $(function(){
              $('.viewOrdersByCustomer').click(function () {
                window.location = $(this).data("href");
              });
          });
    </script>
@stop