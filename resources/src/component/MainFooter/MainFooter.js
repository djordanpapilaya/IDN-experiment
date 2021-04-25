import { AbstractTransitionComponent } from 'vue-transition-component';
import MainFooterTransitionController from './MainFooterTransitionController';

// @vue/component
export default {
  name: 'MainFooter',
  extends: AbstractTransitionComponent,
  data() {
    return {
      closeOpen: false,
      pauseOpen: false,
    };
  },
  methods: {
    handleAllComponentsReady() {
      this.transitionController = new MainFooterTransitionController(this);
      this.isReady();
    },
    handlePopupPause() {
      this.pauseOpen = true;
    },
    handlePopupFinish() {
      this.closeOpen = true;
    },
    handleStop() {

    },
    handlePause() {
      window.location.href = '/logout';
    },
    handleCancel() {
      this.closeOpen = false;
      this.pauseOpen = false;
    },
  },
};
