@extends('layouts.main')
@section('main-wrapper')
<main id="profile" class="">
<div class="mdl-grid">
  <aside class="mdl-cell mdl-cell--4-col profile-column">
    <h2>Mon profil</h2>
    <div class="avatar" style="background:url( {{ $currentMember->user->profilePicture }}) center / cover">
    </div>
    <div class="infos">
    <h4>{{$currentMember->user->display_name}}</h4>
    @if($currentMember->roles != '') 
        @foreach($currentMember->roles as $key => $responsibility)
            <span class="label-pills">{{ $responsibility }}</span>
        @endforeach
    @endif
    </div>
  </aside>
  <div class="mdl-cell mdl-cell--8-col" >
    <md-tabs md-selected="selectedIndex" md-dynamic-height>
      <md-tab>
        <md-tab-label>
          Arbitrage/Table/Bar
        </md-tab-label>
        <md-tab-body>
          <iframe width='100%' height='800px' frameborder='0'
              src='https://docs.google.com/spreadsheets/d/1uVbWy_Pg03BnxqZ9HMN63vYmsrM5EMP3ZSEQXw5WFIo/pubhtml'>
          </iframe>
        </md-tab-body>
      </md-tab>
    </md-tabs>
  </div>
</div>
</main>
@overwrite
