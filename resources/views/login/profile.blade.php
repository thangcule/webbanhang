@extends('admin.master')
@section('content')
<link rel="stylesheet" href="{{asset('login/profile.css')}}">
        <!-- /.navbar-top -->
        <!-- end TOP NAVIGATION -->

        <!-- begin SIDE NAVIGATION -->
        <!-- /.navbar-side -->
        <!-- end SIDE NAVIGATION -->
<section class="content-header">

                
        <div id="page-wrapper">
            <div class="page-content">

                <!-- begin PAGE TITLE ROW -->
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->

                <div class="row">
                    <div class="col-lg-12">
                    	<div class="box">
                        <div class="portlet portlet-default">
                        	<div style="margin-left: 25px">
                            <div class="portlet-body">
                                <ul id="userTab" class="nav nav-tabs">
                                    <li class="active"><a href="#overview" data-toggle="tab">Overview</a>
                                    </li>
                                    <li><a href="#profile-settings" data-toggle="tab">Update Profile</a>
                                    </li>
                                </ul>
                                <div id="userTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="overview">

                                        <div class="row">
                                            <div class="col-lg-2 col-md-3">
                                            	<a href="#">
                                            		<span class="profile-edit">Edit</span>
                                            	</a>
                                                <img class="img-responsive img-profile img-thumbnail"  src="login/{{$admin->avatar}}" alt="">
                                            	
                                                <div class="list-group" style="margin-top: 15px">
                                                    <a href="#" class="list-group-item active">Overview</a>
                                                    <a href="#" class="list-group-item">Messages<span class="badge green">4</span></a>
                                                    <a href="#" class="list-group-item">Alerts<span class="badge orange">9</span></a>
                                                    <a href="#" class="list-group-item">Tasks<span class="badge blue">10</span></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-7 col-md-5">
                                                <h1>{{session('username')}}</h1>
                                                <p>deptrai...</p>
                                                <ul class="list-inline">
                                                    <li><i class="fa fa-map-marker fa-muted"></i> Bayville, FL</li>
                                                    <li><i class="fa fa-user fa-muted"></i> Administrator</li>
                                                    <li><i class="fa fa-group fa-muted"></i> Sales, Marketing, Management</li>
                                                    <li><i class="fa fa-trophy fa-muted"></i> Top Seller</li>
                                                    <li><i class="fa fa-calendar fa-muted"></i> Member Since: 5/13/11</li>
                                                </ul>
                                                <h3>Recent Sales</h3>
                                                <div class="table-responsive box-body no-padding" style="border: 1px solid black">
                                                    <table class="table table-hover table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Time</th>
                                                                <th>Amount</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1/31/14</td>
                                                                <td>6:14 PM</td>
                                                                <td>$12.07</td>
                                                                <td><span class="label label-warning">pending <i class="fa fa-refresh fa-spin"></i>&nbsp;
                                                                </td>
                                                            </tr>
                                                            <tr >
                                                                <td>1/31/14</td>
                                                                <td>6:02 PM</td>
                                                                <td>$5.32</td>
                                                                <td><span class="label label-warning">pending <i class="fa fa-refresh fa-spin"></i>&nbsp;
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>1/31/14</td>
                                                                <td>5:56 PM</td>
                                                                <td>$6.58</td>
                                                                <td><a class="label label-success"><i class="fa fa-arrow-circle-right"></i> View Order</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>1/31/14</td>
                                                                <td>5:12 PM</td>
                                                                <td>$15.61</td>
                                                                <td><a class="label label-success"><i class="fa fa-arrow-circle-right"></i> View Order</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>1/31/14</td>
                                                                <td>5:02 PM</td>
                                                                <td>$9.89</td>
                                                                <td><a class="label label-success"><i class="fa fa-arrow-circle-right"></i> View Order</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>1/31/14</td>
                                                                <td>4:47 PM</td>
                                                                <td>$2.21</td>
                                                                <td><a class="label label-danger"><i class="fa fa-warning"></i> Error</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>1/31/14</td>
                                                                <td>4:32 PM</td>
                                                                <td>$5.17</td>
                                                                <td><a class="label label-default"><i class="fa fa-arrow-circle-right"></i> Special Order</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                                <h3>Contact Details</h3>
                                                <p><i class="fa fa-globe fa-muted fa-fw"></i>  <a href="#">http://www.website.com</a>
                                                </p>
                                                <p><i class="fa fa-phone fa-muted fa-fw"></i> {{$admin->phonenumber}}</p>
                                                <p><i class="fa fa-building-o fa-muted fa-fw"></i> {{$admin->address}}
                                                <p><i class="fa fa-envelope-o fa-muted fa-fw"></i>  <a href="#">{{$admin->email}}</a>
                                                </p>
                                                <ul class="list-inline">
                                                    <li><a class="facebook-link" href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
                                                    </li>
                                                    <li><a class="twitter-link" href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
                                                    </li>
                                                    <li><a class="linkedin-link" href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
                                                    </li>
                                                    <li><a class="google-plus-link" href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="profile-settings" style="margin-bottom: 15px">

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <ul id="userSettings" class="nav nav-pills nav-stacked">
                                                    <li class="active"><a href="#basicInformation" data-toggle="tab"><i class="fa fa-user fa-fw"></i> Basic Information</a>
                                                    </li>
                                                    <li><a href="#profilePicture" data-toggle="tab"><i class="fa fa-picture-o fa-fw"></i> Profile Picture</a>
                                                    </li>
                                                    <li><a href="#changePassword" data-toggle="tab"><i class="fa fa-lock fa-fw"></i> Change Password</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-9">
                                                <div id="userSettingsContent" class="tab-content">
                                                    <div class="tab-pane fade in active" id="basicInformation">
                                                        <form role="form">
                                                            <h4 class="page-header">Personal Information:</h4>
                                                            <div class="form-group">
                                                                <label>First Name</label>
                                                                <input type="text" class="form-control" value="" name="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Last Name</label>
                                                                <input type="text" class="form-control" value="" name="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Phone Number</label>
                                                                <input type="tel" class="form-control" value="" name="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <input type="text" class="form-control" value="" name="">
                                                            </div>
                                                            <div class="form-inline">                         
                                                                <div class="form-group" style="margin-left: 0px">
                                                                    <label>City</label>
                                                                    <input type="text" class="form-control" value="" name="">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>State</label>
                                                                    <input type="text" class="form-control" value="" name="" required="">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>ZIP</label>
                                                                    <input type="text" class="form-control" value="" required="">
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn btn-default btn-submit" name="">Update Profile</button>
                                                            <button class="btn btn-green">Cancel</button>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane fade" id="profilePicture">
                                                        <h3>Current Picture:</h3>
                                                        <img class="img-responsive img-profile img-thumbnail" src="login/{{$admin->avatar}}" alt="">
                                                        <br>
                                                        <form role="form">
                                                            <div class="form-group">
                                                                <label>Choose a New Image</label>
                                                                <input type="file" name="">
                                                                <p class="help-block"><i class="fa fa-warning"></i> Image must be no larger than 500x500 pixels. Supported formats: JPG, GIF, PNG</p>
                                                                <button type="submit" name="" class="btn btn-default btn-submit">Update Profile Picture</button>
                                                                <button class="btn btn-green">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane fade in" id="changePassword">
                                                        <h3>Change Password:</h3>
                                                        <form role="form">
                                                            <div class="form-group">
                                                                <label>Old Password</label>
                                                                <input type="password" name="" class="form-control" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>New Password</label>
                                                                <input type="password" name="" class="form-control" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Re-Type New Password</label>
                                                                <input type="password" name="" class="form-control" value="">
                                                            </div>
                                                            <button type="submit" name="" class="btn btn-default btn-submit">Update Password</button>
                                                            <button class="btn btn-green">Cancel</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

</section>

    <!-- /#wrapper -->

    <!-- GLOBAL SCRIPTS -->

@stop