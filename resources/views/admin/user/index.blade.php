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
                    <button data-toggle="modal" data-target="#add-modal" class="btn btn-primary text-white waves-effect waves-light mb-3"><i class="mdi mdi-plus"></i> Ajouter un utilisateur</button>
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
                                            <span class="btn- btn-xs @if ($user->profil->nom == 'Administrateur') btn-danger @elseif($user->profil->nom == 'Responsable') btn-success @endif text-uppercase text-black">{{$user->profil->nom}}</span>
                                        </td>
                                        <td class="text-center">
                                            <button data-toggle="modal" data-target="#edit-modal{{$user->id}}" class="btn btn-xs btn-warning" >
                                                <i class="mdi mdi-pencil"></i>
                                            </button>

                                            <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-modal-{{$user->id}}">
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

<div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0">Ajouter un nouveau Utilisateur</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('utilisateur.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Prenom Nom</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Prenom(s) Nom">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Adresse Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Type Compte</label>
                                <select name="profil_id" id="profil_id" class="form-control @error('profil_id') is-invalid @enderror profil_id">
                                    <option disabled selected>Choisir le type de compte</option>
                                    @foreach($profils as $profil)
                                        <option value="{{$profil->id}}">{{$profil->nom}}</option>
                                    @endforeach
                                </select>
                                @error('profil_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($users as $user)
    <div id="edit-modal{{$user->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mt-0">Modifier l'tilisateur : {{$user->name}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('utilisateur.update', [$user->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                    <input type="hidden" value="{{$user->id}}" id="id" name="id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Prenom Nom</label>
                                    <input type="text" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Prenom(s) Nom">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Adresse Email</label>
                                    <input type="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Type Compte</label>
                                    <select name="profil_id" id="profil_id" class="form-control @error('profil_id') is-invalid @enderror profil_id">
                                        <option disabled selected>Choisir le type de compte</option>
                                        @foreach($profils as $profil)
                                            <option value="{{$profil->id}}" @if ($user->profil_id == $profil->id) selected @endif>{{$profil->nom}}</option>
                                        @endforeach
                                    </select>
                                    @error('profil_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="delete-modal-{{$user->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('utilisateur.destroy', [$user->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto;">
                        <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                            <div class="swal2-header">
                                <ul class="swal2-progress-steps" style="display: none;"></ul>
                                <div class="swal2-icon swal2-error" style="display: none;">
                                    <span class="swal2-x-mark">
                                        <span class="swal2-x-mark-line-left"></span>
                                        <span class="swal2-x-mark-line-right"></span>
                                    </span>
                                </div>
                                <div class="swal2-icon swal2-question" style="display: none;"></div>
                                <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"></div>
                                <div class="swal2-icon swal2-info" style="display: none;"></div>
                                <div class="swal2-icon swal2-success" style="display: none;">
                                    <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                                    <span class="swal2-success-line-tip"></span>
                                    <span class="swal2-success-line-long"></span>
                                    <div class="swal2-success-ring"></div>
                                    <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                    <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                                </div>
                                <img class="swal2-image" style="display: none;">
                                <h2 class="swal2-title" id="swal2-title" style="display: flex;">Etes-vous sûre pour cette suppression?</h2>
                                <button type="button" class="swal2-close" aria-label="Close this dialog" style="display: none;">×</button>
                            </div>
                            <div class="swal2-content">
                                <div id="swal2-content" style="display: block;">Veuillez confirmer!</div>
                                <input class="swal2-input" style="display: none;">
                                <input type="file" class="swal2-file" style="display: none;">
                                <div class="swal2-range" style="display: none;">
                                    <input type="range">
                                    <output></output>
                                </div>
                                <select class="swal2-select" style="display: none;"></select>
                                <div class="swal2-radio" style="display: none;"></div>
                                <label for="swal2-checkbox" class="swal2-checkbox" style="display: none;">
                                    <input type="checkbox">
                                    <span class="swal2-label"></span>
                                </label>
                                <textarea class="swal2-textarea" style="display: none;"></textarea>
                                <div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div>
                            </div>
                            <div class="swal2-actions" style="display: flex;">
                                <button type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block; background-color: rgb(52, 140, 212); border-left-color: rgb(52, 140, 212); border-right-color: rgb(52, 140, 212);">Oui, supprimer!</button>
                                <button type="reset" class="swal2-cancel swal2-styled" aria-label="" style="display: inline-block; background-color: rgb(108, 117, 125);">Annuler</button>
                            </div>
                            <div class="swal2-footer" style="display: none;"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@endsection
