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
                            <li class="breadcrumb-item"><a href="/admin/dashboard">See Jaaba</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Categories</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row mb-2">
            <div class="col-md-6">
                <div class="row">
                    <div class="ml-2">
                        <button type="button" data-toggle="modal" data-target="#add-modal" class="btn btn-primary text-white waves-effect waves-light mb-3">
                            <i class="mdi mdi-plus"></i> Ajouter une categorie
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <form action="{{ route('categorie.search') }}" method="get">
                    <div class="input-group">
                        <input type="text" name="search_query" class="form-control" placeholder="Rechercher une categorie">
                        <span class="input-group-append">
                            <button type="submit" class="btn waves-effect waves-light btn-primary">Recherche</button>
                        </span>
                    </div>
                </form>
            </div>
            <!-- end col-->
        </div>
        <!-- end row-->

        <div class="row">
            <div class="col-md-3 col-lg-3"></div>
            <div class="col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nom catégorie</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $categorie)
                                        <tr>
                                            <td>
                                                {{$categorie->nom}}
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#edit-modal-{{$categorie->id}}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>

                                                <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-modal-{{$categorie->id}}">
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
            {{$categories->links()}}
        </ul>

    </div>
    <!-- end container-fluid -->

    <div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mt-0">Ajouter une nouvelle Categorie</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('categorie.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Nom Categorie</label>
                                    <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" placeholder="Nom">
                                    @error('nom')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
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

    @foreach($categories as $categorie)
        <div id="edit-modal-{{$categorie->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mt-0">Modifier la Categorie : {{ $categorie->nom }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('categorie.update', [$categorie->id]) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">Nom Categorie</label>
                                        <input type="text" class="form-control @error('nom') is-invalid @enderror" value="{{$categorie->nom}}" name="nom" placeholder="Nom">
                                        @error('nom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
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

        <div id="delete-modal-{{$categorie->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">


                    <form action="{{ route('categorie.destroy', [$categorie->id]) }}" method="POST">
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
