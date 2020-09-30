@extends('layouts.app')

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Sen Jaaba</a></li>
                        <li class="breadcrumb-item active">Utilisateurs</li>
                    </ol>
                </div>
                <h4 class="page-title">Utilisateurs</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row mb-2">
        <div class="col-md-6">
            <div class="row">
                <div class="ml-2">
                    <a href="user-add.html" class="btn btn-primary text-white waves-effect waves-light mb-3"><i class="mdi mdi-plus"></i> Ajouter un utilisateur</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group">
                <input type="text" id="recherche" name="recherche" class="form-control" placeholder="Rechercher un utilisateur">
                <span class="input-group-append">
                    <button type="button" class="btn waves-effect waves-light btn-primary">Recherche</button>
                </span>
            </div>
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Photo</th>
                                    <th>Utilisateur</th>
                                    <th>Email</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <img src="https://ui-avatars.com/api/?name={{$user->name}}&amp;color=7F9CF5&amp;background=EBF4FF" alt="table-user" class="mr-2 rounded-circle">
                                        </td>
                                        <td class="table-user">
                                            <a href="javascript:void(0);" class="text-body font-weight-semibold">{{$user->name}}</a>
                                        </td>
                                        <td>
                                            {{$user->email}}
                                        </td>
                                        <td class="text-center">
                                            <span class="btn- btn-xs btn-light text-uppercase text-black">{{$user->profil->nom}}</span>
                                        </td>
                                        <td class="text-center">

                                            <button type="button" class="btn btn-xs btn-success" data-target="">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <a href="user-view.html" class="btn btn-xs btn-warning" >
                                                <i class="mdi mdi-pencil"></i>
                                            </a>

                                            <button type="button" class="btn btn-xs btn-danger" data-target="">
                                                <i class="mdi mdi-window-close"></i>
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- end card-body-->
            </div>
            <!-- end card-->
        </div>
        <!-- end col -->

    </div>
    <!-- end row-->

    <ul class="pagination pagination-rounded justify-content-end mb-2 mt-0">
        {{$users->links()}}
    </ul>

</div>
<!-- end container-fluid -->

@foreach($users as $user)
    <div id="view-modal" class="modal">
        <div class="modal-background jb-modal-close"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Detail utilisateur</p>
                <button class="delete jb-modal-close" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <p>This will permanently delete <b>Some Object</b></p>
                <p>This is sample modal</p>
            </section>
            <footer class="modal-card-foot">
                <button class="button jb-modal-close">Retour</button>
            </footer>
        </div>
        <button class="modal-close is-large jb-modal-close" aria-label="close"></button>
    </div>
@endforeach

@foreach($users as $user)
    <div id="delete-modal{{$user->id}}" class="modal">
        <div class="modal-background jb-modal-close"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Confirmer la suppression de l'utilisateur: {{$user->name}}</p>
                <button class="delete jb-modal-close" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <form action="{{ route('utilisateur.destroy', [$user->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input class="input" type="hidden" name="id">
                    <div class="field is-horizontal">
                        <div class="field-label">
                        <!-- Left empty for spacing -->
                        </div>
                        <div class="field-body">
                        <div class="field">
                            <div class="field is-grouped">
                            <div class="control">
                                <button type="submit" class="button is-primary">
                                <span>Oui, Supprimer</span>
                                </button>
                            </div>
                            <div class="control">
                                <button type="reset" class="button is-primary is-outlined">
                                <span>Annuler</span>
                                </button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
        <button class="modal-close is-large jb-modal-close" aria-label="close"></button>
    </div>
@endforeach
@endsection
