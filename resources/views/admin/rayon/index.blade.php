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
                            <li class="breadcrumb-item active">Rayons</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Rayons</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row mb-2">
            <div class="col-md-6">
                <div class="row">
                    <div class="ml-2">
                        <button type="button" data-toggle="modal" data-target="#add-modal" class="btn btn-primary text-white waves-effect waves-light mb-3">
                            <i class="mdi mdi-plus"></i> Ajouter un rayon
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <form action="{{ route('rayon.search') }}" method="get">
                    <div class="input-group">
                        <input type="text" name="search_query" class="form-control" placeholder="Rechercher un rayon">
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
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">Nom Rayon</th>
                                        <th class="text-center">Nom catégorie</th>
                                        <th class="text-center">Quantite Stock</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rayons as $rayon)
                                        <tr>
                                            <td class="text-center">
                                                {{$rayon->libelle}}
                                            </td>
                                            <td class="text-center">
                                                @foreach($rayon->categories as $cat)
                                                    <button class="btn btn-success btn-xs">{{ $cat->nom }}</button>
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                                {{$rayon->quantite_stock}}
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#edit-modal-{{$rayon->id}}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>

                                                <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-modal-{{$rayon->id}}">
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
            {{$rayons->links()}}
        </ul>

    </div>
    <!-- end container-fluid -->

    <div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mt-0">Ajouter un nouveau Rayon</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('rayon.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Nom Rayon</label>
                                    <input type="text" class="form-control @error('libelle') is-invalid @enderror" name="libelle" placeholder="Nom">
                                    @error('libelle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Categorie</label>
                                    <select multiple class="form-control @error('categorie_id') is-invalid @enderror" name="categories[]">
                                        <option disabled>Choisir les categories</option>
                                        @foreach($categories as $rayon)
                                            <option value="{{$rayon->id}}">{{$rayon->nom}}</option>
                                        @endforeach
                                    </select>
                                    @error('categories[]')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Quantite Rayon</label>
                                    <input type="number" class="form-control @error('quantite_stock') is-invalid @enderror" name="quantite_stock" placeholder="Quantite de Stockage su rayon">
                                    @error('quantite_stock')
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

    @foreach($rayons as $rayon)
        <div id="edit-modal-{{$rayon->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mt-0">Modifier le Rayon : {{ $rayon->libelle }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('rayon.update', [$rayon->id]) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">Nom Rayon</label>
                                        <input type="text" class="form-control @error('libelle') is-invalid @enderror" value="{{$rayon->libelle}}" name="libelle" placeholder="Nom">
                                        @error('libelle')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">Categorie</label>
                                        <select multiple class="form-control @error('categorie_id') is-invalid @enderror" name="categories[]">
                                            <option disabled>Choisir les categories</option>
                                            @foreach ($categories as $cat)
                                                <option @if(in_array($cat->id, $rayon->categories->pluck('id')->toArray())) selected
                                                @endif value="{{ $cat->id }}">{{ $cat->nom }}</option>
                                            @endforeach
                                        </select>
                                        @error('categories[]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">Quantite Rayon</label>
                                        <input type="number" class="form-control @error('quantite_stock') is-invalid @enderror" value="{{$rayon->quantite_stock}}" name="quantite_stock" placeholder="Quantite de Stockage su rayon">
                                        @error('quantite_stock')
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

        <div id="delete-modal-{{$rayon->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">


                    <form action="{{ route('rayon.destroy', [$rayon->id]) }}" method="POST">
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
