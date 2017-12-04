@extends('layouts.app')

@section('content')
    <header class="intro-header" style="background-image: url('img/admin.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="page-heading">
                        <h1>Admin Dashboard</h1>
                        <hr class="small">
                        <span class="subheading">Administrative Functions</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <section>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-th-large fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge italic">Articles</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href={{ url('articles/create') }} data-turbolinks="false">
                                        <div class="panel-footer">
                                            <span style="color:#222;" class="pull-left">Add Article</span>
                                            <span style="color:#222;" class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                    <a href={{ url('/unpublished-articles/') }}>
                                        <div class="panel-footer">
                                            <span style="color:#222;" class="pull-left">View Scheduled Articles</span>
                                            <span style="color:#222;" class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-primary">
                                    <div class="panel-heading" style="background-color:darkorange;">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-users fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge italic">Users</div>
                                                {{--<div>Files &amp; Resources</div>--}}
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ url('/account/contacts') }}">
                                        <div class="panel-footer">
                                            <span style="color:#222;" class="pull-left">Register User</span>
                                            <span style="color:#222;" class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                                <div class="col-md-4">
                                <div class="panel panel-primary">
                                    <div class="panel-heading" style="background-color:#3d000f;">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-tags fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge italic">Tags</div>
                                                {{--<div>Files &amp; Resources</div>--}}
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ url('/tags') }}">
                                        <div class="panel-footer">
                                            <span style="color:#222;" class="pull-left">Edit Tags</span>
                                            <span style="color:#222;" class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            </div>
                        </div>
                    </section>
                </div>
                </div>
            </div>
        </div>
</div>
@endsection
