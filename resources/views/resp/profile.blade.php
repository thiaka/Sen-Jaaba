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
                            <li class="breadcrumb-item"><a href="/dashboard">See Jaaba</a></li>
                            <li class="breadcrumb-item active">Profil</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Profil</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-4 col-lg-4 col-xl-4">
                <div class="card-box text-center">
                    <img src="https://ui-avatars.com/api/?name={{$profile->name}}&amp;color=7F9CF5&amp;background=EBF4FF" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                    <h4 class="mb-0">{{$profile->name}}</h4>

                    <div class="text-left mt-3">

                        <p class="text-muted mb-2 font-13"><strong>Profil :</strong><span class="ml-2">{{$profile->profil->nom}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{$profile->email}}</span></p>

                    </div>

                </div>
                <!-- end card-box -->

            </div>
            <!-- end col-->

            <div class="col-md-8 col-lg-8 col-xl-8">
                <div class="card-box">
                    <ul class="nav nav-pills navtab-bg nav-justified">
                        <li class="nav-item">
                            <a href="#aboutme" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                Infos personnelles
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                                Paramètrage
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="aboutme">

                            <form method="POST" id="identicalForm" action="{{ route('user.update_profile_r') }}">
                                @csrf
                                @method('PUT')
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Informations personnelles</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" value="{{$profile->id}}" name="id">
                                            <label for="firstname">Prénom(s) Nom</label>
                                            <input type="text" class="form-control" name="name" value="{{$profile->name}}" id="firstname" placeholder="Entrez le(s) prénom(s)">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="useremail">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{$profile->email}}" id="useremail" placeholder="Entrez l'adresse email">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="userAvatar">Photo de profil</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="photo" id="inputGroupFile04">
                                                    <label class="custom-file-label" for="inputGroupFile04">Choisir une photo de profil</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="text-right">
                                    <button type="submit" class="btn btn-info waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Enregistrer</button>
                                </div>
                            </form>

                        </div>
                        <!-- end tab-pane -->
                        <!-- end about me section content -->

                        <div class="tab-pane" id="settings">

                            <div class="errors-container">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <form method="POST" id="identicalForm" action="{{ route('user.update_password_r') }}">
                                @csrf
                                @method('PUT')
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Mot de passe </h5>

                                <div class="row">
                                    <input type="hidden" value="{{$profile->id}}" name="id">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="userpassword">Ancien mot de passe</label>
                                            <input type="password" class="form-control" name="nouveau_mot_de_passe" id="userOldPassword" placeholder="Ancien mot de passe">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="userpassword">Nouveau mot de passe</label>
                                            <input type="password" class="form-control" name="password" id="userNewPassword" placeholder="Nouveau mot de passe">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="userpassword">Confirmer nouveau mot de passe</label>
                                            <input type="password" class="form-control" name="password_confirmation" id="confirmUserNewPassword" placeholder="Confirmer nouveau mot de passe">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="text-right">
                                    <button type="submit" class="btn btn-info waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Enregistrer</button>
                                </div>
                            </form>

                        </div>
                        <!-- end settings content-->

                    </div>
                    <!-- end tab-content -->
                </div>
                <!-- end card-box-->

            </div>
            <!-- end col -->
        </div>
        <!-- end row-->

    </div>
    <!-- end container-fluid -->
@endsection
