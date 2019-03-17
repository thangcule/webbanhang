@extends('admin.master')
@section('content')
	<style>
		#report_products{
			margin-top: 50px;
		}
		.report_table{
			width: 90%;

		}
		.btn-default{
			background-color: #DDDDDD;
		}
		.btn-tabs a{
			color: #000;
		}
		#DataTables_Table_0_wrapper .col-sm-6,#DataTables_Table_0_wrapper .col-sm-7{
			width: 100%;
		}
		#DataTables_Table_0_filter{
			float: left;
			width: 100%;
		}
		#DataTables_Table_0_info,#DataTables_Table_0_length{
			display: none;
		}
		.btn-tabs{
			background: #fff;
		}
		.btn-default.active{
			border: none;
		}
	</style>
	<div id="report_products">
		<div class="col-md-3">
            <div class="box box-solid">
              	<div class="box-header with-border">
                	<h4 class="box-title">Products Sales</h4>
                	<div class="box-tools">
                  		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  		</button>
                	</div>
              	</div>
              	<div class="box-body no-padding">
                  	<ul class="nav nav-tabs tabs-left">
                      	<li class="active"><a href="#bestSeller" data-toggle="tab" aria-expanded="false">Best Seller</a></li><br>
                      	<li><a href="#Inventory" data-toggle="tab" aria-expanded="true">Inventory</a></li>
                      	<li><a href="#numberProductInDate" data-toggle="tab" aria-expanded="true">Number Seller By Date</a></li>
                  	</ul>
              	</div>
            </div>
        </div>
        <div class="col-md-9">
        	<div class="tab-content">
			  	<div id="bestSeller" class="tab-pane fade in active">
			  		<ul class="nav nav-pills nav-stacked">
                    	<a class="btn active btn-default btn-tabs" href="#chart_bestSeller" data-toggle="tab" aria-expanded="true"><i class="fa fa-bar-chart" aria-hidden="true"></i></a>
                    	<a class="btn btn-default btn-tabs" href="#info_bestSeller" data-toggle="tab" aria-expanded="false"><i class="fa fa-tags" aria-hidden="true"></i></a>
                    </ul>
					<div class="tab-content">
				  		<table id="info_bestSeller" class="report_table tab-pane fade ">
				  			<tr>
				  				<th>Products</th>
				  				<th>Price</th>
				  				<th>Quantity</th>
				  			</tr>
				  			@foreach($bestSellers as $product)
							<tr>
								<td>{{$product->name}}</td>
								<td>{{$product->price}}</td>
								<td>{{$product->number}}</td>
							</tr>
				  			@endforeach
				  		</table>
				  		<div id="chart_bestSeller" class="fade in active">
				  			<div class="box box-danger">
            					<div class="box-header with-border">
	              					<h3 class="box-title">Best seller products</h3>
	              					<div class="box-tools pull-right">
	                					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	                					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	              					</div>
            					</div>
							    <div class="box-body chart-responsive">
					         		<div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
								</div>
          					</div>
				  		</div>
				  	</div>	
			  	</div>
			  	<div id="Inventory" class="tab-pane fade">
					<div class="box box-success">
			            <div class="box-header with-border">
			              	<h3 class="box-title">Bar Chart</h3>

			              	<div class="box-tools pull-right">
			                	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			                	<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			              	</div>
			            </div>
			            <div class="box-body chart-responsive">
			              <div class="chart" id="inventory" style="height: 300px;"></div>
			            </div>
			            <!-- /.box-body -->
			        </div>
			  	</div>
			  	<div id="numberProductInDate" class="tab-pane fade">
			  		<div class="col-md-4">   
          				<div class="box box-info">
           					<div class="box-header">
            					<h3 class="box-title"><i class="fa fa-tags"></i>Products</h3>
          					</div>
            <!-- /.box-header -->
           					 <div class="box-body">
              					<table  class=" data_table table table-bordered table-hover">
									<thead>
										<tr>
											<th>Name</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($allProducts as $product)
											<tr>
												<td>{{$product->name}}</td>
												<td><a class="btn btn-default getNumberSale btn-tabs " data-name="{{$product->name}}" href="#chart_bestSeller" data-toggle="tab" aria-expanded="true"><i class="fa fa-bar-chart" aria-hidden="true"></i></a></td>
											</tr>
										@endforeach
									</tbody>
					            </table>
					        </div>
				            <!-- /.box-body -->
				        </div>
				    </div>
				    <div class="col-md-8">
				    	<!-- LINE CHART -->
          				<div class="box box-info">
            				<div class="box-header with-border">
	              				<h3 class="box-title">Line Chart</h3>
		             			<div class="box-tools pull-right">
		                			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		                			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		              			</div>
            				</div>
	            			<div class="box-body chart-responsive">
	              				<div class="chart" id="line-chart" style="height: 300px;"></div>
	            			</div>
         				</div>
				    </div>
			  	</div>
        	</div>
		</div>
	</div>
	<script type="text/javascript">
		var inventory,bestSeller, saleNumber;
		$(document).ready(function () {
			productNumberSale();
			bestSeller = createDonutChart();
			inventory = createInventoryChart();
		});
		function createDonutChart() {
			var data = [
			@foreach($bestSellers as $product)
				{
					label :  "{{$product->name}}",
					value : {{$product->number}}
				},
			@endforeach
			];
			var bestSeller = new Morris.Donut({
      			element: 'sales-chart',
      			resize: true,
      			colors: ['#0098C6' ,'#3265CB' ,'#DC3811' ,'#FF9800' ,'#109618' ,'#980098'],
      			data: data,
      			hideHover: 'auto'
    		});
    		return bestSeller; 
		}
		function createNumberSaleChart(data) {
			$('#line-chart').html("");
			var saleNumber = new Morris.Line({
		      element: 'line-chart',
		      resize: true,
		      data: data,
		      xkey: 'date',
		      ykeys: ['number'],
		      labels: ['Sales: '],
		      lineColors: ['#3c8dbc'],
		      hideHover: 'auto'
		    });
		    return saleNumber;
		}
		function createInventoryChart() {
			var data = [
				@foreach($Inventory as $product)
					{
						y : "{{$product->name}}",
						a : "{{$product->sale}}",
						b : "{{$product->quan_in_stock}}"
					},
				@endforeach
			];
			var inventory = new Morris.Bar({
		      	element: 'inventory',
		      	resize: true,
		      	data: data,
		      	barColors: ['#00a65a', '#f56954'],
		      	xkey: 'y',
		      	ykeys: ['a', 'b'],
		      	labels: ['sale', 'stock'],
		      	hideHover: 'auto'
		    });
		    return inventory;
		}
		function productNumberSale() {
			$('.getNumberSale').click(function () {
				$('.getNumberSale').each(function () {
					$(this).css("background","#fff");
				});
				$(this).css("background","#DDDDDD");
				var name = $(this).data("name");
				$.ajax({
					data : {name: name},
					url : '/admin/numberProductInDate',
					success: function (data) {
						console.log(data);
						saleNumber = createNumberSaleChart(data);
					}
				});
			});
		}
		$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
          	var target = $(e.target).attr("href");
          	switch (target) {
          		case "#bestSeller":
                  	bestSeller.redraw();
                  	$(window).trigger('resize');
                  	break;
              	case "#Inventory":
                  	inventory.redraw();
                  	$(window).trigger('resize');
                  	break;
		      	case "#numberProductInDate":
                  	saleNumber.redraw();
                  	$(window).trigger('resize');
                  	break;
          }
      });
	</script>
@stop