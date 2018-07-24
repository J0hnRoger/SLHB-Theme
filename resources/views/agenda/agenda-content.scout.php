@extends('layouts.main')

@section('main')

<div ng-controller="AgendaCtrl as vm" class="agenda {[vm.direction]}" >
  <nav id="btn-navigation" class="navigation--button">
    <div class="material--burger {[vm.btnAnimation]}" ng-click="vm.go('#/')">
      <span></span>
    </div>
  </nav>
  <div class="left-column mdl-shadow--8dp mdl-cell mdl-cell--5-col mdl-cell--12-col-phone {[ vm.phoneCalendarClass ]}" >
    <h1>{{ Loop::Title()}}</h1>
    <slhb-calendar/>
  </div>
  <div class="center-column slhb-calendar mdl-shadow--8dp mdl-cell mdl-cell--7-col mdl-cell--12-col-phone fade" ng-view>
  </div>
</div>

@stop
