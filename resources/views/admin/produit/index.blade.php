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
                        <li class="breadcrumb-item active">Produits</li>
                    </ol>
                </div>
                <h4 class="page-title">Produits</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row mb-2">
        <div class="col-md-6">
            <div class="row">
                <div class="ml-2">
                    <button type="button" data-toggle="modal" data-target="#add-modal"  class="btn btn-primary text-white waves-effect waves-light mb-3"><i class="mdi mdi-plus"></i> Ajouter un produit</button>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <form action="{{ route('produit.search') }}" method="get">
                <div class="input-group">
                    <input type="text" name="search_query" class="form-control" placeholder="Rechercher un produit">
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
                                    <th class="text-center">Photo</th>
                                    <th class="text-center">Nom</th>
                                    <th class="text-center">Prix</th>
                                    <th class="text-center">Quantite</th>
                                    <th class="text-center">Categorie</th>
                                    <th class="text-center">Rayon</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produits as $produit)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{$produit->photo}}" alt="p-{{$produit->designation}}" class="rounded-circle" height="30">
                                    </td>
                                    <td class="text-center">
                                        {{$produit->designation}}
                                    </td>
                                    <td class="text-center">
                                        {{$produit->prix}} FCFA
                                    </td>
                                    <td class="text-center">
                                        {{$produit->quantite}}
                                    </td>
                                    <td class="text-center">
                                        {{$produit->categorie->nom}}
                                    </td>
                                    <td class="text-center">
                                        {{$produit->rayon_libelle}}
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#view-modal-{{$produit->id}}">
                                            <i class="mdi mdi-eye"></i>
                                        </button>

                                        <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#edit-modal-{{$produit->id}}">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>

                                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-modal-{{$produit->id}}">
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
        {{$produits->links()}}
    </ul>

</div>
<!-- end container-fluid -->

    <div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mt-0">Ajouter un nouveau Produit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('produit.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Photo</label>
                                    <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo">
                                    @error('photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Nom</label>
                                    <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" placeholder="Designation">
                                    @error('designation')
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
                                    <label for="field-1" class="control-label">Prix</label>
                                    <input type="number" class="form-control @error('prix') is-invalid @enderror" id="prix" name="prix" placeholder="Prix du produit">
                                    @error('prix')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Quantite</label>
                                    <input type="number" class="form-control @error('quantite') is-invalid @enderror" id="quantite" name="quantite" placeholder="Nombre de produit">
                                    @error('quantite')
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
                                    <label for="field-1" class="control-label">Categorie</label>
                                    <select name="categorie_id" id="categorie_id" class="form-control @error('categorie_id') is-invalid @enderror categorie_id">
                                        <option disabled selected>Choisir la catégorie</option>
                                        @foreach($categories as $categorie)
                                            <option value="{{$categorie->id}}">{{$categorie->nom}}</option>
                                        @endforeach
                                    </select>
                                    @error('categorie_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Rayon</label>
                                    <select name="rayon_id" id="rayon_id" class="form-control @error('rayon_id') is-invalid @enderror rayon_id">
                                        <option disabled>Choisir le rayon</option>
                                    </select>
                                    @error('rayon_id')
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

@foreach($produits as $produit)

    <div id="edit-modal-{{$produit->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mt-0">Modifier le Produit: {{$produit->designation}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('produit.update', [$produit->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Photo</label>
                                    <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo">
                                    @error('photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Nom</label>
                                    <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" value="{{$produit->designation}}" name="designation" placeholder="Designation">
                                    @error('designation')
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
                                    <label for="field-1" class="control-label">Prix</label>
                                    <input type="number" class="form-control @error('prix') is-invalid @enderror" id="prix" value="{{$produit->prix}}" name="prix" placeholder="Prix du produit">
                                    @error('prix')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Quantite</label>
                                    <input type="number" class="form-control @error('quantite') is-invalid @enderror" id="quantite" value="{{$produit->quantite}}" name="quantite" placeholder="Nombre de produit">
                                    @error('quantite')
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
                                    <label for="field-1" class="control-label">Categorie</label>
                                    <select name="categorie_id" id="categorie_id" class="form-control @error('categorie_id') is-invalid @enderror categorie_id">
                                        <option disabled selected>Choisir la catégorie</option>
                                        @foreach($categories as $categorie)
                                            <option value="{{$categorie->id}}" @if($produit->categorie_id == $categorie->id) selected @endif >{{$categorie->nom}}</option>
                                        @endforeach
                                    </select>
                                    @error('categorie_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Rayon</label>
                                    <select name="rayon_id" id="rayon_id" class="form-control @error('rayon_id') is-invalid @enderror rayon_id">
                                        <option disabled>Choisir le rayon</option>
                                    </select>
                                    @error('rayon_id')
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

    <div id="delete-modal-{{$produit->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">


                <form action="{{ route('produit.destroy', [$produit->id]) }}" method="POST">
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

@section('script')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change', '.categorie_id', function(){

                var categorie_id = $(this).val();
                var div = $('.rayon_id').parent();
                var op = " ";
                $.ajax ({
                    type : 'get',
                    url: '{!!URL::to('/admin/findRayon')!!}',
                    data : { 'id' : categorie_id },
                    success : function(data){
                        op+='<option>Choisir le rayon</option>';
                        for(var i=0;i<data.length;i++){
                            op+='<option value="' + data[i].id + '">' + data[i].libelle + '</option>';
                        }

                        console.log(div.html());
                        div.find('.rayon_id').html(" ");
                        div.find('.rayon_id').append(op);
                    },
                    error : function(){
                        console.log("An error occured !");
                    }
                });
            });
        })
    </script>
@endsection

@endsection
