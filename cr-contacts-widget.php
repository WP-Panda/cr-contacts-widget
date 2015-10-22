<?php
/*
 * Plugin Name: Cr Contacts Widget
 * Plugin URI: http://wp-panda.com/cr-contacts-widget
 * Description: Виджет контактные данные. Со ссылкой с заголовка
 * Author: WP Panda
 * Version: 1.0.0
 * Author URI: http://wp-panda.com/
 * License: GPL2+
 */

if ( ! class_exists( 'Cr_Contact_Widget' ) ) {

	function cr_contact_widget_init() {
		register_widget( 'Cr_Contact_Widget' );
	}
	add_action( 'widgets_init', 'cr_contact_widget_init' );

	class Cr_Contact_Widget extends WP_Widget {

		function __construct() {
			$widget_ops = array(
				'classname' => 'cr_contact_widget',
				'description' => __( 'Отображает контактную информацию.', 'cr-contacts-widget' )
			);
			parent::__construct(
				'cr_contact_widget',
				__( 'Cr Контакты', 'jetpack' ),
				$widget_ops
			);
			$this->alt_option_name = 'cr_contact_widget';
		}

		public function defaults() {
			return array(
				'title'   => __( 'Обратная связь', 'cr-contacts-widget' ),
				'href'   =>  '#',
				'address' => __( "<b>Адрес:</b> 105120, г.Москва, ул. Нижняя Сыромятническая 10, строение 2.<br>Центр дизайна ARTPLAY", 'cr-contacts-widget' ),
				'phone'   => __( 'Для получения дополнительной информации, пожалуйста, звоните с 10:00 до 21:00: <span style="color:red">8 (495) 748 93 12</span>', 'cr-contacts-widget' ),
				'email'   => __( '<b>Email:</b> <a style="color:red" href="mailto:info@museum-design.ru">info@museum-design.ru</a>', 'cr-contacts-widget' ),
			);
		}

		function widget( $args, $instance ) {
			$instance = wp_parse_args( $instance, $this->defaults() );
			extract( $args, EXTR_SKIP );
			echo $args['before_widget'];
			if ( $instance['title'] != '' )
				echo $args['before_title'] . '<a href="' . $instance['href'] . '">' . $instance['title'] . '</a>' . $args['after_title'];

			if ( $instance['address'] != '' ) {
				echo '<div class="address"><p>' . $instance['address'] . '</p></div>';
			}
			if ( $instance['phone'] != '' ) {
				echo '<div class="phone"><p>' . $instance['phone']  . '</p></div>';

			}
			if ( $instance['email'] != '' ) {
				echo '<div class="email"><p>' .  $instance['email'] . "</p></div>";
			}
			echo $args['after_widget'];
		}

		function update( $new_instance, $old_instance ) {


			$instance = array();
			$instance['title']   = $new_instance['title'];
            $instance['href']    = $new_instance['href'];
			$instance['address'] = $new_instance['address'];
			$instance['phone']   = $new_instance['phone'];
			$instance['email']   = $new_instance['email'];

			return $instance;
		}

		function form( $instance ) {
			$instance = wp_parse_args( $instance, $this->defaults() );
			extract( $instance );
	    ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Заголовок:', 'cr-contacts-widget' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'href' ) ); ?>"><?php esc_html_e( 'Ссылка:', 'cr-contacts-widget' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'href' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'href' ) ); ?>" type="text" value="<?php echo esc_url( $instance['href'] ); ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e( 'Адрес:', 'cr-contacts-widget' ); ?></label>
                <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>"><?php echo esc_textarea( $instance['address'] ); ?></textarea>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e( 'Телефон:', 'cr-contacts-widget' ); ?></label>
                <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>"><?php echo esc_textarea( $instance['phone'] ); ?></textarea>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e( 'Электопочта:', 'cr-contacts-widget' ); ?></label>
				<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>"><?php echo esc_textarea( $instance['email'] ); ?></textarea>
            </p>

	<?php
		}
	}
}