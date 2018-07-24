<?php
class NextMatch_Widget extends WP_Widget
{
    public function __construct()
    {
        $params = [
            'description'   => 'Affiche le prochain match',
            'name'          => 'Prochain Match'
        ];
        parent::__construct('NextMatch_Widget', '', $params);
    }

    public function widget( $args, $instance ) {
      $match = "";
      if (isset($instance['teamName'])){
        $match = MatchModel::getFullNextMatchForTeam($instance['teamName']);
        echo "<h5>Prochain match</h6>" . "<h1>". $match->match_team_dom." contre ". $match->match_team_ext . " " . $match->lieu . "</h1>";
      }
    }

    /**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
        $teamName = ! empty( $instance['teamName'] ) ? $instance['teamName'] : "";
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'teamName' ) ); ?>"><?php _e( esc_attr( 'Nom de l\'équipe:' ) ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'teamName' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'teamName' ) ); ?>" type="text" value="<?php echo esc_attr( $teamName ); ?>">
		</p>
		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
  	public function update( $new_instance, $old_instance ) {
      return $new_instance;
  	}
}
?>
