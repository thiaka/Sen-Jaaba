@extends('layouts.resp')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/dashboard">Sen Jaaba</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Bienvenu {{ Auth::user()->name }} !</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">

            <div class="col-xl-3 col-md-6">
                <div class="card widget-box-two bg-purple">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body wigdet-two-content">
                                <p class="m-0 text-uppercase text-white" title="Statistics">Produits</p>
                                <h2 class="text-white"><span data-plugin="counterup">{{$produit}}</span> <i class="mdi mdi-arrow-up text-white font-22"></i></h2>
                            </div>
                            <div class="avatar-lg rounded-circle bg-soft-light ml-2 align-self-center">
                                <i class="mdi mdi-chart-line font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card widget-box-two bg-info">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body wigdet-two-content">
                                <p class="m-0 text-white text-uppercase" title="User Today">Rayons</p>
                                <h2 class="text-white"><span data-plugin="counterup">{{$rayon}}</span></h2>
                            </div>
                            <div class="avatar-lg rounded-circle bg-soft-light ml-2 align-self-center">
                                <i class="mdi mdi-access-point-network  font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card widget-box-two bg-pink">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body wigdet-two-content">
                                <p class="m-0 text-uppercase text-white" title="Request Per Minute">Categories</p>
                                <h2 class="text-white"><span data-plugin="counterup">{{$categorie}}</span></h2>
                            </div>
                            <div class="avatar-lg rounded-circle bg-soft-light ml-2 align-self-center">
                                <i class="mdi mdi-timetable font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card widget-box-two bg-success">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body wigdet-two-content">
                                <p class="m-0 text-white text-uppercase" title="New Downloads">Utilisateurs</p>
                                <h2 class="text-white"><span data-plugin="counterup">{{$user}}</span></h2>
                            </div>
                            <div class="avatar-lg rounded-circle bg-soft-light ml-2 align-self-center">
                                <i class="mdi mdi-cloud-download font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">5 derniers produits</h4>

                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Categorie</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($produits as $p)
                                        <tr>
                                            <td>{{$p->designation}}</td>
                                            <td>{{$p->categorie->nom}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="row">
                    @foreach($rayons as $r)
                        <div class="col-md-6">
                            <div class="card widget-box-three">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="bg-icon avatar-lg text-center bg-light rounded-circle">
                                            <i class="fe-database h2 text-muted m-0 avatar-title"></i>
                                        </div>
                                        <div class="media-body text-right ml-2">
                                            <p class="text-uppercase">{{$r->libelle}}</p>
                                            <h2 class="mb-0"><span data-plugin="counterup">{{$r->quantite_stock}}</span></h2>
                                            <p class="text-black-50 m-0"> quantite de stock</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- end row -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
    <!-- end container-fluid -->
@endsection
