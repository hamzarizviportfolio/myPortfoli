<?php
/**
 * Checkbox control
 */
if ( class_exists( 'WP_Customize_Control' ) ) {

	class themesflat_Separation extends WP_Customize_Control {
		public $type = 'separation';

		public function render_content() {
			?>
            <div class="themesflat-options-control-separation">
                <div class="separation-inner">
                </div>
            </div>
			<?php
		}
	}
}