<?php


/**
*
*  Widget Newsletter
*/


/**
* Adds abNewslettr widget.
*/
class abNewsletter_Widget extends WP_Widget { // Remplacer abNewsletter_Widget par le nom du nouveau Widget

  /**
  * Register widget with WordPress.
  */
  function __construct() {
    parent::__construct(
    'abNewsletter_Widget', //  ID du widget
    __( 'Newsletter', 'text_domain' ), // Name
    array( 'description' => __( 'Widget Newsletter', 'text_domain' ), ) // Args
  );
}

/**
* Front-end display of widget.
*
* @see WP_Widget::widget()
*
* @param array $args     Widget arguments.
* @param array $instance Saved values from database.
*/
public function widget( $args, $instance ) {

  echo $args['before_widget'];



  if ( ! empty( $instance['title'] ) ) {
    $title = $instance['title'];
    echo  "<h4 class=' '>$title</h4>";
  }


  if ( ! empty( $instance['desc'] ) ) {
    $desc = $instance['desc'];
    echo  "<p class=' '>$desc</p>";
  }



  echo "
  <form action='#' role='form' class='newsletter-form' novalidate='novalidate'>

  <input name='email' type='text' placeholder='Entrez votre email' required=''>
  <button id='newsletter-form-btn' class=' ' type='submit'>s'inscrire</button>

  </form>

  ";


  echo $args['after_widget'];

}

/**
*
* CREATION DU FORMULAIRE DANS LE BACKOFFICE
*
* Back-end widget form.
*
* @see WP_Widget::form()
*
* @param array $instance Previously saved values from database.
*/
public function form( $instance ) {

  // On test si la var $contenu existe si non $instance['contenu'] est défini




  $title = ! empty( $instance['title'] ) ? $instance['title'] : __( "Newsletter", 'text_domain' );

  $desc = ! empty( $instance['desc'] ) ? $instance['desc'] : __( " ", 'text_domain' );



  ?>
  <p>

    <!-- CREATION DES CHAMPS DU FORMULAIRE -->


    <!-- title -->
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( "title" ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">

    <!-- url -->
    <label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e( 'Description:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( "desc" ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" type="text" value="<?php echo esc_attr( $desc ); ?>">


  </p>


  <?php
}

/**
* ON NETTOIT LES VALEURS POUR EVITER LES XSS
* Sanitize widget form values as they are saved.
*
* @see WP_Widget::update()
*
* @param array $new_instance Values just sent to be saved.
* @param array $old_instance Previously saved values from database.
*
* @return array Updated safe values to be saved.
*/
public function update( $new_instance, $old_instance ) {

  // permet de nétoyer les valeurs
  $instance = array();
  $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
  $instance['desc'] = ( ! empty( $new_instance['desc'] ) ) ? strip_tags( $new_instance['desc'] ) : '';
  return $instance;
}

} // class abNewsletter_Widget


// register abNewsletter_Widget widget
function register_abNewsletter_Widget() {
  register_widget( 'abNewsletter_Widget' );
}
add_action( 'widgets_init', 'register_abNewsletter_Widget' );
