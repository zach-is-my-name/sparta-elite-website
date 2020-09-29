<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */

class VW_Minimalist_Control_Typography extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'typography';

	/**
	 * Array 
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Set up our control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $id
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'color'       => esc_html__( 'Font Color', 'vw-minimalist' ),
				'family'      => esc_html__( 'Font Family', 'vw-minimalist' ),
				'size'        => esc_html__( 'Font Size',   'vw-minimalist' ),
				'weight'      => esc_html__( 'Font Weight', 'vw-minimalist' ),
				'style'       => esc_html__( 'Font Style',  'vw-minimalist' ),
				'line_height' => esc_html__( 'Line Height', 'vw-minimalist' ),
				'letter_spacing' => esc_html__( 'Letter Spacing', 'vw-minimalist' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'vw-minimalist-ctypo-customize-controls' );
		wp_enqueue_style(  'vw-minimalist-ctypo-customize-controls' );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);

			if ( 'family' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			elseif ( 'weight' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			elseif ( 'style' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();
		}
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function content_template() { ?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul>

		<# if ( data.family && data.family.choices ) { #>

			<li class="typography-font-family">

				<# if ( data.family.label ) { #>
					<span class="customize-control-title">{{ data.family.label }}</span>
				<# } #>

				<select {{{ data.family.link }}}>

					<# _.each( data.family.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.weight && data.weight.choices ) { #>

			<li class="typography-font-weight">

				<# if ( data.weight.label ) { #>
					<span class="customize-control-title">{{ data.weight.label }}</span>
				<# } #>

				<select {{{ data.weight.link }}}>

					<# _.each( data.weight.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.weight.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.style && data.style.choices ) { #>

			<li class="typography-font-style">

				<# if ( data.style.label ) { #>
					<span class="customize-control-title">{{ data.style.label }}</span>
				<# } #>

				<select {{{ data.style.link }}}>

					<# _.each( data.style.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.size ) { #>

			<li class="typography-font-size">

				<# if ( data.size.label ) { #>
					<span class="customize-control-title">{{ data.size.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.size.link }}} value="{{ data.size.value }}" />

			</li>
		<# } #>

		<# if ( data.line_height ) { #>

			<li class="typography-line-height">

				<# if ( data.line_height.label ) { #>
					<span class="customize-control-title">{{ data.line_height.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" />

			</li>
		<# } #>

		<# if ( data.letter_spacing ) { #>

			<li class="typography-letter-spacing">

				<# if ( data.letter_spacing.label ) { #>
					<span class="customize-control-title">{{ data.letter_spacing.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.letter_spacing.link }}} value="{{ data.letter_spacing.value }}" />

			</li>
		<# } #>

		</ul>
	<?php }

	/**
	 * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
	 *
	 * @todo Integrate with Google fonts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_fonts() { return array(); }

	/**
	 * Returns the available font families.
	 *
	 * @todo Pull families from `get_fonts()`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_font_families() {

		return array(
			'' => __( 'No Fonts', 'vw-minimalist' ),
        'Abril Fatface' => __( 'Abril Fatface', 'vw-minimalist' ),
        'Acme' => __( 'Acme', 'vw-minimalist' ),
        'Anton' => __( 'Anton', 'vw-minimalist' ),
        'Architects Daughter' => __( 'Architects Daughter', 'vw-minimalist' ),
        'Arimo' => __( 'Arimo', 'vw-minimalist' ),
        'Arsenal' => __( 'Arsenal', 'vw-minimalist' ),
        'Arvo' => __( 'Arvo', 'vw-minimalist' ),
        'Alegreya' => __( 'Alegreya', 'vw-minimalist' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'vw-minimalist' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'vw-minimalist' ),
        'Bangers' => __( 'Bangers', 'vw-minimalist' ),
        'Boogaloo' => __( 'Boogaloo', 'vw-minimalist' ),
        'Bad Script' => __( 'Bad Script', 'vw-minimalist' ),
        'Bitter' => __( 'Bitter', 'vw-minimalist' ),
        'Bree Serif' => __( 'Bree Serif', 'vw-minimalist' ),
        'BenchNine' => __( 'BenchNine', 'vw-minimalist' ),
        'Cabin' => __( 'Cabin', 'vw-minimalist' ),
        'Cardo' => __( 'Cardo', 'vw-minimalist' ),
        'Courgette' => __( 'Courgette', 'vw-minimalist' ),
        'Cherry Swash' => __( 'Cherry Swash', 'vw-minimalist' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'vw-minimalist' ),
        'Crimson Text' => __( 'Crimson Text', 'vw-minimalist' ),
        'Cuprum' => __( 'Cuprum', 'vw-minimalist' ),
        'Cookie' => __( 'Cookie', 'vw-minimalist' ),
        'Chewy' => __( 'Chewy', 'vw-minimalist' ),
        'Days One' => __( 'Days One', 'vw-minimalist' ),
        'Dosis' => __( 'Dosis', 'vw-minimalist' ),
        'Droid Sans' => __( 'Droid Sans', 'vw-minimalist' ),
        'Economica' => __( 'Economica', 'vw-minimalist' ),
        'Fredoka One' => __( 'Fredoka One', 'vw-minimalist' ),
        'Fjalla One' => __( 'Fjalla One', 'vw-minimalist' ),
        'Francois One' => __( 'Francois One', 'vw-minimalist' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'vw-minimalist' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'vw-minimalist' ),
        'Great Vibes' => __( 'Great Vibes', 'vw-minimalist' ),
        'Handlee' => __( 'Handlee', 'vw-minimalist' ),
        'Hammersmith One' => __( 'Hammersmith One', 'vw-minimalist' ),
        'Inconsolata' => __( 'Inconsolata', 'vw-minimalist' ),
        'Indie Flower' => __( 'Indie Flower', 'vw-minimalist' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'vw-minimalist' ),
        'Julius Sans One' => __( 'Julius Sans One', 'vw-minimalist' ),
        'Josefin Slab' => __( 'Josefin Slab', 'vw-minimalist' ),
        'Josefin Sans' => __( 'Josefin Sans', 'vw-minimalist' ),
        'Kanit' => __( 'Kanit', 'vw-minimalist' ),
        'Lobster' => __( 'Lobster', 'vw-minimalist' ),
        'Lato' => __( 'Lato', 'vw-minimalist' ),
        'Lora' => __( 'Lora', 'vw-minimalist' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'vw-minimalist' ),
        'Lobster Two' => __( 'Lobster Two', 'vw-minimalist' ),
        'Merriweather' => __( 'Merriweather', 'vw-minimalist' ),
        'Monda' => __( 'Monda', 'vw-minimalist' ),
        'Montserrat' => __( 'Montserrat', 'vw-minimalist' ),
        'Muli' => __( 'Muli', 'vw-minimalist' ),
        'Marck Script' => __( 'Marck Script', 'vw-minimalist' ),
        'Noto Serif' => __( 'Noto Serif', 'vw-minimalist' ),
        'Open Sans' => __( 'Open Sans', 'vw-minimalist' ),
        'Overpass' => __( 'Overpass', 'vw-minimalist' ),
        'Overpass Mono' => __( 'Overpass Mono', 'vw-minimalist' ),
        'Oxygen' => __( 'Oxygen', 'vw-minimalist' ),
        'Orbitron' => __( 'Orbitron', 'vw-minimalist' ),
        'Patua One' => __( 'Patua One', 'vw-minimalist' ),
        'Pacifico' => __( 'Pacifico', 'vw-minimalist' ),
        'Padauk' => __( 'Padauk', 'vw-minimalist' ),
        'Playball' => __( 'Playball', 'vw-minimalist' ),
        'Playfair Display' => __( 'Playfair Display', 'vw-minimalist' ),
        'PT Sans' => __( 'PT Sans', 'vw-minimalist' ),
        'Philosopher' => __( 'Philosopher', 'vw-minimalist' ),
        'Permanent Marker' => __( 'Permanent Marker', 'vw-minimalist' ),
        'Poiret One' => __( 'Poiret One', 'vw-minimalist' ),
        'Quicksand' => __( 'Quicksand', 'vw-minimalist' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'vw-minimalist' ),
        'Raleway' => __( 'Raleway', 'vw-minimalist' ),
        'Rubik' => __( 'Rubik', 'vw-minimalist' ),
        'Rokkitt' => __( 'Rokkitt', 'vw-minimalist' ),
        'Russo One' => __( 'Russo One', 'vw-minimalist' ),
        'Righteous' => __( 'Righteous', 'vw-minimalist' ),
        'Slabo' => __( 'Slabo', 'vw-minimalist' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'vw-minimalist' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'vw-minimalist'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'vw-minimalist' ),
        'Sacramento' => __( 'Sacramento', 'vw-minimalist' ),
        'Shrikhand' => __( 'Shrikhand', 'vw-minimalist' ),
        'Tangerine' => __( 'Tangerine', 'vw-minimalist' ),
        'Ubuntu' => __( 'Ubuntu', 'vw-minimalist' ),
        'VT323' => __( 'VT323', 'vw-minimalist' ),
        'Varela Round' => __( 'Varela Round', 'vw-minimalist' ),
        'Vampiro One' => __( 'Vampiro One', 'vw-minimalist' ),
        'Vollkorn' => __( 'Vollkorn', 'vw-minimalist' ),
        'Volkhov' => __( 'Volkhov', 'vw-minimalist' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'vw-minimalist' )
		);
	}

	/**
	 * Returns the available font weights.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			'' => esc_html__( 'No Fonts weight', 'vw-minimalist' ),
			'100' => esc_html__( 'Thin',       'vw-minimalist' ),
			'300' => esc_html__( 'Light',      'vw-minimalist' ),
			'400' => esc_html__( 'Normal',     'vw-minimalist' ),
			'500' => esc_html__( 'Medium',     'vw-minimalist' ),
			'700' => esc_html__( 'Bold',       'vw-minimalist' ),
			'900' => esc_html__( 'Ultra Bold', 'vw-minimalist' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			'' => esc_html__( 'No Fonts Style', 'vw-minimalist' ),
			'normal'  => esc_html__( 'Normal', 'vw-minimalist' ),
			'italic'  => esc_html__( 'Italic', 'vw-minimalist' ),
			'oblique' => esc_html__( 'Oblique', 'vw-minimalist' )
		);
	}
}
