<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div> -->

    <section class="section is-title-bar">
    <div class="level">
      <div class="level-left">
        <div class="level-item">
          <ul>
            <li>Admin</li>
            <li>Utilisateurs</li>
          </ul>
        </div>
      </div>
      <div class="level-right">
        <div class="level-item">
          <div class="buttons is-right">
            <a href="/admin/utilisateur" class="button is-primary">
              <span class="icon"><i class="mdi mdi-account-circle"></i></span>
              <span>Liste Utilisateurs</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="hero is-hero-bar">
    <div class="hero-body">
      <div class="level">
        <div class="level-left">
          <div class="level-item"><h1 class="title">
            Modifier Utilisateur
          </h1></div>
        </div>
        <div class="level-right" style="display: none;">
          <div class="level-item"></div>
        </div>
      </div>
    </div>
  </section>
  <section class="section is-main-section">
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-ballot"></i></span>
          Formulaire de modification
        </p>
      </header>
      <div class="card-content">
        <form action="{{ route('utilisateur.update', [$user->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Prenom Nom</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control is-expanded has-icons-left">
                        <input class="input @error('name') is-danger @enderror" type="text" value="{{$user->name}}" placeholder="Prenom Nom" name="name">
                        <span class="icon is-small is-left"><i class="mdi mdi-account"></i></span>
                        @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Email</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control is-expanded has-icons-left has-icons-right">
                            <input class="input @error('email') is-danger @enderror" value="{{$user->email}}" type="email" placeholder="Email" name="email">
                            <span class="icon is-small is-left"><i class="mdi mdi-mail"></i></span>
                            <span class="icon is-small is-right"><i class="mdi mdi-check"></i></span>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Type Utilisateur</label>
                </div>
                <div class="field-body">
                    <div class="field is-narrow">
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select name="type">
                                    <option value="administrateur">Administrateur</option>
                                    <option value="responsable">Responsable</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Mot de Passe</label>
                </div>
                <div class="field-body">
                    <div class="field is-narrow">
                        <p class="control is-expanded has-icons-left">
                        <input class="input @error('password') is-danger @enderror" type="text" placeholder="Mot de password" name="password">
                        <span class="icon is-small is-left"><i class="mdi mdi-lock"></i></span>
                        @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </p>
                    </div>
                </div>
            </div>
          <hr>
          <div class="field is-horizontal">
            <div class="field-label">
              <!-- Left empty for spacing -->
            </div>
            <div class="field-body">
              <div class="field">
                <div class="field is-grouped">
                  <div class="control">
                    <button type="submit" class="button is-primary">
                      <span>Modifier</span>
                    </button>
                  </div>
                  <div class="control">
                    <button type="reset" class="button is-primary is-outlined">
                      <span>Reset</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>

</x-app-layout>
