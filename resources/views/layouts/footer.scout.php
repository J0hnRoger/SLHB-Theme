<?php

$images = Option::get("section-slhb-options", "logos");

?>

<h1>Nos Partenaires</h1>
@if($images != "")
<ul class="partners">
  @foreach($images as $i => $image)
  <li>

    <?php echo wp_get_attachment_image( $image , [889, 392] );  ?>
  </li>
  @endforeach
@else
<h5>Amis sponsors, participez à l'aventure SLHB!</h5>
  @endif
</ul>
