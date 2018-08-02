<?php

/*-----------------------------------------------------------------------*/

// Add Custom field to the native Post Type for manage News wich must appear in agenda

/*-----------------------------------------------------------------------*/

$startDateProperties = [
    'features'  => ['title' => 'Heure de début de l\'évènement'],
    'atts'      => array_merge(['class' => 'large-text'], ['class' => 'simple-text'], ['data-field' => 'text']),
    'name'      => 'eventStartTime',
    'internal'  => 'Bim!'
];

$endDateProperties = [
    'features'  => ['title' => 'Heure de fin de l\'évènement'],
    'atts'      => array_merge(['class' => 'large-text'], ['class' => 'simple-text'], ['data-field' => 'text']),
    'name'      => 'eventEndTime',
    'internal'  => 'Bim!'
];

$galleryProperties = [
    'title' => 'Gallerie d\'images de l\'évènement',
    'name'      => 'postGallery',
    'internal'  => 'postGallery'
];

$infos = Metabox::make('Informations sur l\'évènement', "post")->set(array(
  Field::date('eventDate', ['title' => 'Date de l\'évènement']),
  Field::make('Addons\Fields\TimeField', $startDateProperties),
  Field::make('Addons\Fields\TimeField', $endDateProperties),
  Field::collection('post_gallery', $galleryProperties)
));

