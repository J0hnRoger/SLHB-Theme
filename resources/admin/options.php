<?php

$options = Page::make('options', 'Configuration SLHB')->set([
    'capability'    => 'manage_options',
    'icon'          => 'dashicons-hammer',
    'position'      => 50,
    'tabs'          => true
]);

// Partenaires Section
$sections[] = Section::make('section-slhb-options', 'Paramètres généraux');
$options->addSections($sections);

$settings['section-slhb-options'] = [
    Field::collection('logos', [
      'title'     => 'Logos des partenaires'
  ]),
  Field::text('facebook_url', [
      'title'     => 'Url Facebook'
  ]),
  Field::text('gmap_url', [
      'title'     => 'Url vers la page de contact',
      'default'   => '/infos-utiles'
  ])
];

$options->addSettings($settings);
