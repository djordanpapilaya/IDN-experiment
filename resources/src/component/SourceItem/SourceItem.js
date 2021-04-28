import { AbstractTransitionComponent } from 'vue-transition-component';
import VueTypes from 'vue-types';
import { TweenLite, TimelineMax, Power4 } from 'gsap';
import SourceItemTransitionController from './SourceItemTransitionController';

// @vue/component
export default {
  name: 'SourceItem',
  extends: AbstractTransitionComponent,
  props: {
    visited: VueTypes.bool.def(false).isRequired,
    type: VueTypes.string.isRequired,
    data: VueTypes.any.isRequired,
  },
  data() {
    return {
      isInverted: false,
      isRight: false,
    };
  },
  methods: {
    handleAllComponentsReady() {
      this.transitionController = new SourceItemTransitionController(this);
      this.isReady();
      this.handlePosition();
    },
    handlePosition() {
      const screenPadding = 16;

      const placeholderRect = this.$el.querySelector('.js-icon').getBoundingClientRect();
      const dropdownRect = this.$el.querySelector('.js-overlay').getBoundingClientRect();

      const dropdownRightX = dropdownRect.x + dropdownRect.width;
      const placeholderRightX = placeholderRect.x + placeholderRect.width;
      const dropdownRightY = dropdownRect.y + dropdownRect.height;
      const placeholderRightY = placeholderRect.y + placeholderRect.height;

      // console.log(placeholderRect,
      // dropdownRect,
      //   dropdownRightY,
      //   placeholderRightY);

      if (dropdownRect.y < 0) {
        this.isInverted = true;
        this.$refs.overlay.style.top = '0';
        this.$refs.overlay.style.bottom = 'auto';
        // this.$refs.overlay.style.transform = `translateY(${-placeholderRect.y + screenPadding}px)`;
        this.$refs.overlay.style.transform = `translateY(${placeholderRect.height - screenPadding}px)`;
      } else if (dropdownRightX > window.outerWidth) {
        this.isRight = true;
        this.$refs.overlay.style.left = '0';
        this.$refs.overlay.style.right = 'auto';
        this.$refs.overlay.style.transform = `translateX(${(-dropdownRect.width)}px)`;
      }

      setTimeout(() => {
        TweenLite.set(this.$refs.overlay, {
          display: 'none',
        });
      }, 200);
    },
    handleMouseover() {
      const overlay = this.$refs.overlay;

      TweenLite.set(overlay, {
        display: 'flex',
      });

      TweenLite.to(overlay, .5, {
        autoAlpha: 1,
      });
    },
    handleMouseleave() {
      const overlay = this.$refs.overlay;

      TweenLite.to(overlay, .5, {
        autoAlpha: 0,
        onComplete: () => {
          TweenLite.set(overlay, {
            display: 'none',
          });
        }
      });
    },
  },
};
