@extends('layouts.main')

@section('main')
@loop
<h1>Le Club</h1>

    <div>
        {{ Loop::content() }}
    </div>

<h1>Infos pratiques</h1>
<style>
  #map {
    width: 70%;
    height: 400px;
    background-color: #CCC;
    float: left;
  }

  #pano {
    width: 30%;
    height: 400px;
  }

  @media (max-width: 767px) {
    #map {
      width: 100%;
    }
    #pano {
    width: 100%;
    height: 400px;
  }
  }


</style>
 <div id="map"></div>
 <div id="pano"></div>
  <script>
    var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">Complexe Sportif </h1>'+
      '<div id="bodyContent">'+
      '<p>Le complexe sportif se trouve sur le route de Benastion, petit village chavagnais. Il cotoie les stades de football ainsi que le foyer des jeunes. Il est composé de 2 batiments : une salle omnisports, surmontée d\'une salle de gymnastique accueillant de nombreuses associations, ainsi que les écoles et collège ; un complexe regroupant une salle de tennis de table et une salle de danse.</b>'
      '<button id="goHereBtn">Go Here!</button>' +
      '</div>'+
      '</div>';

     function initMap() {
       var chavagnesLatLng = { lat: 46.89303	,lng : -1.25042 }
       var gymLatLong = {lat:46.88647, lng :-1.25861 };
       var streetViewInit = { lat: 46.88677, lng : -1.25953}
       var mapDiv = document.getElementById('map');

       var map = new google.maps.Map(mapDiv, {
         center: chavagnesLatLng,
         zoom: 14,
         scrollwheel : false
       });

       var panorama = new google.maps.StreetViewPanorama( document.getElementById('pano'), {
          position: streetViewInit,
          pov: {
            heading: 34,
            pitch: 10
          },
        });

      map.setStreetView(panorama);

       var marker = new google.maps.Marker({
          position: gymLatLong,
          map: map,
          title: 'Salle de sport',
          animation: google.maps.Animation.DROP
        });

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });
        infowindow.setZIndex(100000);

        marker.addListener('click', function() {
           infowindow.open(map, marker);
        });
     }
   </script>
  <script src="https://maps.googleapis.com/maps/api/js?callback=initMap&key=AIzaSyDZUvW8KAVHSOGek443WxSheEIgOiAkUKQ" async defer></script>

<h1>Le bureau</h1>

<div class="the-crew">
  <p>
    Le bureau est composé de {{ count($direction_members) }} membres.
  </p>
  <ul class="animated bounceIn">
    @foreach($direction_members as $key => $member)
    <li class="the-crew__item">
      <img class="the-crew__avatar" src="{{ $member->profilePicture  }}" alt="" />
      <div class="the-crew__infos">
        {{ $member->responsibility}}
        <div>{{ $member->display_name }}</div>
        <div>{{ $member->user_email }}</div>
        <div>Tel : {{ $member->phone }}</div>
      </div>
    </li>
    @endforeach
  </ul>

</div>
<div class="after-trombi">
    {{$infos_after_trombi}}
    @endloop

    @stop

  </div>
