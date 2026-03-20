
<x-app-layout>

<head>
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }

        .blue-box {
            background-color: #007bff;
            border-radius: 8px;
            padding: 12px;
            color: white;
            text-align: center;
        }
        .header-home-text {
            margin: 0;
            font-weight: 600;
            font-size: 1rem;
        }
        #big-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
        }
        .img-home {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            background-color: #dee2e6;
        }
        .card-workshop {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background: white;
            overflow: hidden;
        }
        .card-workshop-title {
            font-weight: 700;
            font-size: 1.1rem;
            color: #333;
        }
        .img-placeholder {
            width: 100%;
            height: 100%;
            min-height: 120px;
            background-color: #ced4da;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 2rem;
        }
        .avatar-placeholder {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #007bff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

<div class="site-content">
    <div class="container">
        <div class="row">

            {{-- HERO --}}
            <div class="col-md-12 mb-5 home-infos" style="text-align: center">
                <div class="row">
                    <div class="col-md-12 mt-md-3">
                        <h2 id="big-title">
                            Bienvenue sur {{ config('app.name') }} <br>
                            le spécialiste des activités ludiques pour enfants
                        </h2>
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <div class="col-md-4 col-6">
                        <div class="img-home d-flex align-items-center justify-content-center bg-light rounded mb-2">
                            <i class="fas fa-child fa-3x text-primary"></i>
                        </div>
                        <a href="#list">
                            <div class="blue-box mt-2">
                                <p class="header-home-text">Nos activités ludiques</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="img-home d-flex align-items-center justify-content-center bg-light rounded mb-2">
                            <i class="fas fa-gift fa-3x text-success"></i>
                        </div>
                        <a href="#">
                            <div class="blue-box mt-2">
                                <p class="header-home-text">Nos bons plans gratuits</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- LISTE DES ATELIERS --}}
            <div class="card col-md-12">
                <div class="card-body" id="list">

                    {{-- Filtre département (statique) --}}
                    <div class="mb-4">
                        <form method="get" action="" class="form-inline">
                            <label for="department">Filtrer par département</label>
                            <select id="department" class="form-control form-control-sm ml-0 ml-md-3" name="department" style="height:auto; font-size:11px !important;">
                                <option value="">Tous les départements</option>
                                <option value="75">Paris (75)</option>
                                <option value="69">Rhône (69)</option>
                                <option value="13">Bouches-du-Rhône (13)</option>
                                <option value="33">Gironde (33)</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm mb-2 mt-3 mt-md-0 ml-0 ml-md-3">Filtrer</button>
                        </form>
                    </div>

                    {{-- Ateliers fictifs --}}
                    <div class="row justify-content-center">

                        @php
                        $workshops = [
                            [
                                'name'        => 'Atelier Peinture Créative',
                                'age_mini'    => 4,
                                'age_maxi'    => 10,
                                'effectif'    => 5,
                                'debut'       => '10h00',
                                'fin'         => '12h00',
                                'date'        => '25/06/2025',
                                'price'       => 12,
                                'city'        => 'Paris',
                                'description' => 'Un atelier coloré pour éveiller la créativité de vos enfants autour de la peinture.',
                                'animateur'   => 'Sophie',
                                'rating'      => 4.8,
                                'icon'        => 'fa-paint-brush',
                                'color'       => '#e74c3c',
                            ],
                            [
                                'name'        => 'Initiation à la Poterie',
                                'age_mini'    => 6,
                                'age_maxi'    => 12,
                                'effectif'    => 3,
                                'debut'       => '14h00',
                                'fin'         => '16h00',
                                'date'        => '30/06/2025',
                                'price'       => 15,
                                'city'        => 'Lyon',
                                'description' => 'Découvrez l\'art de la poterie dans un cadre ludique et bienveillant.',
                                'animateur'   => 'Marc',
                                'rating'      => 4.5,
                                'icon'        => 'fa-hands',
                                'color'       => '#8e44ad',
                            ],
                            [
                                'name'        => 'Cuisine en Famille',
                                'age_mini'    => 5,
                                'age_maxi'    => 14,
                                'effectif'    => 8,
                                'debut'       => '09h30',
                                'fin'         => '11h30',
                                'date'        => '05/07/2025',
                                'price'       => 18,
                                'city'        => 'Bordeaux',
                                'description' => 'Apprenez à cuisiner des recettes simples et délicieuses en famille.',
                                'animateur'   => 'Claire',
                                'rating'      => 5.0,
                                'icon'        => 'fa-utensils',
                                'color'       => '#27ae60',
                            ],
                        ];
                        @endphp

                        @foreach($workshops as $workshop)
                        <div class="col-md-12 card-workshop mb-3">
                            <div class="row">
                                {{-- Image / icône --}}
                                <div class="col-md-2 col-3 p-0">
                                    <div class="img-placeholder" style="background-color: {{ $workshop['color'] }}20;">
                                        <i class="fas {{ $workshop['icon'] }}" style="color: {{ $workshop['color'] }}"></i>
                                    </div>
                                </div>

                                {{-- Infos DESKTOP --}}
                                <div class="col-9 pt-2 pb-2 d-none d-md-block">
                                    <div class="row">
                                        <div class="col">
                                            <div class="card-workshop-title">{{ $workshop['name'] }}</div>
                                        </div>
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-4">
                                            <div>{{ $workshop['age_mini'] }} ans - {{ $workshop['age_maxi'] }} ans</div>
                                            @if($workshop['effectif'] > 0)
                                                <div>{{ $workshop['effectif'] }} places restantes</div>
                                            @else
                                                <div><span class="badge badge-danger">Complet</span></div>
                                            @endif
                                        </div>
                                        <div class="col-4">
                                            <div>{{ $workshop['debut'] }} - {{ $workshop['fin'] }}</div>
                                            <div>{{ $workshop['date'] }}</div>
                                            <div>{{ $workshop['price'] }} €/personne</div>
                                            <div>{{ $workshop['city'] }}</div>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-flex align-items-center" style="height:100%">
                                                <div class="avatar-placeholder mr-2">
                                                    {{ strtoupper(substr($workshop['animateur'], 0, 1)) }}
                                                </div>
                                                <div>
                                                    {{ $workshop['animateur'] }}<br>
                                                    {{ $workshop['rating'] }}/5 <i class="fa fa-star text-warning"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-12 text-muted" style="font-size:.9rem">
                                            {{ substr($workshop['description'], 0, 100) }}...
                                        </div>
                                    </div>
                                </div>

                                {{-- Infos MOBILE --}}
                                <div class="col-8 pt-2 pb-2 d-md-none">
                                    <div class="card-workshop-title">{{ $workshop['name'] }}</div>
                                    <div>{{ $workshop['age_mini'] }} ans - {{ $workshop['age_maxi'] }} ans</div>
                                    <div>{{ $workshop['debut'] }} - {{ $workshop['fin'] }}</div>
                                    <div>{{ $workshop['date'] }}</div>
                                    <div>{{ $workshop['city'] }}</div>
                                    @if($workshop['effectif'] > 0)
                                        <div>{{ $workshop['effectif'] }} places restantes</div>
                                    @else
                                        <div><span class="badge badge-danger">Complet</span></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</x-app-layout>